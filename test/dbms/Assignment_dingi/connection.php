<?php
$host ="localhost";
$username = "root";
$password = "";
$database = "xyz";

//create the connection with database
$con = new mysqli($host, $username, $password, $database);

//check the database connection and die when connection is not working with creating log in log file
if (mysqli_connect_error()){
    $error = "DB connection error ".mysqli_connect_error()." \r\n";
    $file = fopen("log\log.txt", "a");
    fwrite($file, $error);
    fclose($file);
    header("Location: 404.html");
}
?>