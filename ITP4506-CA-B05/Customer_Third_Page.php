<!DOCTYPE html>
<html lang="en">

<?php
    include 'controller.php';
    global $user;
    session_start();
    $user = $_SESSION['user'];
    $user_id = $_SESSION['user']->user_ID;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
    <link rel="stylesheet" href="./style/nav.css">
    <link rel="stylesheet" href="./style/Customer_Third_Page.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Customer Third Page</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const datetimeDisplay = document.getElementById('datetime-display');
            const currentDatetime = new Date();
            const options = { hour12: false, timeZone: 'Asia/Hong_Kong', year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
            const formattedDatetime = currentDatetime.toLocaleString('en-US', options);
            datetimeDisplay.textContent = ("Date: " + formattedDatetime);
        });
    </script>
    <script>
        function orderDetail(orderId) {
            const selectedOrderString = sessionStorage.getItem('selectedOrder');
            selectedOrder = JSON.parse(selectedOrderString);
            const jsonString = JSON.stringify({'id': orderId});
            sessionStorage.setItem('selectedOrder', jsonString);
            window.location.href = "./Customer_Third_Page_Order_Details.php?orderId=" + orderId + "";
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
    <center><hr><h3><b>Order Record</b></h3><hr></center>
    <form>
        <div class="fieldset-container">
            <center>
                <table method="POST">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Order Number</th>
                            <th>Restaurant</th>
                            <th>Delivery Address</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $orderList = getAllOrder($user_id);
                            foreach ($orderList as $orders) {
                            $r_name = getRestaurantName($orders->r_ID);         
                        ?>
                        <tr id="tr_<?php echo $orders->o_ID ?>">
                            <td><div><div><p><?php echo $orders->o_Time?>&nbsp;</p></div></div></td>
                            <td><p><?php echo $orders->o_ID?>&nbsp;</p></td>
                            <td><p><?php echo $r_name?>&nbsp;</p></td>
                            <td><p><?php echo $orders->o_Delivery_Time ?></p></td>
                            <td><p><?php echo "$" . $orders->o_Total_Amount ?></p></td>
                            <td><p><?php echo $orders->o_Status ?></p></td>
                            <td><a onclick="orderDetail('<?php echo $orders->o_ID ?>')" class="btn">Order Detail</a></td>
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