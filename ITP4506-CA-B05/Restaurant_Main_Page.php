<!DOCTYPE html>
<html lang="en">

<?php
    require 'Controller.php';
    global $user;
    session_start();
    $user = $_SESSION['user'];
    if (isset($_GET['command'])) {
        if ($_GET['command'] == "delete") {
            $f_Name = $_GET['food_name'];
            restaurant_delect_food_list($f_Name, $user->user_ID);
            echo "<script>alert('Food record deleted successfully');</script>";
        }
    } 
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Restaurant_Main_Page.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Restaurant Main Page</title>
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
    <center><hr><h3><b>Food List</b></h3><hr></center>
    <form action="Restaurant_Main_Page_Insert_Food.php" class="form"><center><button type="submit" class="add"><b>Add New Food</b></button></center></form>
    <div class="fieldset-container">
        <center>
            <table>
                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Food Image</th>
                        <th>Food Type</th>
                        <th>Food Price</th>
                        <th>Food Descriptions</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $restaurannt_food_list_array = restaurannt_food_list($user->user_ID);
                        foreach ($restaurannt_food_list_array as $restaurannt_food_lists) {
                    ?>
                    <tr>
                        <td><p><?php echo $restaurannt_food_lists->f_Name?></p></td>
                        <td><img src="picture/<?php echo $restaurannt_food_lists->f_Image?>" width="100px" height="100px"></td>
                        <td><p><?php echo $restaurannt_food_lists->f_Type?></p></td>
                        <td><p><?php echo "$" . $restaurannt_food_lists->f_Price?></p></td>
                        <td><p><?php echo $restaurannt_food_lists->f_descriptions?></p></td>
                        <form action="Restaurant_Main_Page_Modify_Food.php">
                            <input type="hidden" value="<?php echo $restaurannt_food_lists->f_ID ?>" id="f_ID" name="f_ID">
                            <input type="hidden" value="<?php echo $restaurannt_food_lists->f_Name ?>" id="f_Name" name="f_Name">
                            <input type="hidden" value="<?php echo $restaurannt_food_lists->f_Image ?>" id="f_Image" name="f_Image">
                            <input type="hidden" value="<?php echo $restaurannt_food_lists->f_Type ?>" id="f_Type" name="f_Type">        
                            <input type="hidden" value="<?php echo $restaurannt_food_lists->f_Price ?>" id="f_Price" name="f_Price">                   
                            <input type="hidden" value="<?php echo $restaurannt_food_lists->f_descriptions ?>" id="f_descriptions" name="f_descriptions">
                            <td><button type="submit" class="edit">Edit</button></td>
                        </form>
                        <form>
                            <input type="hidden" name="command" value="delete">
                            <input type="hidden" value="<?php echo $restaurannt_food_lists->f_Name ?>" id="food_name" name="food_name">
                            <td><button type="submit" class="delete" onclick="return confirm('Are you sure to delete?')">Delete</button></td>
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