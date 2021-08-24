<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Photo Galery</h1>
        <h3><a href="index.php">Upload Image</a></h3>
        <div class="gallery">
            <?php 
                //reading list of file in the folder
                $file_list = scandir('images/');
               
                foreach ($file_list as $file) {
                   if(substr($file, strlen($file)-3) =='jpg')
                   {
                    echo '<img src="images/' . $file .'">';
                    
                   }
               }
            ?>
        </div>
    </div>

</body>
</html>

