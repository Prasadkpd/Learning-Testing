<?php
include("connection.php");

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

if(!empty($_POST['customerUpdate']) && !empty($_POST['searchPhoneNumber'])){
    $searchPhoneNumber = $con->real_escape_string($_POST['searchPhoneNumber']);
    
    $sql = "SELECT * FROM customer WHERE cus_phone LIKE '%$searchPhoneNumber%' LIMIT 10";
    $result = $con->query($sql);

    $cust_object ="";
    $customers = null; //for sending the objects

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $cust_object = '<div class="border border-dark p-2" >User ID: '.$row['cus_id'];
            $cust_object .='<br> Name: '.$row['cus_name'];
            $cust_object .='<br> Phone: '.$row['cus_phone'];
            $cust_object .='<br> Credit: '.$row['cus_credit_limit'];
            $cust_object .='<br> Used Credit: '.$row['cus_used_credit_limit'];
            $cust_object .='<br> Remarks : '.$row['cus_remarks'];
            $cust_object .= '<br> Status: '.$row['cus_status'];
            $cust_object .= '<br> <button type="button" onclick="loadUser('.$row['cus_id'].')" 
            class="btn btn-outline-secondary btn-sm">Load User</button>'.'</div> </br>';
            $customers = $customers.$cust_object;
        }
        echo $customers;
    }else{

    }
}

if(!empty($_POST['loadUser']) && !empty($_POST['userID'])){
    $userID = (int)$con->real_escape_string($_POST['userID']);

    $sql = "SELECT * FROM customer WHERE cus_id = $userID";
    $result =$con->query($sql);
    $data = new \stdClass();
    while($row = $result->fetch_assoc()){
        $data->id = $row['cus_id'];
        $data->name = $row['cus_name'];
        $data->address = $row['cus_address'];
        $data->shipaddress = $row['cus_ship_address'];
        $data->phone = $row['cus_phone'];
        $data->discount = $row['cus_discount'];
        $data->credit = $row['cus_credit_limit'];
        $data->usedcredit = $row['cus_used_credit_limit'];
        $data->status = $row['cus_status'];
        $data->remarks = $row['cus_remarks'];
        
    }
    echo json_encode( $data);
}

if(!empty($_POST['orderPhone']) && !empty($_POST['orderPhoneNumber'])){
    $orderPhoneNumber = $con->real_escape_string($_POST['orderPhoneNumber']);
    
    $sql = "SELECT * FROM customer WHERE cus_phone LIKE '%$orderPhoneNumber%' LIMIT 10";
    $result = $con->query($sql);

    $cust_object ="";
    $customers = null; //for sending the objects

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $cust_object = '<div class="border border-dark p-2" >User ID: '.$row['cus_id'];
            $cust_object .='<br> Name: '.$row['cus_name'];
            $cust_object .='<br> Phone: '.$row['cus_phone'];
            $cust_object .='<br> Discount: '.$row['cus_discount'];
            $cust_object .='<br> Credit: '.$row['cus_credit_limit'];
            $cust_object .='<br> Used Credit: '.$row['cus_used_credit_limit'];
            $cust_object .='<br> Remarks : '.$row['cus_remarks'];
            $cust_object .= '<br> Status: '.$row['cus_status'];
            $cust_object .= '<br> <button type="button" onclick="loadOrderCustomer('.$row['cus_id'].')" 
            class="btn btn-outline-secondary btn-sm">Load User</button>'.'</div> </br>';
            $customers = $customers.$cust_object;
        }
        echo $customers;
    }else{

    }
}


if(!empty($_POST['searchProductName']) && !empty($_POST['searchProduct'])){
    $searchProductName = $con->real_escape_string($_POST['searchProductName']);
    
    $sql = "SELECT * FROM product WHERE prod_desc LIKE '%$searchProductName%' LIMIT 10";
    $result = $con->query($sql);

    $product =null;
    $productList =null;

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $product .= '<div class="border border-dark p-2" >Product ID: '.$row['prod_code'];
            $product .= '<br> Name: '.$row['prod_desc'];
            $product .= '<br> Price: '.$row['prod_price'];
            $product .= '<br> QOH: '.$row['prod_QOH'];
            $product .= '<br> B.Ord: '.$row['prod_bo'];
            $product .= '<br> <button type="button" onclick="loadItem('."'".$row['prod_code']."'".",'".$row['prod_desc']."',".$row['prod_price'].','.$row['prod_QOH'].')" 
            class="btn btn-outline-secondary btn-sm">Load Item</button>'.'</div> </br>';
            $productList .= $product;
        }
         echo $productList;
    }else{

    }
}
?>