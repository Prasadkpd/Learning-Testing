<?php
include("connection.php");

require("TCPDF\\tcpdf.php");

//check cookie is set if not redirect to login page
if(!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
    echo "redirect";
    $con->close();
    exit();
}

$username = $password ="";

$username = $con->real_escape_string($_COOKIE['username']);
$password = $con->real_escape_string($_COOKIE['password']);

//get user data
$sql = "SELECT * FROM users WHERE user_uname = '$username' AND user_password = '$password' AND user_status='ACTIVE'";
$result = $con->query($sql);

if(($result->num_rows ==1)== false){
    echo "redirect";
    $con->close();
    exit();
}

if(!empty($_POST['cusID']) && !empty($_POST['orderItems'])){

    #  itemID+"|"+unitPrice+"|"+qoh+"|"+quantity+"|"itemName;
    $customerId = $con->real_escape_string($_POST['cusID']);
    $orderItems = $con->real_escape_string($_POST['orderItems']);

    $orderItems = (explode("|", $orderItems));
    array_pop($orderItems);

    #PLACE THE ORDER
    $sql = "INSERT INTO orders (cus_id, order_by)
            VALUES ('$customerId','$username')";
    if($con->query($sql) === TRUE){
        $orderID = $con->insert_id;
        $data = "Order placed by ".$username." order id is ".$orderID;
        $file = fopen("log\log.txt", "a");
        fwrite($file, $data);
        fclose($file);
    }else{
        $data = $con->error;
        $file = fopen("log\log.txt", "a");
        fwrite($file, $data);
        fclose($file);
        echo "There is an error occurs please reload this page";
    }

    $steps ="";
    $loop_counter = count($orderItems);
    foreach(range(0,$loop_counter,5) as $i){
        if(!array_key_exists($i+2, $orderItems)){
            break;
        }
        $itemID = $orderItems[$i];
        $unitPrice = (float)$orderItems[$i+1];
        $qoh = (float)$orderItems[$i+2];
        $quntity = (float)$orderItems[$i+3];

        $backOrder = 0;
        $filled = $quntity;

        if($qoh <$quntity){
            $backOrder = $quntity-$qoh;
            $filled = $qoh;
            #update product
            $sql = "UPDATE product SET prod_QOH =0, prod_bo =prod_bo+ $backOrder WHERE prod_code = '$itemID'";
            $result = $con->query($sql);

        }else{
            $sql = "UPDATE product SET prod_QOH =prod_QOH-$quntity WHERE prod_code = '$itemID'";
            $result = $con->query($sql);

        }

        #inset in to items
        $sql = "INSERT INTO orders_item VALUES ('$orderID', '$itemID', '$quntity','$filled')";
        $result = $con->query($sql);
    }

    //get customer discount 
    $sql = "SELECT *FROM customer WHERE cus_id= $customerId";
    $result = $con->query($sql);
    $customerDiscount = 0;
    while($row = $result->fetch_assoc()){
        $customerDiscount = (float)$row['cus_discount'];
        $customerAddress = $row['cus_address'];
        $customerAddress = str_replace("\\n","<br>",$customerAddress);
        $customerShipAddress = $row['cus_ship_address'];
        $customerShipAddress = str_replace("\\n","<br>",$customerAddress);
        $customerPhone = $row['cus_phone'];
    }
    if(empty(trim($customerShipAddress))){
        $customerShipAddress = $customerAddress;
    }
    #  itemID+"|"+unitPrice+"|"+qoh+"|"+quantity+"|"itemName;
    $htmlData = "";
    $counter = 1;
    $totalPrice = 0;
    foreach(range(0,$loop_counter,5) as $i){
        if(isset($orderItems[$i])==false){
            break;
        }
        $itemID = $orderItems[$i];
        $unitPrice = (float)$orderItems[$i+1];
        $qoh = (float)$orderItems[$i+2];
        $quntity = (float)$orderItems[$i+3];
        $itemName = $orderItems[$i+4];

        $backOrder = 0;
        $filled = $quntity;

        if($qoh <$quntity){
            $backOrder = $quntity-$qoh;
            $filled = $qoh;
        }
        //creating array for data
        $htmlData .= $counter."|".$itemID."|".$itemName."|".$quntity."|".$backOrder."|".$filled."|".$unitPrice."|".($quntity*$unitPrice).",";
        $counter +=1;
        $totalPrice += $quntity*$unitPrice;
    }
    $mainArray = explode(",", $htmlData);
    array_pop($mainArray);
    $html = '
    <table>
    <thead>
    <tr>
    <td>
    ORDER # '.$orderID.'<br>
    '.$customerAddress.'
    </td>
    <td>
    shipping Address
    </td>
    <td>
    '.$customerShipAddress.'
    </td>
    </tr>
    </thead>
    </table>
    <br>
    <div>
    <span>
    PHONE: '.$customerPhone.'
    </span>
    <span>
    CUSTOMER DISCOUNT: '.$customerDiscount.' %
    </span>
    </div>
    
    <table > 
    <thead>
    <tr>
    <th><u>ITEM</u></th>
    <th><u>CODE</u></th>
    <th><u>DESCRIPTION</u></th>
    <th ><u>QTY</u></th>
    <th ><u>B.Order</u></th>
    <th><u>FILLED</u></th>
    <th><u>PRICE/UNIT</u></th>
    <th ><u>Amount</u></th>
    </tr>
    </thead>
    ';

    foreach($mainArray as $main){
        $data = explode("|", $main);
        $html .="<tr>";
        foreach($data as $piece){
            $html .="<td>".$piece."</td>";
        }
        $html .="</tr>";
    }
    $html .="</table>";
    $html .='
    <br>
    <br>
        <div style="position:absolute; right:150px;">
        <table>
        <tr>
            <td>TOTAL </td>
            <td>'.$totalPrice.'</td>
        </tr>
        <tr>
            <td>DISCOUNT </td>
            <td>'.(($totalPrice*$customerDiscount)/100).'</td>
        </tr>
        <tr>
            <td>AMOUNT OWING </td>
            <td><u>'.((float)($totalPrice)-(float)(($totalPrice*$customerDiscount)/100)).'</u></td>
        </tr>
        </table>
        </div>
    ';
    //==update order value
    $sql = "UPDATE orders SET order_value = ".((float)($totalPrice)-(float)(($totalPrice*$customerDiscount)/100)).
            "WHERE order_no = $orderID";
    $result = $con->query($sql);
    
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setPageOrientation('L');
    $pdf->SetCreator("Wisnshaftler");
    $pdf->SetAuthor('Wisnshaftler');
    $pdf->SetTitle('WMS by Wisnshaftler github.com/wisnshaftler');
    $pdf->setHeaderData("", 0, "XYZ MANUFACTURING ORDER FORM                                                 date:".date("Y-m-d h:i:sa"),
    "powerd by WMS. Created by wisnshaftler.  www.github.com/wisnshaftler", array(0, 6, 255), array(0, 64, 128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    // ---------------------------------------------------------
    // set default font subsetting mode
    $pdf->setFont('dejavusans', '', 10, '', true);
    $pdf->AddPage();
    $pdf->writeHTML($html);
    $name =$customerId.md5(date("Y-m-d h:i:sa")).".pdf";

    $pdf->Output($_SERVER['DOCUMENT_ROOT']."dbms/invoice"."/".$name, 'F');
    $path =  explode("place-order.php",$_SERVER['REQUEST_URI'])[0]."invoice/";
    $path .= $name;
    echo $path;


}
?>