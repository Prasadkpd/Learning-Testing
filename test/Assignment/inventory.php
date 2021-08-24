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

if($_POST['temp']){
$html = '
<h3>PRODUCT INVENOTY AS AT : '.(date("Y-m-d h:i:sa")).'</h3>
<table>
<tr>
<th>product code</th>
<th>description </th>
<th>QOH </th>
<th>B.Orderd</th>
<th>Price</th>
</tr>
';
$sql = "SELECT * FROM product";
$result = $con->query($sql);

while($row = $result->fetch_assoc()){
    $html .= "<tr>";
    $html .= "<td>".$row['prod_code']."</td>";
    $html .= "<td>".$row['prod_desc']."</td>";
    $html .= "<td>".$row['prod_QOH']."</td>";
    $html .= "<td>".$row['prod_bo']."</td>";
    $html .= "<td>".$row['prod_price']."</td>";
    $html .= "</tr>";
}

$html .='</table>';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPageOrientation('L');
$pdf->SetCreator("Wisnshaftler");
$pdf->SetAuthor('Wisnshaftler');
$pdf->SetTitle('WMS by Wisnshaftler github.com/wisnshaftler');
$pdf->setHeaderData("", 0, "XYZ MANUFACTURING Inventory Details",
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
$name ="inventory".md5(date("Y-m-d h:i:sa")).".pdf";

$pdf->Output($_SERVER['DOCUMENT_ROOT']."dbms/invoice"."/".$name, 'F');
$path =  explode("inventory.php",$_SERVER['REQUEST_URI'])[0]."invoice/";
$path .= $name;


    echo $path;

}
?>