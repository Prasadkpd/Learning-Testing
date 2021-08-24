<?php
include("connection.php");
$username = $realname = $password = $email = $lastLogin = $status = $userRole = "";

if (!empty($_POST['username']) and !empty($_POST['password'])) {
    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);
    
    //select the all columns that contain username and password is correct
    $sql = "SELECT * FROM users WHERE user_uname = '$username' and user_password='$password'";
    $result = $con->query($sql);

    // get all the columns data
    if ($result->num_rows ==1){
        while( $row = $result->fetch_assoc()){
            $realname = $row['user_name'];
            $email = $row['user_email'];
            $lastLogin = $row['user_last_login'];
            $status = $row['user_status'];
            $userRole = $row['user_role'];
        }

        //check the status of the user
        if($status == "DISABLE"){
            echo 'Your account is disabled. Please contact Administrator';
            $con->close();
            exit();
        }else if ($status == "BLOCK"){
            echo 'Your account is blocked. Contact your administrator';
            $con->close();
            exit();
        }else if($status == "ACTIVE"){
            $sql = "UPDATE users SET user_last_login = current_timestamp() WHERE user_uname = '$username'";
            $con->query($sql);
            echo "success";
            $con->close();
            exit();
        }
    }else{
        echo "No user account found. Please check your username and password.";
    }
    $con->close();
    exit();
}
?>