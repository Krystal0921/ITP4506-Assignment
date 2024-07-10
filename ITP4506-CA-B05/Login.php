<!DOCTYPE html>
<html lang="en">

<?php
    require 'Controller.php';
    session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Login.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        body {
          background-image: url('picture/Background.jpg');
          background-size: cover;
          background-repeat: no-repeat;
        }
    </style>
    <?php
        if (isset($_POST['user_name']) && isset($_POST['user_password'])) {
            if (customer_login($_POST['user_name'], $_POST['user_password'])) {
                echo "<meta http-equiv=\"refresh\" content=\"0; url=Customer_Main_Page.php\">";
            } else if (restaurant_login($_POST['user_name'], $_POST['user_password'])){
                echo "<meta http-equiv=\"refresh\" content=\"0; url=Restaurant_Main_Page.php\">";
            } else if (delivery_personnel_login($_POST['user_name'], $_POST['user_password'])){
                echo "<meta http-equiv=\"refresh\" content=\"0; url=Delivery_Personnel_Main_Page.php\">";
            } 
        } else {
            echo "error";
        }
    ?>
</head>

<body>
    <div class="fieldset">
        <center>
            <form method="post">
                <img src="picture/Logo.png" width="290" height="290">
                <input type="text" id="user_name" name="user_name" placeholder="User Name" required><br>
                <input type="password" id="user_password" name="user_password" placeholder="Password" required><br>
                <button name="login" class="btn btn-warning">Login</button>
            </form>
            <form action="Choose_Create_Account.php" class="choose_create_account"><button type="submit" class="btn btn-warning" action="Choose_Create_Account.html">Create Account</button></form>
        </center>
    </div>
</body>

</html>