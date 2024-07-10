<!DOCTYPE html>
<html lang="en">

<?php
    include 'controller.php';
    global $user;
    session_start();
    $user = $_SESSION['user'];
    if (isset($_GET["orderId"])) {
        $orderId = $_GET["orderId"];
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/nav.css">
    <link rel="stylesheet" href="./style/Customer_Fifth_Page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Customer Fifth Page</title>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const datetimeDisplay = document.getElementById('datetime-display');
            const currentDatetime = new Date();
            const options = { hour12: false, timeZone: 'Asia/Hong_Kong', year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
            const formattedDatetime = currentDatetime.toLocaleString('en-US', options);
            datetimeDisplay.textContent = ("Date: " + formattedDatetime);
        });
    </script>
    <script>
        const selectedOrderString = sessionStorage.getItem('selectedOrder');
        selectedOrder = JSON.parse(selectedOrderString);
        document.getElementById("orderId").innerHTML = selectedOrder.id;
    </script>
    <script>
        function displayRadioValue() {
            var foodRateInput = document.getElementById("foodRate");
            var serviceRateInput = document.getElementById("serviceRate");
            var ele = document.getElementsByTagName('input');
            for (i = 0; i < ele.length; i++) {
                if (ele[i].type === "radio") {
                    if (ele[i].checked) {
                        if (ele[i].name === "rating") {
                            foodRateInput.value = ele[i].value;
                        } else if (ele[i].name === "rating2") {
                            serviceRateInput.value = ele[i].value;
                        }
                    }
                }
            }
            alert("Thank you for your feedback and suggestion");
            window.location.href = "./Customer_Third_Page.php";
        }
    </script>
</head>

<body>
    <center>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="./Customer_Main_Page.php"><b>Restaurant Menu</b></a>
            <a class="navbar-brand" href="./Customer_Second_Page.php"><b>Cart</b></a>
            <a class="navbar-brand" href="./Customer_Third_Page.php"><b>Order Record</b></a>
            <label id="username"><b><?php echo "Hello, " . $_SESSION['user']->user_Name ?></b></label>
            <div id="datetime-display" class="datetime"><b>Date: </b></div>
            <div class="nav-right"><a class="navbar-brand" href="./Login.php"><b>Logout</b></a></div>  
        </nav>
        <form method="POST" action="">
            <div style="width: 70%;">
                <hr><h3><b>Order Detail</b></h3></hr>
                <div class="fieldset-container">
                    <div class="title">
                        <?php
                            $order = getOrder($orderId);
                            $r_name = getRestaurantName($order->r_ID);
                        ?>
                        <p><strong>Date:&nbsp;<?php echo $order->o_Time ?></strong></p>
                        <p><strong>Order Number:&nbsp;<?php echo $order->o_ID ?></strong></p>
                        <p><strong>Restaurant:&nbsp;<?php echo $r_name ?>&nbsp;&nbsp;</strong><a href="./Customer_Third_Page_Message.php" class="btn">Chat</a></p>
                        <p><strong>Delivery Address:&nbsp;<?php echo $order->o_Delivery_Address ?></strong></p>
                        <p>
                            <strong>Payment Method:&nbsp;
                                <?php
                                    if ($order->o_Payment_Method == 1) {
                                        $o_Payment_Method = "Apple Pay";
                                    } elseif ($order->o_Payment_Method == 1) {
                                        $o_Payment_Method = "VISA";
                                    } else {
                                        $o_Payment_Method = "Alipay";
                                    }
                                    echo $o_Payment_Method
                                ?>
                            </strong>
                        </p>
                        <p><strong>Delivery Personnel:&nbsp;<?php $deliveryPersonnel = getDeliveryPersonnel($order->d_ID);echo $deliveryPersonnel ?>&nbsp;&nbsp;</strong><a href="./Customer_Third_Page_Message.php" class="btn">Chat</a></p>
                        <p><strong>Status:&nbsp;<?php echo $order->o_Status ?></strong></p>
                        <p><strong>Estimated delivery time:&nbsp;<?php echo $order->o_Estimated_Time ?></strong></p>
                        <p><strong>Delivery time :&nbsp;<?php echo $order->o_Delivery_Time ?></strong></p>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                            <?php
                                $orderContentList = getOrderDetail($order->o_ID);
                                foreach ($orderContentList as $orderContent) {
                            ?>
                            <tr>
                                <td><?php echo $orderContent->f_Name ?></td>
                                <td><?php echo $orderContent->o_Quantity ?></td>
                                <td><?php echo "$" . $orderContent->f_Price ?></td>
                                <td><?php echo "$" . $orderContent->o_Quantity * $orderContent->f_Price ?></td>
                            </tr>
                        </table>
                    </div>
                    <?php
                        }
                    ?>
                    <br>
                    <?php
                        $o_Total_Amount = $order->o_Total_Amount;
                    ?>
                    <div>
                        <strong style="font-size: large;">Order Amount:</strong>
                        <strong style="font-size: large;"><span><?php echo "$" . $order->o_Total_Amount - $order->o_Delivery_Fee ; ?></span></strong><br>
                        <strong style="font-size: large;">Delivery Fee:</strong>
                        <strong style="font-size: large;"><span><?php echo "$" . $order->o_Delivery_Fee; ?></span></strong><br>
                        <h3>Total : <span class="amount"><?php echo "$" . $order->o_Total_Amount; ?></span></h3>
                    </div>
                    <img src="picture/thanks.jpg" width="400" height="250">
                    <br><br><br>
                    <?php
                        if ($order->o_Status === "Complete"  && $order->o_Comment === "") {
                    ?>
                    <form method="POST" action="">
                        <input name="submit" id="submit" value="123" hidden>
                        <h4 style="center">Customer Feedback Form</h4>
                        <h3>Food Quality:</h3>
                        <span class="star-rating">
                            <input type="radio" name="rating" value="1"><i></i>
                            <input type="radio" name="rating" value="2"><i></i>
                            <input type="radio" name="rating" value="3"><i></i>
                            <input type="radio" name="rating" value="4"><i></i>
                            <input type="radio" name="rating" value="5"><i></i>
                            <input type="radio" name="rating" value="6"><i></i>
                            <input type="radio" name="rating" value="7"><i></i>
                            <input type="radio" name="rating" value="8"><i></i>
                            <input type="radio" name="rating" value="9"><i></i>
                            <input type="radio" name="rating" value="10"><i></i>
                        </span><br>
                        <input type="hidden" name="foodRate" id="foodRate">
                        <h3>Delivery Service:</h3>
                        <span class="star-rating">
                            <input type="radio" name="rating2" value="1"><i></i>
                            <input type="radio" name="rating2" value="2"><i></i>
                            <input type="radio" name="rating2" value="3"><i></i>
                            <input type="radio" name="rating2" value="4"><i></i>
                            <input type="radio" name="rating2" value="5"><i></i>
                            <input type="radio" name="rating2" value="6"><i></i>
                            <input type="radio" name="rating2" value="7"><i></i>
                            <input type="radio" name="rating2" value="8"><i></i>
                            <input type="radio" name="rating2" value="9"><i></i>
                            <input type="radio" name="rating2" value="10"><i></i>
                        </span><br>
                        <input type="hidden" name="serviceRate" id="serviceRate">
                        <textarea id="feedback" name="feedback" rows="5" cols="50" placeholder="Enter your feedback"></textarea>
                        <div style="center">
                            <button type="submit" class="btn" onclick="displayRadioValue()">Submit</button>
                            <button type="reset" class="btn">Reset</button>
                        </div>
                        <?php
                            } elseif ($order->o_Status === "Complete" && $order->o_Comment !=="") {
                        ?>
                        <div class="title" style="border: 1px solid black; padding: 10px;">
                            <td><p><strong>Food Quality Rating:<?php echo $order->o_Food_Rate ?> stars</strong></p></td><br>
                            <p><strong>Delivery Service Rating:<?php echo $order->o_Service_Rate ?>stars</strong></p><br>
                            <p><strong>Comment:<?php echo $order->o_Comment ?></strong></p>
                        </div>
                        <?php
                            }
                            if (isset($_POST['submit'])) {
                                $o_Food_Rate = $_POST['o_Food_Rate'];
                                $o_Service_Rate = $_POST['o_Service_Rate'];
                                $o_Comment = $_POST['o_Comment'];
                                feedback($o_ID, $o_Food_Rate, $o_Service_Rate, $o_Comment);
                                echo "<meta http-equiv=\"refresh\" content=\"0; url=Customer_Third_Page.php\">";
                            }
                        ?>
                    </form>
                </div>
            </div>
        </form>
    </center>
</body>

</html>