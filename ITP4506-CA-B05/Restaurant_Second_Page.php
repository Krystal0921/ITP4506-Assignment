<!DOCTYPE html>
<html lang="en">

<?php
    require 'Controller.php';
    global $user;
    session_start();
    $user = $_SESSION['user'];
    if (isset($_GET['command'])) {
        if ($_GET['command'] == "done") {
            $o_ID = $_GET['o_ID_done'];
            restaurant_orders_done($o_ID);
            echo "<script>alert('Order done successfully');</script>";
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Restaurant_Second_Page.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Restaurant Second Page</title>
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
    <center><hr><h3><b>Orders List</b></h3><hr></center>
    <div class="fieldset-container">
        <center>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Time</th>
                        <th>Delivery Address</th>
                        <th>Customer Phone Number</th>
                        <th>Food Price</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $restaurant_orders_list_array = restaurant_orders_list($user->user_ID);
                        foreach ($restaurant_orders_list_array as $restaurant_orders_lists) {
                    ?>
                    <tr>
                        <td><p><?php echo $restaurant_orders_lists->o_ID?></p></td>
                        <td><p><?php echo $restaurant_orders_lists->o_Time?></p></td>
                        <td><p><?php echo $restaurant_orders_lists->o_Delivery_Address?></p></td>
                        <td><p><?php echo $restaurant_orders_lists->c_Phone_Number?></p></td>
                        <td><p><?php echo $restaurant_orders_lists->o_Total_Amount?></p></td>
                        <form action="Restaurant_Second_Page_Message.php">
                            <td><button type="submit" class="message" name="order_id" >Message</button></td>
                        </form>
                        <form action="Restaurant_Second_Page_Food_List.php">
                            <input type="hidden" value="<?php echo $restaurant_orders_lists->o_ID ?>" id="o_ID" name="o_ID">
                            <td><button type="submit" class="btn">Food List</button></td>
                        </form>
                        <form>
                            <input type="hidden" name="command" value="done">
                            <input type="hidden" value="<?php echo $restaurant_orders_lists->o_ID ?>" id="o_ID_done" name="o_ID_done">
                            <td><button class="done" onclick="return confirm('Are you sure to the order is done?')">Done</button></td>
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