<!DOCTYPE html>
<html lang="en">

<?php
    require 'Controller.php';
    global $user;
    session_start();
    $user = $_SESSION['user'];
    if (isset($_GET['command'])) {
        if ($_GET['command'] == "choose") {
            $d_ID = $_GET['d_ID'];
            $d_Name = $_GET['d_Name'];
            $d_Phone_Number = $_GET['d_Phone_Number'];
            $d_District = $_GET['d_District'];
            $d_Transportation = $_GET['d_Transportation'];
            restaurant_choose_delivery_persons($d_ID, $user->user_ID, $d_Name, $d_Phone_Number, $d_District, $d_Transportation);
            echo "<script>alert('Delivery Person Choose successfully');</script>";
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Restaurant_Third_Page.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Restaurant Third Page</title>
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
                        <th>Delivery Persons ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Transportation</th>
                        <th>Evaluate</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $restaurant_choose_delivery_persons_list_array = restaurant_choose_delivery_persons_list($user->user_ID);
                        foreach ($restaurant_choose_delivery_persons_list_array as $restaurant_choose_delivery_persons_lists) {
                    ?>
                    <tr>
                        <td><p><?php echo $restaurant_choose_delivery_persons_lists->d_ID?></p></td>
                        <td><p><?php echo $restaurant_choose_delivery_persons_lists->d_Name?></p></td>
                        <td><p><?php echo $restaurant_choose_delivery_persons_lists->d_Phone_Number?></p></td>
                        <td><p><?php echo $restaurant_choose_delivery_persons_lists->d_District?></p></td>
                        <td><p><?php echo $restaurant_choose_delivery_persons_lists->d_Transportation?></p></td>
                        <form>
                            <input type="hidden" name="command" value="choose">
                            <input type="hidden" value="<?php echo $restaurant_choose_delivery_persons_lists->d_ID ?>" id="d_ID" name="d_ID">
                            <input type="hidden" value="<?php echo $restaurant_choose_delivery_persons_lists->d_Name ?>" id="d_Name" name="d_Name">
                            <input type="hidden" value="<?php echo $restaurant_choose_delivery_persons_lists->d_Phone_Number ?>" id="d_Phone_Number" name="d_Phone_Number">
                            <input type="hidden" value="<?php echo $restaurant_choose_delivery_persons_lists->d_District ?>" id="d_District" name="d_District">
                            <input type="hidden" value="<?php echo $restaurant_choose_delivery_persons_lists->d_Transportation ?>" id="d_Transportation" name="d_Transportation">
                            <td><button type="submit" class="choose" onclick="return confirm('Are you sure to Choose?')">Choose</button></td>
                        </form>
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