$(document).ready(function(){
    $("#btnLogin").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();
        var date = new Date();
        date = date.getTime();

        password = CryptoJS.MD5(password).toString();

        $.ajax({
            url: "login.php",
            type: 'POST',
            data: {username: username, password:password},
            success: function(data){
                if (data == "success"){
                    $('#notification').text("Success!!! redirecting...");
                    document.cookie = "username =" +username +";" + date + ";path=/";
                    document.cookie = "password =" +password +";" + date + "; path=/";
                    
                    window.location.href = "panel.php";
                } 
                else
                {
                    $("#notification").text(data);
                }
            }
        });
    });
});