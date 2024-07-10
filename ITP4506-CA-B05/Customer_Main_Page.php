<!DOCTYPE html>
<html lang="en">

<?php
    require 'Controller.php';
    session_start();
    if (isset($_GET["restaurant"])) {
        $r_ID = $_GET["r_ID"];
    } else {
        $r_ID = "";
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/nav.css">
    <link rel="stylesheet" href="./style/Customer_Main_Page.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Customer Main Page</title>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const datetimeDisplay = document.getElementById('datetime-display');
            const currentDatetime = new Date();
            const options = { hour12: false, timeZone: 'Asia/Hong_Kong', year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
            const formattedDatetime = currentDatetime.toLocaleString('en-US', options);
            datetimeDisplay.textContent = ("Date: " + formattedDatetime);
        });

        function gotoRestaurant(r_ID, r_Name) {
            const selectedRestaurantString = sessionStorage.getItem('selectedRestaurant');
            let selectedRestaurant = null;
            try {
                selectedRestaurant = JSON.parse(selectedRestaurantString);
            } catch (error) {
                console.error('Error parsing selected restaurant JSON:', error);
            }
            if (selectedRestaurant !== null) {
                if (selectedRestaurant.id !== r_ID) {
                    sessionStorage.setItem('orderFoods', '');
                }
            }
            const jsonString = JSON.stringify({ 'id': r_ID, 'name': r_Name });
            sessionStorage.setItem('selectedRestaurant', jsonString);
            window.location.href = `./Customer_Main_More_Page.php?r_ID=${r_ID}`;
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="./Customer_Main_Page.php"><b>Restaurant Menu</b></a>
        <a class="navbar-brand" href="./Customer_Second_Page.php"><b>Cart</b></a>
        <a class="navbar-brand" href="./Customer_Third_Page.php"><b>Order Record</b></a>
        <label id="username"><b><?php echo "Hello, " . $_SESSION['user']->user_Name ?></b></label>
        <div id="datetime-display" class="datetime"><b>Date: </b></div>
        <div class="nav-right"><a class="navbar-brand" href="./Login.php"><b>Logout</b></a></div>
    </nav>
    <center>
        <div class="fieldset">
            <form method="get" align="center" style="width:100%">
                <hr><h3><b>Restaurant List</b></h3><hr>
                <div class="container1"></div>
                <div class="row">
                    <?php $customer_get_all_restaurant_list_array = customer_get_all_restaurant_list();
                        foreach ($customer_get_all_restaurant_list_array as $customer_get_all_restaurant_lists) {
                    ?>
                    <div class="col-sm">
                        <div class="card" style="width: 17rem;">
                            <img class="card-img-top" src="picture/<?php echo $customer_get_all_restaurant_lists->r_Image?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $customer_get_all_restaurant_lists->r_Name?></h5>
                                <a onclick="gotoRestaurant('<?php echo $customer_get_all_restaurant_lists->r_ID ?>', '<?php echo $customer_get_all_restaurant_lists->r_Name ?>')" class="btn btn-warning">More</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </form>
        </div>
    </center>
</body>

</html>