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

if(!empty($_POST['prodCode']) || !empty($_POST['prodDesc']) || !empty($_POST['prodPrice'])){
    $prodCode = $con->real_escape_string($_POST['prodCode']);
    $prodDesc = $con->real_escape_string($_POST['prodDesc']);
    $prodPrice = $con->real_escape_string($_POST['prodPrice']);
    $prodQOH = $con->real_escape_string($_POST['prodQOH']);
    $prodBo = $con->real_escape_string($_POST['prodBo']);

    $sql = "INSERT INTO product values('$prodCode','$prodDesc','$prodPrice','$prodQOH','$prodBo')";

    if($con->query($sql) === TRUE){
        echo "Success";
        exit();
    }else{
        echo "Some error occures";
        exit();
    }
}
?>
