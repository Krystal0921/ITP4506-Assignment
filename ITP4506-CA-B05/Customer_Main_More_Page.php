<!DOCTYPE html>
<html lang="en">

<?php
    require 'Controller.php';
    session_start();
    if (isset($_GET["r_ID"])) {
        $types = getTypeByResturant($_GET["r_ID"]);
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/nav.css">
    <link rel="stylesheet" href="./style/Customer_Main_More_Page.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Customer Fourth Page</title>
    <script>
        document.addEventListener("DOMContentLoaded", function()
        {
            const datetimeDisplay = document.getElementById('datetime-display');
            const currentDatetime = new Date();
            const options = { hour12: false, timeZone: 'Asia/Hong_Kong', year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
            const formattedDatetime = currentDatetime.toLocaleString('en-US', options);
            datetimeDisplay.textContent = ("Date: " + formattedDatetime);
        });
    </script>
    <script>
        let orderFoods = [];
        try {
            const objectListString = sessionStorage.getItem('orderFoods');
            orderFoods = JSON.parse(objectListString);
            if (objectListString !== null) {
                orderFoods = JSON.parse(objectListString);
                refreshOrder();
            } else {
                orderFoods = [];
            }
        } catch {
        }

        const selectedRestaurantString = sessionStorage.getItem('selectedRestaurant');
        selectedRestaurant = JSON.parse(selectedRestaurantString);
        document.getElementById("restaurant_name").innerHTML = selectedRestaurant.name;
        function addQuantity(f_ID, f_Name, f_Price, r_ID) {
        if (orderFoods.length == 0) {
            orderFoods.push({
                "id": f_ID,
                "rid": r_ID,
                "name": f_Name,
                "qty": 1,
                "price": f_Price
            })
        } else {
            if (orderFoods.find(item => item.id === f_ID) == null) {
                orderFoods.push({
                    "id": f_ID,
                    "rid": r_ID,
                    "name": f_Name,
                    "qty": 1,
                    "price": f_Price
                })
            } else {
                item = orderFoods.find(item => item.id === f_ID);
                item.qty++;
            }
        }
        refreshOrder();
    }

    function deleteQuantity(f_ID, f_Name, f_Price, r_ID)
    {
        if (orderFoods.find(item => item.id === f_ID) == null) {
        } else {
            item = orderFoods.find(item => item.id === f_ID);
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

    function refreshOrder()
    {
        var totalAmount = 0;
        document.getElementById("food_cart").innerHTML = "";
        orderFoods.forEach(function (food) {
            totalAmount += food.price * food.qty;
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
            parentDiv.style.display = 'flex';
            parentDiv.style.alignItems = 'center'
            parentDiv.appendChild(minusBtn);
            parentDiv.appendChild(quantityInput);
            parentDiv.appendChild(plusBtn);
            listItemPanel.appendChild(parentDiv);
            listItem.appendChild(listItemPanel);
            document.getElementById("food_cart").appendChild(listItem);
        });
        document.getElementById("orderTotal").textContent = '$ ' + totalAmount;
        const jsonString = JSON.stringify(orderFoods);
        sessionStorage.setItem('orderFoods', jsonString);
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
    </center>
    <h2 id="restaurant_name"></h2>
    <center><hr><h3><b>Menu</b></h3><hr></center>
    <center>
    <div class="fieldset">
        <?php
            foreach ($types as $type) {
        ?>
        <h2><b><?php echo $type->type ?></b></h2>
        <div class="row">
            <?php 
                foreach ($type->foods as $food) {
            ?>
            <div class="col-11"></div>
            <div class="alert alert-warning" role="alert">
                <?php echo $food->f_Name ?>
                $<?php echo $food->f_Price ?>
            </div>
            <div>
                <img class="card-img-top" src="picture/<?php echo $food->f_Image?>" width="50px" height="50px">
            </div>
            <div class="col-4">
                <button class="minus-btn" onclick="deleteQuantity('<?php echo $food->f_ID ?>','<?php echo $food->f_Name ?>','<?php echo $food->f_Price ?>','<?php echo $food->r_ID ?>')">-</button>
                <input class="quantity-input" type="number" value="1" min="0">
                <button class="plus-btn" onclick="addQuantity('<?php echo $food->f_ID ?>','<?php echo $food->f_Name ?>','<?php echo $food->f_Price ?>','<?php echo $food->r_ID ?>')">+</button>
            </div>
            <?php
                } 
            ?>
        </div>
        <?php
            } 
        ?>
    </div>
    </center>
    <br><br>
    <div class="cart">
        <h3>Your Cart</h3>
        <table>
            <thead>
                <tr>
                    <th>Food </th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody id="food_cart">
            </tbody>
        </table>
        <div>
            <strong>Total Amount:</strong>
            <span id="orderTotal">$0.00</span>
        </div>
        <a href="./Customer_Second_Page.php" class="btn">Checkout</a>
    </div>
</body>

</html>