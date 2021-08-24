<?php 

    $msg = ""; 
    //if upload  button is pressed
    if(isset($_POST['upload'])){
        // the path to store the upload image

        $target = "images/".basename($_FILES['image']['name']);

        //connect to the database
        $db = mysqli_connect("localhost","root","","test");

        //get all the submitted data from the form
        $image = $_FILES['image']['name'];
        $text = $_POST['text'];

        $sql = "INSERT INTO images (image, text) VALUES ('$image','$text')";
        mysqli_query($db,$sql);//stores the submitted data into the database table:images

        //now let's move the uploaded image into the folder: images
        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg = "Image uploaded successfully";
        }else{
            $msg = "There was a problem uploading image";
        }



    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <style>
        #content{
             width: 50%;
             margin: 20px auto;
             border: 1px solid #cbcbcb;
        }
        form{
            width: 50%;
            margin: 20px auto;
        }
        form div{
            margin-top: 5px;
        }
        #img_div{
            width: 80%;
            padding: 5px;
            margin: 15px auto;
            border: 1px solid #cbcbcb;
        }
        #img_div:after{
            content:"";
            display: block;
            clear: both;
        }
        img{
            float: left;
            margin: 5px;
            width: 300px;
            height: 140px;
        }

    </style>
</head>
<body>
    <div id="content">
    <?php 
     $db = mysqli_connect("localhost","root","","test");
    $sql = "SELECT * FROM images";
    $result = mysqli_query($db,$sql);
    while($row = mysqli_fetch_array($result)){
        echo "<div id='img_div'>";
        echo "<img src='images/".$row['image']."'>";
        echo "<p>".$row['text']."</p>";
        echo "</div>";
    }
    ?>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <div>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <textarea name="text" id="" cols="40" rows="4" placeholder="Say something about this image....."></textarea>
        </div>
        <div>
            <input type="submit" name="upload" value="Upload Image">
        </div>
    </form>
    </div>
</body>
</html>