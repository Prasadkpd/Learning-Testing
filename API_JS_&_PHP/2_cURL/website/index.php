<?php 

// $url = "http://localhost/test/API_JS_&_PHP/2_cURL/api/index.php";

// $data = file_get_contents($url);

// echo "<pre>";
// echo $data;
// echo "</pre>";

//There library as cURL to get data from internet
//This is the way to read data from API 
$url = "https://jsonplaceholder.typicode.com/todos/3";
$ch = curl_init();//Initialize curl here
curl_setopt($ch,CURLOPT_URL,$url);//set a option for tranfer
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//tell it return something
$data = curl_exec($ch);//execute and handle curl

echo "<pre>";
echo $data;

?>