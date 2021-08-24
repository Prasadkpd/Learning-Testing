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
$productID = $con->real_escape_string( $_POST['productID']);
$productQTY =(int)$con->real_escape_string($_POST['productQTY']);

$sql = "UPDATE product SET prod_QOH = prod_QOH +".$productQTY." WHERE prod_code='$productID'";

if ($result = $con->query($sql)===TRUE){
    echo "done";
}else{
    echo "some error occures pleaes try again";
}

?>