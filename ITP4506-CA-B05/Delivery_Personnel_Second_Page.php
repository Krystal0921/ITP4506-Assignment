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
    <link rel="stylesheet" href="./style/Delivery_Personnel_Second_Page.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Delivery Personnel Second Page</title>
</head>

<body>
    <div class="fieldset">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="./Delivery_Personnel_Main_Page.php"><b>Orders List</b></a>
            <a class="navbar-brand" href="./Delivery_Personnel_Second_Page.php"><b>Orders Info</b></a>
            <a class="navbar-brand" href="./Login.php"><b>Logout</b></a>
        </nav>
    </div>
    <center><hr><h3><b>Order History</b></h3><hr></center>
    <form>
        <div class="fieldset-container">
            <center>
                <table method="POST">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Restaurant Name</th>
                            <th>Restaurant Address</th>
                            <th>Delivery Address</th>
                            <th>Customer Name</th>
                            <th>Customer Phone Number</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $delivery_personnel_history_list_array = delivery_personnel_history_list($user->user_ID);
                            foreach ($delivery_personnel_history_list_array as $delivery_personnel_history_lists) {
                        ?>
                        <tr>
                            <td><p><?php echo $delivery_personnel_history_lists->o_ID?></p></td>
                            <td><p><?php echo $delivery_personnel_history_lists->r_Name?></p></td>
                            <td><p><?php echo $delivery_personnel_history_lists->r_Address?></p></td>
                            <td><p><?php echo $delivery_personnel_history_lists->o_Delivery_Address?></p></td>
                            <td><p><?php echo $delivery_personnel_history_lists->c_Name?></p></td>
                            <td><p><?php echo $delivery_personnel_history_lists->c_Phone_Number?></p></td>
                            <form action="Delivery_Personnel_Second_Page_Food_List.php">
                                <input type="hidden" value="<?php echo $delivery_personnel_history_lists->r_ID ?>" id="r_ID" name="r_ID">
                                <input type="hidden" value="<?php echo $delivery_personnel_history_lists->o_ID ?>" id="o_ID" name="o_ID">
                                <td><button type="submit" class="btn">Food List</button></td>
                            </form>
                            <form action="Delivery_Personnel_Second_Page_Message.php">
                                <td><button class="message">Message</button></td>
                            </form>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </center>
        </div>
    </form>
</body>

</html>
