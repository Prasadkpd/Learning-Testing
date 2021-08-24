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

if(empty($_POST['name']) || empty($_POST['address']) || empty($_POST['phonenumber']) || empty($_POST['updateUser']))
{
    echo "some important fields are empty please check";
    exit();
}
$userID = $con->real_escape_string($_POST['userID']);
$name = $con->real_escape_string($_POST['name']);
$address = $con->real_escape_string($_POST['address']);
$shipaddress = $con->real_escape_string($_POST['shipaddress']);
$phonenumber = $con->real_escape_string($_POST['phonenumber']);
$discount = $con->real_escape_string($_POST['discount']);
$creditlimit = $con->real_escape_string($_POST['creditlimit']);
$remarks = $con->real_escape_string($_POST['remarks']);
$status = $con->real_escape_string($_POST['status']);
$usedcreditlimit = $con->real_escape_string($_POST['usedcreditlimit']);

$sql = "UPDATE CUSTOMER SET 
        cus_name = '$name',
        cus_address ='$address', 
        cus_ship_address = '$shipaddress', 
        cus_phone = '$phonenumber',
        cus_discount = '$discount',
        cus_credit_limit = '$creditlimit',
        cus_used_credit_limit = '$usedcreditlimit',
        cus_status = '$status',
        cus_remarks = '$remarks'
        WHERE cus_id = '$userID' ";

$result = $con->query($sql);

if($con->query($sql) === TRUE){
    echo "done";
}else{
    echo "Some error found. Please log out and login. If error come again please contact your ADMIN.";
}

?>