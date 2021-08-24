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
$sql = "SELECT * FROM users WHERE user_uname = '$username' AND user_password = '$password' AND user_status='ACTIVE' AND user_role='admin'";
$result = $con->query($sql);

if(($result->num_rows ==1)== false){
    echo "redirect";
    $con->close();
    exit();
}
if(!empty($_POST['newUsername']) || !empty($_POST['newPassword']) || !empty($_POST['newName']) || 
!empty($_POST['newEmail'] )|| !empty($_POST['newRole'])|| !empty($_POST['newStatus'])){
    $username = $con->real_escape_string($_POST['newUsername']);
    $password = md5($con->real_escape_string($_POST['newPassword']));
    $name = $con->real_escape_string($_POST['newName']);
    $email = $con->real_escape_string($_POST['newEmail']);
    $role = $con->real_escape_string(strtoupper($_POST['newRole']));
    $status = $con->real_escape_string(strtoupper($_POST['newStatus']));

    $sql = "INSERT INTO users (user_uname, user_password, `user_name`, user_email, user_role,user_status)
    values('$username','$password','$name','$email','$role','$status')";

    $result = $con->query($sql);
    echo "Done".$con->error;
}

if(!empty($_POST['deleteUser']) || !empty($_POST['deactivateUser'])){
    $deleteUser = $con->real_escape_string($_POST['deleteUser']);

    $sql ="UPDATE users SET user_status='BLOCK' WHERE user_uname ='$deleteUser' ";
    if($con->query($sql)===TRUE){
        echo "User deactivated".$deleteUser;
        exit();
    }else{
        echo "some error occures please try again or contact your IT support";
        exit();
    }
}
?>