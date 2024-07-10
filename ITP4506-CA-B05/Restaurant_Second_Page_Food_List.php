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
    <link rel="stylesheet" href="./style/Restaurant_Second_Page_Food_List.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Restaurant Order Food List Page</title>
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
    <center><hr><h3><b>Orders Food List</b></h3><hr></center>
    <div class="fieldset-container">
        <center>
            <form method="GET">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Food ID</th>
                            <th>Food Name</th>
                            <th>Food Image</th>
                            <th>Food Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $restaurant_orders_food_list_array = restaurant_orders_food_list($user->user_ID, $_GET['o_ID']);
                            foreach ($restaurant_orders_food_list_array as $restaurant_orders_food_lists) {
                        ?>
                        <tr>
                            <input type="hidden" value="<?php echo $_GET['o_ID'] ?>" id="o_ID" name="o_ID">
                            <td><p><?php echo $restaurant_orders_food_lists->o_ID?></p></td>
                            <td><p><?php echo $restaurant_orders_food_lists->f_ID?></p></td>
                            <td><p><?php echo $restaurant_orders_food_lists->f_Name?></p></td>
                            <td><p><img src="picture/<?php echo $restaurant_orders_food_lists->f_Image?>" width="100px" height="100px"></p></td>
                            <td><p><?php echo $restaurant_orders_food_lists->o_Quantity?></p></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </form>
        </center>
    </div>
</body>

</html>