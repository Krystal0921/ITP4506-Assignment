<!DOCTYPE html>
<html lang="en">

<?php
    include 'controller.php';
    global $user;
    session_start();
    $user = $_SESSION['user'];

    if (isset($_POST['checkout'])) {
        $o_ID = generateOrderID();
        $c_ID = $user->user_ID ;
        $r_ID = $_POST["selectedRestaurantId"];
        $d_ID = "";
        date_default_timezone_set('Asia/Hong_Kong');
        $o_Time = date("Y-m-d H:i:s");
        $o_Delivery_Address = $_POST['address'];
        $o_Payment_Method = $_POST['payment-select'];
        $o_Status = "Pending to cook";
        $o_Estimated_Time =date("Y-m-d H:i:s", strtotime( $o_Time  . "+1 hour"));
        $o_Delivery_Time = date("Y-m-d H:i:s", strtotime( $o_Time  . "+1 hour"));
        $o_Total_Amount = $_POST["totalID"];
        $o_Delivery_Fee = $_POST["deliveryFeeID"];;
        orderHead($o_ID, $c_ID, $r_ID, $d_ID, $o_Time, $o_Delivery_Address, $o_Payment_Method, $o_Status, $o_Estimated_Time, $o_Delivery_Time, $o_Total_Amount, $o_Delivery_Fee);
        $seqId = 1;
        $i = 1;
        $foodIds = [];
        $quantities = [];
        $foodNames = [];
        while (isset($_POST['foodId' . $i])) {
            $foodId = $_POST['foodId' . $i];
            $foodIds[] = $foodId;
            $foodName = $_POST['foodName' . $i];
            $foodNames[] = $foodName;
            $quantity = $_POST['quantity' . $i];
            $quantities[] = $quantity;
            $i++;
        }
        echo "<script>";
        echo "var orderConfirmation = 'Order confirmed!\\n\\n';";
        echo "orderConfirmation += 'Order ID: $o_ID\\n\\n';";
        foreach ($foodIds as $index => $foodId) {
            $foodId = $foodIds[$index];
            $foodName = $foodNames[$index];
            $quantity = $quantities[$index];
            orderContent($orderId, $foodId, $quantity, $seqId);
            echo "orderConfirmation += '$seqId . Food : $foodName ';";
            echo "orderConfirmation += '  Quantity : $quantity\\n\\n';";
            $seqId++;
        }
        echo "orderConfirmation += 'Estimated Time: $o_Estimated_Time\\n';";
        echo "alert(orderConfirmation);";
        echo "sessionStorage.setItem('orderFoods','');";
        echo "sessionStorage.setItem('selectedRestaurant','');";
        echo "window.location.href = './Customer_Third_Page.php';";
        echo "</script>";
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/nav.css">
    <link rel="stylesheet" href="./style/Customer_Second_Page.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Customer Secound Page</title>       
    <script>
        document.addEventListener("DOMContentLoaded", function()
        {
            const datetimeDisplay = document.getElementById('datetime-display');
            const currentDatetime = new Date();
            const options = { hour12: false, timeZone: 'Asia/Hong_Kong', year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
            const formattedDatetime = currentDatetime.toLocaleString('en-US', options);
            datetimeDisplay.textContent = ("Date: "+formattedDatetime);
        });
    </script>
    <script>
        try {
            const objectListString = sessionStorage.getItem('orderFoods');
            orderFoods = JSON.parse(objectListString);
            refreshOrder();
        } catch { 
        }

        function SetselectedRestaurant()
        {
            const selectedRestaurantString = sessionStorage.getItem('selectedRestaurant');
            selectedRestaurant = JSON.parse(selectedRestaurantString);
            if(selectedRestaurant != null){
                selectedRestaurant.id
                document.getElementById("food_cart").innerHTML = "";
                const selectedRestaurantId = document.createElement('input');
                selectedRestaurantId.id = 'selectedRestaurantId' ;
                selectedRestaurantId.name = 'selectedRestaurantId' ;
                selectedRestaurantId.setAttribute('type', 'hidden');
                selectedRestaurantId.value = selectedRestaurant.id;
                document.getElementById("food_cart").appendChild(selectedRestaurantId);
            }
        }

        function refreshOrder()
        {
            var totalAmount = 0;
            document.getElementById("food_cart").innerHTML = "";
            var row = 1;
            SetselectedRestaurant();

            orderFoods.forEach(function (food) {
                totalAmount += food.price * food.qty;
                const foodId = document.createElement('input');
                foodId.id = 'foodId' + row;
                foodId.name = 'foodId' + row;
                foodId.setAttribute('type', 'hidden');
                foodId.value = food.id;
                document.getElementById("food_cart").appendChild(foodId);
                const foodName = document.createElement('input');
                foodName.id = 'foodName' + row;
                foodName.name = 'foodName' + row;
                foodName.setAttribute('type', 'hidden');
                foodName.value = food.name;
                document.getElementById("food_cart").appendChild(foodName);
                const quantity = document.createElement('input');
                quantity.id = 'quantity' + row;
                quantity.name = 'quantity' + row;
                quantity.setAttribute('type', 'hidden');
                quantity.value = food.qty;
                document.getElementById("food_cart").appendChild(quantity);
                const price = document.createElement('input');
                price.id = 'price' + row;
                price.name = 'price' + row;
                price.setAttribute('type', 'hidden');
                price.value = food.price;
                document.getElementById("food_cart").appendChild(price);
                row++;
                const listItem = document.createElement('tr');
                const listItemName = document.createElement('td');
                listItemName.textContent = food.name;
                const listItemNqty = document.createElement('td');
                listItemNqty.textContent = food.qty;
                const listItemPrice = document.createElement('td');
                listItemPrice.textContent = "$" + food.price;
                const listItemPanel = document.createElement('td');
                listItem.appendChild(listItemName);
                listItem.appendChild(listItemNqty);
                listItem.appendChild(listItemPrice);
                const parentDiv = document.createElement('div');
                const minusBtn = document.createElement('button');
                parentDiv.style.display = 'flex'; 
                parentDiv.style.alignItems = 'center'
                minusBtn.classList.add('minus-btn');
                minusBtn.textContent = '-';
                minusBtn.onclick = function () {
                    deleteQuantity(food.id, food.name, food.price, food.rId);
                };
                const quantityInput = document.createElement('input');
                quantityInput.classList.add('quantity-input');
                quantityInput.type = 'number';
                quantityInput.value = food.qty;
                quantityInput.min = '0';
                const plusBtn = document.createElement('button');
                plusBtn.classList.add('plus-btn');
                plusBtn.textContent = '+';
                plusBtn.onclick = function () {
                    addQuantity(food.id, food.name, food.price, food.rId);
                };
                parentDiv.appendChild(minusBtn);
                parentDiv.appendChild(quantityInput);
                parentDiv.appendChild(plusBtn);
                listItemPanel.appendChild(parentDiv);
                listItem.appendChild(listItemPanel);
                document.getElementById("food_cart").appendChild(listItem);
            });
            var deliveryFee = (totalAmount * 0.1).toFixed(2);
            var total = (parseFloat(totalAmount) + parseFloat(deliveryFee)).toFixed(2);
            document.getElementById("orderTotalD").value = totalAmount;
            document.getElementById("orderTotal").textContent = '$ ' + totalAmount;
            document.getElementById("deliveryFeeID").value = deliveryFee;
            document.getElementById("deliveryFee").textContent = '$ ' + deliveryFee;
            document.getElementById("totalID").value = total;
            document.getElementById("total").textContent = '$ ' + total;
            const jsonString = JSON.stringify(orderFoods);
            sessionStorage.setItem('orderFoods', jsonString);
        }

        function addQuantity(food_id, food_name, food_price, r_Id) {
            if (orderFoods.length == 0) {
                orderFoods.push({
                    "id": food_id,
                    "rid": r_Id,
                    "name": food_name,
                    "qty": 1,
                    "price": food_price
                })
            } else {
                if (orderFoods.find(item => item.id === food_id) == null) {
                    orderFoods.push({
                        "id": food_id,
                        "rid": r_Id,
                        "name": food_name,
                        "qty": 1,
                        "price": food_price
                    })
                } else {
                    item = orderFoods.find(item => item.id === food_id);
                    item.qty++;
                }
            }
            refreshOrder();
        }

        function deleteQuantity(food_id, food_name, food_price, r_Id) {
            if (orderFoods.find(item => item.id === food_id) == null) {

            } else {
                item = orderFoods.find(item => item.id === food_id);
                if (item.qty >= 1) {
                    item.qty--;
                }
                const index = orderFoods.findIndex(item => item.qty === 0);
                if (index !== -1) {
                    orderFoods.splice(index, 1);
                }
            }
            refreshOrder();
        }

        window.onload = function () {
            const selectedRestaurantString = sessionStorage.getItem('selectedRestaurant');
            selectedRestaurant = JSON.parse(selectedRestaurantString);
            document.getElementById("restaurant_name").innerHTML = "Restaurant : " + selectedRestaurant.name;
            document.getElementById("r_ID").innerHTML =selectedRestaurant.id;
            refreshOrder();
        }
    </script>
    <script>
        const objectListString = sessionStorage.getItem('orderFoods');
        objectList = JSON.parse(objectListString);
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
        <div class="fieldset-container">
            <div class="fieldset-content">
                <hr><h3><b>Your Cart</b></h3><h3 id="restaurant_name"></h3></hr>
                <form method="POST" action="">
                    <center>
                        <table>
                            <thead>
                                <tr>
                                    <th>Food </th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="food_cart">
                            </tbody>
                        </table>
                    </center>
                    <input name="checkout" id="checkout" value="123" hidden>
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Delivery Person" value="<?php echo $_SESSION['user']->user_Name; ?>"></input><br>
                        <input type="text" id="phone" name="phone" placeholder="Phone Number" value="<?php echo $_SESSION['user']->user_Phone_Number; ?>"></input> 
                        <textarea id="address" name="address" rows="4" cols="50" placeholder="Delivery Address"><?php echo $_SESSION['user']->user_Address; ?></textarea>
                        <input type="hidden" name="r_ID" id="r_ID" value="<?php echo $r_ID; ?>">
                        <select id="payment-select" name="payment-select"  class="payment-select" required>
                            <option value="1" selected>Apple Pay</option>
                            <option value="2">VISA</option>
                            <option value="3">Alipay</option>
                        </select>
                    </div>
                    <div>
                        <strong style="font-size: large;">Order Amount:</strong>
                        <input type="hidden" name="orderTotalD" id="orderTotalD" value="0.00">
                        <span id="orderTotal">$0.00</span><br>
                        <strong style="font-size: large;">Delivery Fee:</strong>
                        <input type="hidden" name="deliveryFeeID" id="deliveryFeeID" value="0.00">
                        <span id="deliveryFee">$0.00</span><br>
                        <strong style="font-size: large;">Total:</strong>
                        <input type="hidden" name="totalID" id="totalID" value="0.00">
                        <span id="total">$0.00</span>
                    </div>
                    <br>
                    <button type="submit" class="checkout-btn">Checkout</button>
                </form>
            </div>
        </form>
    </center>
</body>

</html>