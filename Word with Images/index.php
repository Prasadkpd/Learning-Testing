<?php 
    $errors = array();

    if(isset($_POST['submit'])){
        // submit button is clicked
        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];
        $temp_name = $_FILES['image']['tmp_name'];

        $upload_to = 'images/';

        if($file_type != 'image/jpeg'){
            $errors[] = 'Only JPEG files are allowed';
            //checking file size
        }
        if($file_size > 5000000){
            $errors[] = 'File size should be lass than 500kb';
        }
        if(empty($errors)){
            $file_uploaded = move_uploaded_file($temp_name,$upload_to . $file_name);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images Upload</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <div class="container">
        <h1>Image Upload</h1>
        <h3>Choose an Image and click Upload</h3>
        <?php 
            if(!empty($errors)){
                echo '<div class="errors">';
                foreach($errors as $error){
                    echo '- '. $error;
                }
                echo '</div>';
            }
        ?>

        <form action="index.php" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="">
            <button type="submit" name="submit">Upload</button>
        </form>
        <?php 
            if(isset($file_uploaded)){
                echo '<h3>Uploaded File</h3>';
                echo '<img src="'. $upload_to . $file_name . '" style="height:400px;width:600px">';
            }
        ?>
        <h3><a href="gallery.php">Photo Gallery</a></h3>
    </div>
</body>
</html>