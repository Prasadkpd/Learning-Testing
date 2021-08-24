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

if(empty($_POST['name']) || empty($_POST['address']) || empty($_POST['phonenumber']))
{
    echo "some important fields are empty please check";
    exit();
}
$name = $con->real_escape_string($_POST['name']);
$address = $con->real_escape_string($_POST['address']);
$shipaddress = $con->real_escape_string($_POST['shipaddress']);
$phonenumber = $con->real_escape_string($_POST['phonenumber']);
$discount = (int)($con->real_escape_string($_POST['discount']));
$creditlimit = (int)($con->real_escape_string($_POST['creditlimit']));
$remarks = $con->real_escape_string($_POST['remarks']);


$sql = "INSERT INTO customer (cus_name, cus_address, cus_ship_address, cus_phone, cus_discount, cus_credit_limit, 
cus_status, cus_remarks, cus_create_by)
        VALUES ('$name', '$address', '$shipaddress', '$phonenumber', $discount, $creditlimit, 'active','$remarks', 
        '$username' )";

if ($con->query($sql) === TRUE){
    $data = "user created by '".$username."'. user phone number is ".$phonenumber;
    $file = fopen("log\log.txt", "a");
    fwrite($file, $data);
    fclose($file);
    echo "Successfull";
}

?>