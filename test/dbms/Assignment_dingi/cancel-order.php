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

$cancelOrderID = $con->real_escape_string($_POST['cancelOrderID']);

$sql = "UPDATE orders SET order_status = 'canceled' WHERE order_no='$cancelOrderID'";
if($con->query($sql)===TRUE){
    echo "Done";
    exit();
}else{
    echo "Some error occures please try again or contact your IT";
    exit();
}
?>