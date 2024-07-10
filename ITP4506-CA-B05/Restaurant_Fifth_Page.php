<!DOCTYPE html>
<html lang="en">

<?php
    require 'Controller.php';
    global $user;
    session_start();
    $user = $_SESSION['user'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Restaurant_Fourth_Page.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Restaurant Fourth Page</title>
</head>

<body>
    <div class="fieldset">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="./Restaurant_Main_Page.php"><b>Foods List</b></a>
            <a class="navbar-brand" href="./Restaurant_Second_Page.php"><b>Orders List</b></a>
            <a class="navbar-brand" href="./Restaurant_Third_Page.php"><b>Orders History</b></a>
            <a class="navbar-brand" href="./Restaurant_Fourth_Page.php"><b>Choose Delivery Person</b></a>
            <a class="navbar-brand" href="./Restaurant_Fifth_Page.php"><b>Delivery Person List</b></a>
            <a class="navbar-brand" href="./Login.php"><b>Logout</b></a>
        </nav>
    </div>
    <center><hr><h3><b>Delivery Persons List</b></h3><hr></center>
    <div class="fieldset-container">
        <center>
            <table method="POST">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Transportation</th>
                        <th>Evaluate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $restaurant_delivery_persons_list_array = restaurant_delivery_persons_list($user->user_ID);
                        foreach ($restaurant_delivery_persons_list_array as $restaurant_delivery_persons_lists) {
                    ?>
                    <tr>
                        <td><p><?php echo $restaurant_delivery_persons_lists->d_ID?></p></td>
                        <td><p><?php echo $restaurant_delivery_persons_lists->d_Name?></p></td>
                        <td><p><?php echo $restaurant_delivery_persons_lists->d_Phone_Number?></p></td>
                        <td><p><?php echo $restaurant_delivery_persons_lists->d_Transportation?></p></td>
                        <td><p><?php echo $restaurant_delivery_persons_lists->d_District?></p></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </center>
    </div>
</body>

</html>