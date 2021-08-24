<?php session_start();?>
<?php require_once('./configure/connection.php'); ?> 
<?php
if(isset($_POST['submit'])){
    $errors = array();

    // check if the username and password has been entered
    if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
        $errors[] = 'Username is Missing / Invalid';
    }

    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
        $errors[] = 'Password is Missing / Invalid';
    }

    // check if there are any errors in the form
    if (empty($errors)) {
        // save username and password into variables
        $email 		= mysqli_real_escape_string($connection, $_POST['email']);
        $password 	= mysqli_real_escape_string($connection, $_POST['password']);
    
        // prepare database query
        $query = "SELECT * FROM user 
                    WHERE email = '{$email}' 
                    AND password = '{$password}' 
                    LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            // query succesfful

            if (mysqli_num_rows($result_set) == 1) {
                // valid user found
                // redirect to users.php
                $user = mysqli_fetch_assoc($result_set);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['first_name'] = $user['first_name'];
                header('Location: user.php');
            } else {
                // user name and password invalid
                $errors[] = 'Invalid Username / Password';
            }
        } else {
            $errors[] = 'Database query failed';
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <form action="index.php" class="form" method="POST">
        <h1>Log In</h1>

        <label for="">Enter User Email</label>
        <input type="" name="email">
        <label for="">Enter the Password</label>
        <input type="password" name="password" id="">
        <button type="submit" name="submit">Log In</button>
        </form>
        <?php 
		if (isset($errors) && !empty($errors)) {
			echo '<p class="error">Invalid Username / Password</p>';
		}
		?>
    </div>
</body>
</html>