<?php

$severname = 'localhost'; 
$username = 'root';
$password = '';
$dbname = 'userdb';

//create connection
$connection = mysqli_connect($severname,$username,$password,$dbname);

if(!$connection){
    die("Connection failed: ". mysqli_connect_error());
}

?>