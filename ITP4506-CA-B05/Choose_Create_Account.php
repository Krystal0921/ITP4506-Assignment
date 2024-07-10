<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Choose_Account.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Choose Create Account</title>
    <style>
        body {
          background-image: url('picture/Background.jpg');
          background-size: cover;
          background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class="fieldset">
        <center>
            <div class="hdr2">Choose Your Type</div>
            <form action="Create_Account_Customer.php"><button type="submit" class="btn btn-warning">Customer</button></form>
            <form action="Create_Account_Restaurant.php"><button type="submit" class="btn btn-warning">Restaurant</button></form>
            <form action="Create_Account_Delivery_Personnel.php"><button type="submit" class="btn btn-warning">Delivery Personnel</button></form>
            <form action="Login.php"><button type="submit" class="btn btn-warning">Back</button></form>
        </center>
    </div>
</body>

</html>