<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Create_Account_Customer.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Create Customer Account</title>
    <style>
        body {
          background-image: url('picture/Background.jpg');
          background-size: cover;
          background-repeat: no-repeat;
        }
    </style>
    <script>
        function check_wrong(){
            if(document.getElementById('customer_name').value == ""){
                alert("Name empty!");
            } else if (document.getElementById('customer_phone_number').value == "") {
                alert("Phone Number empty!");
            } else if (document.getElementById('customer_address').value == "") {
                alert("Address empty!");
            } else if (document.getElementById('customer_password').value == "") {
                alert("Password empty!");
            } else if (document.getElementById('customer_password').value != document.getElementById('customer_confirm_password').value) {
                alert("Password Incorrect");
            } else if (!document.getElementById('customer_agreement').checked) {
                alert("Please agree to the terms and conditions.");
                return false; 
            } else {
                document.getElementById('customer_form').submit();
            }
        }
    </script>    
    <?php
        require 'Controller.php';
        if (isset($_POST['customer_name'])) {
            if (check_name($_POST['customer_name'])){
                echo "<script>alert(\"Duplicate Name!\");</script>";
            } else if(check_customer_name($_POST['customer_name'])) {
                echo "<script>alert(\"Duplicate Customer Name!\");</script>";
            } else {
                create_account_customer($_POST['customer_name'], $_POST['customer_password'], $_POST['customer_email_address'], $_POST['customer_phone_number'], $_POST['customer_address']);
                echo "<script>alert(\"Customer Account Success!\");</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; url=Login.php\">";
            }
        }
    ?>
</head>

<body>
    <div class="fieldset">
        <center>
            <div class="hdr2">Fill in all information</div>
            <div class="hdr4">Customer Account</div>
            <form method="post" class="information" id="customer_form">
                <input type="text" id="customer_name" name="customer_name" placeholder="Name (Mandatory)" required/>
                <input type="email" id="customer_email_address" name="customer_email_address" placeholder="Email Address" />
                <input type="text" id="customer_phone_number" name="customer_phone_number" placeholder="Phone Number (Mandatory)" required/>
                <textarea id="customer_address" name="customer_address" rows="4" cols="50" placeholder="Address (Mandatory)" required></textarea>
                <input type="password" id="customer_password" name="customer_password" placeholder="Password (Mandatory)" required/>
                <input type="password" id="customer_confirm_password" name="customer_confirm_password" placeholder="Confirm Password (Mandatory)" required/>
                <table border="0"><tr><td><input type="checkbox" id="customer_agreement" name="customer_agreement" value="agreement" required/></td><td><label for="agreement">&nbsp;&nbsp;Agreeing to the terms and conditions</label></td></tr></table>
                <button type="submit" class="btn btn-warning" onclick="check_wrong()">Create</button> 
            </form>
            <form action="Choose_Create_Account.php"><button type="submit" class="back btn-warning">Back</button></form>
        </center>
    </div>
    <br>
</body>

</html>