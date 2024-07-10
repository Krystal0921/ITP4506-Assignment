<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Restaurant_Main_Page_Insert_Food.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Restaurant Insert Food Page</title>
    <?php
        require 'Controller.php';
        global $user;
        session_start();
        $user = $_SESSION['user'];

        if (isset($_POST['f_Name'])) {
            $filename = $_FILES["f_Image"]["name"];
            $tempname = $_FILES["f_Image"]["tmp_name"];
            $folder = "./picture/" . $filename;
            if (move_uploaded_file($tempname, $folder)) {
                restaurannt_insert_food_list($_POST['f_Name'],  $filename, $_POST['f_Type'], $_POST['f_Price'], $_POST['f_descriptions'], ($user->user_ID));
                echo "<script>alert(\"Food Insert Success!\");</script>";
            }
        }
    ?>
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
    <center><hr><h3><b>Add Food</b></h3><hr></center>
    <center>
        <fieldset>
            <form method="POST" enctype="multipart/form-data">
                <table>
                    <label>Name : </label><input class="input" type="text" id="f_Name" name="f_Name" class="textbox" required/><br>
                    <label>Image : </label><input class="image" type="file" id="f_Image" name="f_Image"/><br>
                    <label>Type : </label><input class="input" type="text" id="f_Type" name="f_Type"/><br>
                    <label>Price : </label><input class="input" type="text" id="f_Price" name="f_Price" class="textbox" required/><br>
                    <label>Food Descriptions : </label><textarea id="f_descriptions" name="f_descriptions" rows="4" cols="31" placeholder="Food Descriptions" required></textarea>
                    <button type="submit" class="insert"><b>Insert</b></button>
                </table>
            </form>
        </fieldset>
    </center>
</body>
</html>