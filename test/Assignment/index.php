<?php
include("connection.php");
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <title>Supermarket Management</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--js-->
        <link rel="stylesheet" href="depend\css\bootstrap.min.css">
        <script src="depend\js\jquery.min.js"></script>
        <script src="depend\js\popper.min.js"></script>
        <script src="depend\js\bootstrap.min.js"></script>
        <script src="depend\js\crypto-js.min.js"></script>
        
        <script src="depend\js\index-page.js"></script>
        <link rel="stylesheet" href="depend\css\index-page.css">
        <!--js-->
        <style type="text/css">
        body{ background-image:url('img/b.jpg'); background-size:100% 100%;}
</style>
    </head>
<body>
    <div class="container">
        <div class="d-flex align-items-center flex-column ">
            <div class="p-4 margHeading"></div>
            
            <div class="shadow-lg p-1 mb-5 bg-white rounded">
                <div class="rounded p-2">
                    <h3 class=" rounded heading">Welcome to The Supermarket</h3>
                </div>
                <div class="rounded p-2">
                    <div class="form-group">
                        <label class="form-group" for="username">Username</label>
                        <input type="text" class="form-control" placeholder="Username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label class="form-group" for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" id="password" required>
                    </div>
                    <div class="form-groupt">
                        <input type="button" class="form-control" value="Login" id="btnLogin">
                    </div>
                </div>
            </div>
            <div class="rounded p-2" id="notification">
                    
            </div>
        </div>
    </div>
</body>
</HTML>