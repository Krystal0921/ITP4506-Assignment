<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Create_Account_Delivery_Personnel.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Create Customer Delivery Personnel</title>
    <style>
        body {
          background-image: url('picture/Background.jpg');
          background-size: cover;
          background-repeat: no-repeat;
        }
    </style>
    <script>
        function check_wrong(){
            if(document.getElementById('delivery_personnel_name').value == ""){
                alert("Name empty!");
            } else if (document.getElementById('delivery_personnel_phone_number').value == "") {
                alert("Phone Number empty!");
            } else if (document.getElementById('delivery_personnel_district').value == "") {
                alert("District empty!");
            }  else if (Document.getElementById('delivery_personnel_transportation').value == "") {
                alert("Transportation empty!");
            } else if (document.getElementById('delivery_personnel_password').value == "") {
                alert("Password empty!");
            } else if (document.getElementById('delivery_personnel_password').value != document.getElementById('delivery_personnel_confirm_password').value) {
                alert("Password Incorrect");
            } else {
                document.getElementById('customer_form').submit();
            }
        }
    </script>
    <?php
        require 'Controller.php';
        if (isset($_POST['delivery_personnel_name'])) {
            if (check_name($_POST['delivery_personnel_name'])){
                echo "<script>alert(\"Duplicate Name!\");</script>";
            } else if (check_delivery_personnel_name($_POST['delivery_personnel_name'])){
                echo "<script>alert(\"Duplicate Delivery Personnel Name!\");</script>";
            } else{
                create_account_delivery_personnel($_POST['delivery_personnel_name'], $_POST['delivery_personnel_password'], $_POST['delivery_personnel_phone_number'], $_POST['delivery_personnel_district'], $_POST['delivery_personnel_transportation']);
                echo "<script>alert(\"Delivery Personnel Account Success!\");</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; url=Login.php\">";
            }
        }
    ?>
</head>

<body>
    <div class="fieldset">
        <center>
            <div class="hdr2">Fill in all information</div>
            <div class="hdr4">Delivery Personnel Account</div>
            <form method="post" class="information">
                <input type="text" id="delivery_personnel_name" name="delivery_personnel_name" placeholder="Name (Mandatory)" required/>
                <input type="text" id="delivery_personnel_phone_number" name="delivery_personnel_phone_number" placeholder="Phone Number (Mandatory)" required/>
                <input type="text" id="delivery_personnel_district" name="delivery_personnel_district" placeholder="District (Mandatory)" required/>
                <input type="text" id="delivery_personnel_transportation" name="delivery_personnel_transportation" placeholder="Transportation (Mandatory)" required/>
                <input type="password" id="delivery_personnel_password" name="delivery_personnel_password" placeholder="Password (Mandatory)" required/>
                <input type="password" id="delivery_personnel_confirm_password" name="delivery_personnel_confirm_password" placeholder="Confirm Password (Mandatory)" required/>
                <button type="submit" class="btn btn-warning" onclick="check_wrong()">Create</button>
            </form>
            <form action="Choose_Create_Account.php"><button type="submit" class="back btn-warning">Back</button></form>
        </center>
    </div>
    <br>
</body>

</html>