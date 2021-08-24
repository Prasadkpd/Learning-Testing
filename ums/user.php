<?php session_start();?>
<?php require_once('/xampp/htdocs/ums/configure/connection.php');?>
<?php 
    if(!isset($_SESSION['user_id']))
    {
        header('Location = index.php');
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
    
</head>
<body>
<header>
    <div class="logo">Sportizz</div>
    <nav class="nav">
        <li><a href="">Welcome <?php echo $_SESSION['first_name']; ?></a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#"></a></li>
    </nav>
    
</header>
    <h1>Heloo</h1>
</body>
</html>