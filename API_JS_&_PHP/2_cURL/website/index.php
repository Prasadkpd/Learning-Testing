<?php 

// $url = "http://localhost/test/API_JS_&_PHP/2_cURL/api/index.php";

// $data = file_get_contents($url);

// echo "<pre>";
// echo $data;
// echo "</pre>";




//There library as cURL to get data from internet
//This is the way to read data from API 
// $url = "https://jsonplaceholder.typicode.com/todos/3";
// $ch = curl_init();//Initialize curl here
// curl_setopt($ch,CURLOPT_URL,$url);//set a option for tranfer
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//tell it return something
// $data = curl_exec($ch);//execute and handle curl

// echo "<pre>";
// echo $data;

// $url = "http://localhost/test/API_JS_&_PHP/2_cURL/api/save.php?name=John&age=24";
// $ch = curl_init();//Initialize curl here
// curl_setopt($ch,CURLOPT_URL,$url);//set a option for tranfer
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//tell it return something
// $data = curl_exec($ch);//execute and handle curl

// //In this we note get the request &reply it is going to save.php file
// echo "<pre>";
// echo $data;

//ALL this age going in post request

$url = "http://localhost/test/API_JS_&_PHP/2_cURL/api/save.php";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);//set a option for tranfer
curl_setopt($ch,CURLOPT_HEADER,true);//use this for check there is a error of the response
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-type: text/plain'));//can use a http header to show the content type
curl_setopt($ch,CURLOPT_POST,true);//this is the post request
curl_setopt($ch,CURLOPT_POSTFIELDS,'name=marry&age=44');
$data = curl_exec($ch);
echo "<pre>";
echo $data;




?>