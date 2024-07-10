<!DOCTYPE html>
<html lang="en">

<?php
    require 'Controller.php';
    session_start();
    $user = $_SESSION['user'];
    $food_list = restaurannt_food_list($user->user_ID);
    if (isset($_GET['command'])) {
        $f_ID = $_GET['f_ID'];
        $f_Name = $_GET['f_Name'];
        $f_Image = $_GET['f_Image'];
        $f_Type = $_GET['f_Type'];
        $f_Price = $_GET['f_Price'];
        $f_descriptions = $_GET['f_descriptions'];
        $r_ID = $user->user_ID;
        $result = restaurant_modify_food($f_ID, $f_Name, $f_Image, $f_Type, $f_Price, $f_descriptions, $r_ID);
        echo "<script>alert(\"Update successfully\")</script>";
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Restaurant_Main_Page_Modify_Food.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Restaurant Modify Food Page</title>
    <script>
        window.onload = function()
        {
            food_image_change();
        }
    </script>
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
    <center><hr><h3><b>Edit Food</b></h3><hr></center>
    <center>
        <fieldset>
            <form method="GET">
                <table>
                    <input type="hidden" id="command" name="command" value="update">
                    <input type="hidden" value="<?php echo $_GET['f_ID'] ?>" id="f_ID" name="f_ID">
                    <label>Name : </label><input class="input" type="text" id="f_Name" name="f_Name" class="textbox" value="<?php echo $_GET['f_Name'] ?>" required/><br>
                    <label>Image Name : </label><input class="image" type="text" id="f_Image" name="f_Image" value="<?php echo $_GET['f_Image']?>" readonly="readonly"/><br>
                    <label>Image : </label><input class="image" type="file" id="f_Image" name="f_Image" value="picture/<?php echo $_GET['f_Image']?>" /><br>
                    <label>Type : </label><input class="input" type="text" id="f_Type" name="f_Type" value="<?php echo $_GET['f_Type'] ?>"/><br>
                    <label>Price : </label><input class="input" type="text" id="f_Price" name="f_Price" class="textbox" value="<?php echo $_GET['f_Price'] ?>" required/><br>
                    <label>Food Descriptions : </label><textarea id="f_descriptions" name="f_descriptions" rows="4" cols="31" required><?php echo $_GET['f_descriptions'] ?></textarea>
                    <button type="submit" id="submit" name="submit" class="edit"><b>Modify</b></button>
                </table>
            </form>
        </fieldset>
    </center>
</body>

</html>