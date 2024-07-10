<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Create_Account_Restaurant.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Create Customer Restaurant</title>
    <style>
        body {
          background-image: url('picture/Background.jpg');
          background-size: cover;
          background-repeat: no-repeat;
        }
    </style>
    <script>
        function check_wrong(){
            if(document.getElementById('restaurant_name').value == ""){
                alert("Name empty!");
            } else if (document.getElementById('restaurant_telephone_number').value == "") {
                alert("Telephone Number empty!");
            } else if (document.getElementById('restaurant_address').value == "") {
                alert("Address empty!");
            } else if (document.getElementById('restaurant_password').value == "") {
                alert("Password empty!");
            } else if (document.getElementById('restaurant_password').value != document.getElementById('restaurant_confirm_password').value) {
                alert("Password Incorrect");
            } else {
                document.getElementById('customer_form').submit();
            }
        }
    </script>
    <?php
        require 'Controller.php';
        if (isset($_POST['restaurant_name'])) {
            if (check_name($_POST['restaurant_name'])){
                echo "<script>alert(\"Duplicate Name!\");</script>";
            } else if (check_restaurant_name($_POST['restaurant_name'])){
                echo "<script>alert(\"Duplicate Restaurant Name!\");</script>";
            } else {
                create_account_restaurant($_POST['restaurant_name'], $_POST['restaurant_password'], $_POST['restaurant_address'], $_POST['restaurant_telephone_number'], $_POST['restaurant_image']);
                echo "<script>alert(\"Restaurant Account Success!\");</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; url=Login.php\">";
            }
        }
    ?>
</head>

<body>
    <div class="fieldset">
        <center>
            <div class="hdr2">Fill in all information</div>
            <div class="hdr4">Resstaurant Account</div>
            <form method="post" class="information">
                <input type="text" id="restaurant_name" name="restaurant_name" placeholder="Name (Mandatory)" required/>
                <input type="text" id="restaurant_telephone_number" name="restaurant_telephone_number" placeholder="Phone Number (Mandatory)" required/>
                <input type="file" id="restaurant_image" name="restaurant_image">
                <textarea id="restaurant_address" name="restaurant_address" rows="4" cols="50" placeholder="Address (Mandatory)" required></textarea>
                <input type="password" id="restaurant_password" name="restaurant_password" placeholder="Password (Mandatory)" required/>  
                <input type="password" id="restaurant_confirm_password" name="restaurant_confirm_password" placeholder="Confirm password (Mandatory)" required/>
                <button type="submit" class="btn btn-warning" onclick="check_wrong()">Create</button>
            </form>
            <form action="Choose_Create_Account.php"><button type="submit" class="back btn-warning">Back</button></form>
        </center>
    </div>
    <br>
</body>

</html>