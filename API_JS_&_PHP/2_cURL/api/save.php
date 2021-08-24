<?php 
//This our api now
//the request send and receive by this file 
//This is the get method
//$get = json_encode($_GET);//get array and convert to string
//file_put_contents('get.txt',$get); 

//This is the post request
// $post = json_encode($_POST);//convert the array data to json
// file_put_contents('post.txt',$post);

//this is th most comman way & work with json
$data = file_get_contents('php://input');//this give data as a string so didn't want to json encoding|| raw data
file_put_contents('data.txt',$data);

echo "<br>connected"
?>