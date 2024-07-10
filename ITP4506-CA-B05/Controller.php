<?php
    require 'Database.php';
    require 'model/customer.php';
    require 'model/restaurant.php';
    require 'model/delivery_personel.php';
    require 'model/user.php';
    require 'model/food.php';
    require 'model/menu.php';
    require 'model/order.php';
    require 'model/restaurant_orders_list.php';
    require 'model/restaurant_orders_food_list.php';
    require 'model/order_detail.php';
    require 'model/order_content.php';
    require 'model/restaurant_delivery_list.php';
    require 'model/delivery_personnel_restaurant_orders_list.php';
    global $user;
    $user = new user("", "", "", "", "", "", "", "", "", "") ;

//Delivery Personnel Page Command
    function delivery_personnel_history_list($user_ID)
    {
        global $conn;
        $delivery_personnel_history_list_array = array();
        $sql = "SELECT o.o_ID, r.r_ID, r.r_Name, r.r_Address, o.o_Delivery_Address, c.c_Name, c.c_Phone_Number
                FROM `itp4506-ca`.order o
                JOIN `itp4506-ca`.customer c ON o.c_ID = c.c_ID
                JOIN `itp4506-ca`.restaurant r ON r.r_ID = o.r_ID
                WHERE o.d_ID = \"$user_ID\"
                ORDER BY o.o_ID ASC;";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $delivery_personnel_history_lists = new delivery_personnel_restaurant_orders_list($rc['o_ID'], $rc['r_ID'], $rc['r_Name'], $rc['r_Address'], $rc['o_Delivery_Address'], $rc['c_Name'], $rc['c_Phone_Number']);
            array_push($delivery_personnel_history_list_array, $delivery_personnel_history_lists);
        }
        return $delivery_personnel_history_list_array;
    }

    function delivery_personnel_accept_change_active($user_ID, $user_Name)
    {
        global $conn;
        $sql = "UPDATE `itp4506-ca`.`delivery_personnel` 
                SET `active` = '0' 
                WHERE (`d_ID` = \"$user_ID\") and (`d_Name` = \"$user_Name\");";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    function delivery_personnel_accept_change_d_ID_status($d_ID, $o_ID)
    {
        global $conn;
        $Status = "Pending to delivery";
        $sql = "UPDATE `itp4506-ca`.`order` 
                SET `d_ID` = \"$d_ID\", `o_Status` = \"$Status\" 
                WHERE (`o_ID` = \"$o_ID\");";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    function delivery_personnel_restaurant_orders_food_list($r_ID, $o_ID)
    {
        global $conn;
        $delivery_personnel_restaurant_orders_food_list_array = array();
        $sql = "SELECT o.o_ID, o.r_ID, oc.o_ID, oc.o_Quantity, oc.f_ID, f.f_ID, f.f_Name, f.f_Image
                FROM `itp4506-ca`.order o, `itp4506-ca`.order_content oc, `itp4506-ca`.food f 
                WHERE oc.f_ID = f.f_ID AND o.o_ID = oc.o_ID AND oc.o_ID = '" . $o_ID . "' AND o.r_ID = '" . $r_ID . "'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $delivery_personnel_restaurant_orders_food_lists = new restaurant_orders_food_list($rc['o_ID'], $rc['r_ID'], $rc['f_ID'], $rc['o_Quantity'], $rc['f_Name'], $rc['f_Image']);
            array_push($delivery_personnel_restaurant_orders_food_list_array, $delivery_personnel_restaurant_orders_food_lists);
        }
        return $delivery_personnel_restaurant_orders_food_list_array;
    }

    function delivery_personnel_restaurant_orders_list($user_ID)
    {
        global $conn;
        $delivery_personnel_restaurant_orders_list_array = array();
        $sql = "SELECT o.o_ID, r.r_ID, r.r_Name, r.r_Address, o.o_Delivery_Address, c.c_Name, c.c_Phone_Number
                FROM `itp4506-ca`.order o
                JOIN `itp4506-ca`.restaurant_delivery_list rd ON o.r_ID = rd.r_ID
                JOIN `itp4506-ca`.delivery_personnel d ON rd.d_ID = d.d_ID
                JOIN `itp4506-ca`.customer c ON o.c_ID = c.c_ID
                JOIN `itp4506-ca`.restaurant r ON r.r_ID = o.r_ID
                WHERE d.active = 1 AND o.o_Status = 'Pending to take away' AND o.d_ID = '' AND rd.d_ID = '" . $user_ID . "' 
                ORDER BY o.o_ID ASC";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $delivery_personnel_restaurant_orders_lists = new delivery_personnel_restaurant_orders_list($rc['o_ID'], $rc['r_ID'], $rc['r_Name'], $rc['r_Address'], $rc['o_Delivery_Address'], $rc['c_Name'], $rc['c_Phone_Number']);
            array_push($delivery_personnel_restaurant_orders_list_array, $delivery_personnel_restaurant_orders_lists);
        }
        return $delivery_personnel_restaurant_orders_list_array;
    }




//Restaurant Page Command
    function restaurant_delivery_persons_list($user_ID)
    {
        global $conn;
        $restaurant_delivery_persons_list_array = array();
        $sql = "SELECT * FROM restaurant_delivery_list WHERE r_ID = '" . $user_ID . "' ORDER BY r_d_List_Number ASC";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $restaurant_delivery_persons_list = new restaurant_delivery_list($rc['d_ID'], $rc['r_ID'], $rc['d_Name'], $rc['d_Phone_Number'], $rc['d_District'], $rc['d_Transportation']);
            array_push($restaurant_delivery_persons_list_array, $restaurant_delivery_persons_list);
        }
        return $restaurant_delivery_persons_list_array;
    }

    function r_d_List_Number_add()
    {
        global $conn;
        $sql = "SELECT COUNT(*) AS r_d_List_Number FROM `itp4506-ca`.restaurant_delivery_list";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $rc = mysqli_fetch_array($rs);
        $next_r_d_List_Number = $rc['r_d_List_Number'];
        $next_r_d_List_Number++;
        $next_r_d_Number = sprintf($next_r_d_List_Number);  
        return $next_r_d_Number; 
    }

    function restaurant_choose_delivery_persons($d_ID, $r_ID, $d_Name, $d_Phone_Number, $d_District, $d_Transportation)
    {
        global $conn;
        $new_r_d_List_Number = r_d_List_Number_add();
        $sql = "INSERT INTO `itp4506-ca`.`restaurant_delivery_list` (r_d_List_Number, d_ID, r_ID, d_Name, d_Phone_Number, d_District, d_Transportation)
                VALUES (\"$new_r_d_List_Number\", \"$d_ID\", \"$r_ID\", \"$d_Name\", \"$d_Phone_Number\", \"$d_District\", \"$d_Transportation\");";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    function restaurant_choose_delivery_persons_list($user_ID)
    {
        global $conn;
        $restaurant_choose_delivery_persons_list_array = array();
        $sql = "SELECT d.d_ID, d.d_Name, d.d_Password, d.d_Phone_Number, d.d_District, d.d_Transportation
                FROM `itp4506-ca`.delivery_personnel d
                WHERE d.d_ID NOT IN (
                    SELECT rd.d_ID
                    FROM `itp4506-ca`.restaurant_delivery_list rd
                    WHERE rd.r_ID = '" . $user_ID . "')";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $restaurant_choose_delivery_persons_lists = new delivery_personel($rc['d_ID'], $rc['d_Name'], $rc['d_Password'], $rc['d_Phone_Number'], $rc['d_District'], $rc['d_Transportation']);
            array_push($restaurant_choose_delivery_persons_list_array, $restaurant_choose_delivery_persons_lists);
        }
        return $restaurant_choose_delivery_persons_list_array;
    }

    function restaurant_orders_done($o_ID)
    {
        global $conn;
        $Status = "Pending to take away";
        $sql = "UPDATE `itp4506-ca`.`order` 
                SET o_Status = \"$Status\"
                WHERE (`o_ID` = \"$o_ID\");";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    function restaurant_orders_history_list($user_ID)
    {
        global $conn;
        $restaurant_orders_list_array = array();
        $sql = "SELECT o.o_ID, o.c_ID, o.r_ID, o.o_Time, o.o_Delivery_Address, c.c_ID, c.c_Phone_Number, o.o_Total_Amount
                FROM `itp4506-ca`.order o, `itp4506-ca`.customer c 
                WHERE o.c_ID = c.c_ID AND o.r_ID = '" . $user_ID . "'
                ORDER BY o.o_ID DESC";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $restaurant_orders_lists = new restaurant_orders_list($rc['o_ID'], $rc['c_ID'], $rc['r_ID'], $rc['o_Time'], $rc['o_Delivery_Address'], $rc['c_Phone_Number'], $rc['o_Total_Amount']);
            array_push($restaurant_orders_list_array, $restaurant_orders_lists);
        }
        return $restaurant_orders_list_array;
    }

    function restaurant_orders_food_list($user_ID, $o_ID)
    {
        global $conn;
        $restaurant_orders_list_food_array = array();
        $sql = "SELECT o.o_ID, o.r_ID, oc.o_ID, oc.o_Quantity, oc.f_ID, f.f_ID, f.f_Name, f.f_Image
                FROM `itp4506-ca`.order o, `itp4506-ca`.order_content oc, `itp4506-ca`.food f 
                WHERE oc.f_ID = f.f_ID AND o.o_ID = oc.o_ID AND oc.o_ID = '" . $o_ID . "' AND o.r_ID = '" . $user_ID . "'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $restaurant_orders_food_lists = new restaurant_orders_food_list($rc['o_ID'], $rc['r_ID'], $rc['f_ID'], $rc['o_Quantity'], $rc['f_Name'], $rc['f_Image']);
            array_push($restaurant_orders_list_food_array, $restaurant_orders_food_lists);
        }
        return $restaurant_orders_list_food_array;
    }

    function restaurant_orders_list($user_ID)
    {
        global $conn;
        $restaurant_orders_list_array = array();
        $sql = "SELECT o.o_ID, o.c_ID, o.r_ID, o.o_Time, o.o_Delivery_Address, c.c_ID, c.c_Phone_Number, o.o_Total_Amount
                FROM `itp4506-ca`.order o, `itp4506-ca`.customer c 
                WHERE o.c_ID = c.c_ID AND o_Status = 'Pending to cook' AND o.r_ID = '" . $user_ID . "'
                ORDER BY o.o_ID DESC";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $restaurant_orders_lists = new restaurant_orders_list($rc['o_ID'], $rc['c_ID'], $rc['r_ID'], $rc['o_Time'], $rc['o_Delivery_Address'], $rc['c_Phone_Number'], $rc['o_Total_Amount']);
            array_push($restaurant_orders_list_array, $restaurant_orders_lists);
        }
        return $restaurant_orders_list_array;
    }

    function restaurant_delect_food_list($f_Name, $user_ID)
    {
        global $conn;
        $sql = "DELETE FROM food 
                WHERE f_Name = \"$f_Name\" AND r_ID = \"$user_ID\";";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    FUNCTION restaurant_modify_food($f_ID, $f_Name, $f_Image, $f_Type, $f_Price, $f_descriptions, $r_ID)
    {
        global $conn;
        $food = new food('', '', '', '', '', '', '');
        $sql = "UPDATE food 
                SET f_Name = \"$f_Name\", f_Image = \"$f_Image\", f_Type = \"$f_Type\", f_Price = $f_Price, f_descriptions = \"$f_descriptions\"
                WHERE f_ID = \"$f_ID\" AND r_ID = \"$r_ID\";";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    function get_new_food_id($get_type)
    {
        global $conn;
        $next_food_id = 0;
        $sql = "SELECT Seq_ID, Seq_Header FROM id_number WHERE Seq_Name = '" . $get_type . "';";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $rc = mysqli_fetch_array($rs);
        $next_food_id = $rc['Seq_ID'];
        $next_food_id++;
        $sql = "UPDATE id_number
                SET Seq_ID = $next_food_id
                WHERE Seq_Name = '" . $get_type . "';";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));  
        $new_id = sprintf("%s%'.07d", $rc['Seq_Header'], $next_food_id);  
        return $new_id; 
    }

    function restaurannt_insert_food_list($f_Name, $f_Image, $f_Type, $f_Price, $f_descriptions, $r_ID)
    {
        global $conn;
        $new_food_id = get_new_food_id('Food');
        $sql = "INSERT INTO food (f_ID, f_Name, f_Image, f_Type, f_Price, f_descriptions, r_ID, active)
                VALUES (\"$new_food_id\", \"$f_Name\", \"$f_Image\", \"$f_Type\", \"$f_Price\", \"$f_descriptions\", \"$r_ID\", 1);";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    function restaurannt_food_list($user_ID)
    {
        global $conn;
        $restaurannt_food_list_array = array();
        $sql = "SELECT * FROM food WHERE r_ID = '" . $user_ID . "'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $restaurannt_food_list = new food($rc['f_ID'], $rc['f_Name'], $rc['f_Image'], $rc['f_Type'], $rc['f_Price'], $rc['f_descriptions'], $rc['r_ID']);
            array_push($restaurannt_food_list_array, $restaurannt_food_list);
        }
        return $restaurannt_food_list_array;
    }




//Customer Page Command
    function getCustomerDetail($id)
    {
        global $conn;
        $customer = new user('', '', '', '', '', '', '','');
        $sql = "SELECT * FROM customer WHERE id = '" . $id . "'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $customer = new user($rc['c_ID'], $rc['c_Password'], $rc['c_Name'], $rc['c_Email_Address'], $rc['c_Phone_Number'], $rc['c_Address'], "", "");
        }
        return $customer;
    }
    
    function getTypeByResturant($r_ID)
    {
        global $conn;
        $MenuList = array();
        $sql = "SELECT f_Type FROM food WHERE r_ID = '" . $r_ID . "' and active = 1 group by f_Type";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $menu = new menu($rc['f_Type'], getFoodsByType($rc['f_Type'], $r_ID));
            array_push($MenuList, $menu);
        }
        return $MenuList;
    }
    
    function getFoodsByType($type, $r_ID)
    {
        global $conn;
        $FoodList = array();
        $sql = "SELECT * FROM food WHERE  r_ID = '" . $r_ID . "' and f_Type = '" . $type . "' and active = 1";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $food = new food($rc['f_ID'], $rc['f_Name'], $rc['f_Image'], $rc['f_Type'], $rc['f_Price'], $rc['f_descriptions'], $rc['r_ID']);
            array_push($FoodList, $food);
        }
        return $FoodList;
    }
    
    function getAllFood($r_ID)
    {
        global $conn;
        $FoodList = array();
        $sql = "SELECT * FROM food WHERE r_ID = '" . $r_ID . "'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $food = new food($rc['f_ID'], $rc['f_Name'], $rc['f_Image'], $rc['f_Type'], $rc['f_Price'], $rc['f_descriptions'], $rc['r_ID']);
            array_push($FoodList, $food);
        }
        return $FoodList;
    }
    
    function generateOrderID() 
    {
        global $conn;
        $sql = "SELECT COUNT(*) AS total FROM `order`";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($result);
        $totalOrders = $row['total'];
        if ($totalOrders == 0) {
            $newOrderID = 'o0000001';
        } else {
            $sql = "SELECT MAX(o_ID) AS lastOrderID FROM `order`";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $row = mysqli_fetch_assoc($result);
            $lastOrderID = $row['lastOrderID'];
            $lastOrderNumber = intval(substr($lastOrderID, 1)); 
            $newOrderNumber = $lastOrderNumber + 1;
            $newOrderID = 'o' . str_pad($newOrderNumber, 7, '0', STR_PAD_LEFT);
        }
        return $newOrderID;
    }
    
    function orderHead($o_ID, $c_ID, $r_ID, $d_Id, $o_Time, $o_Delivery_Address, $o_Payment_Method, $o_Status, $o_Estimated_Time, $o_Delivery_Time, $o_Total_Amount, $o_Delivery_Fee) 
    {
        global $conn;
        $order = new order('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
        $sql = "INSERT INTO `order` (o_ID, c_ID, r_ID, d_Id, o_Time, o_Delivery_Address, o_Payment_Method, o_Status, o_Estimated_Time, o_Delivery_Time, o_Food_Rate, o_Service_Rate, o_Comment, o_Total_Amount, o_Delivery_Fee, active)
                VALUES ('$o_ID', '$c_ID', '$r_ID', '$d_Id', '$o_Time', '$o_Delivery_Address', '$o_Payment_Method', '$o_Status', '$o_Estimated_Time', '$o_Delivery_Time', 0, 0, '', $o_Total_Amount, $o_Delivery_Fee, 1)";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
    
    function orderContent($o_ID, $f_ID, $o_Quantity, $o_Seq_ID)
    {
        global $conn;
        $orderDetail = new order_detail('', '','','', '', '','');
        $sql = "INSERT INTO ordercontent(o_ID, f_ID, o_Quantity, o_Seq_ID, active)
                VALUES ('$o_ID', '$f_ID', $o_Quantity, $o_Seq_ID, 1);";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
    
    function getOrder($o_ID)
    {
        global $conn;
        $sql = "SELECT *FROM `order` WHERE o_ID = '" . $o_ID . "'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($rc = mysqli_fetch_array($rs)) {
            $order = new order($rc['o_ID'], $rc['c_ID'], $rc['r_ID'], $rc['d_ID'], $rc['o_Time'], $rc['o_Delivery_Address'], $rc['o_Payment_Method'] , $rc['o_Status'], $rc['o_Estimated_Time'],$rc['o_Delivery_Time'],$rc['o_Food_Rate'],$rc['o_Service_Rate'],$rc['o_Comment'], $rc['o_Total_Amount'],$rc['o_Delivery_Fee']);
            return $order;
        }
        return null;
    }
    
    function getOrderDetail($o_ID)
    {
        global $conn;
        $order_details = array();
        $sql = "SELECT oc.o_ID, oc.f_ID, oc.o_Quantity, oc.o_Seq_ID, f.f_ID, f.f_Name, f.f_Price, o.o_Total_Amount 
                FROM `itp4506-ca`.order_content oc
                JOIN `itp4506-ca`.food f ON oc.f_ID = f.f_ID  
                JOIN `itp4506-ca`.order o ON o.o_ID = oc.o_ID
                WHERE oc.o_ID = '" . $o_ID . "'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $order_detail = new order_detail($rc['o_ID'], $rc['f_ID'], $rc['f_Name'], $rc['f_Price'], $rc['o_Quantity'],$rc['o_Total_Amount'], $rc['o_Seq_ID']);
            array_push($order_details, $order_detail);
        }
        return $order_details;
    }
    
    function getDeliveryPersonnel($d_ID)
    {
        global $conn;
        $sql = "SELECT d_Name FROM delivery_personnel WHERE d_ID = '" . $d_ID . "'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($rc = mysqli_fetch_array($rs)) {
            return $rc['d_Name'];
        }
        return null;
    }
    
    function feedback($o_ID, $o_Food_Rate, $o_Service_Rate, $o_Comment)
    {
        global $conn;
        $checkSql = "SELECT * FROM `order` WHERE o_ID = '$o_ID'";
        $checkResult = mysqli_query($conn, $checkSql);
        if (mysqli_num_rows($checkResult) > 0) {
            $updateSql = "UPDATE `order` SET o_Food_Rate = $o_Food_Rate, o_Service_Rate = $o_Service_Rate, o_Comment = '$o_Comment' WHERE o_ID = '$o_ID'";
            $updateResult = mysqli_query($conn, $updateSql);
        }
    }





    function getRestaurantName($r_ID)
    {
        global $conn;
        $sql = "SELECT r_Name FROM restaurant WHERE r_ID = '" . $r_ID . "'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($rc = mysqli_fetch_array($rs)) {
            return $rc['r_Name'];
        }
        return null;  
    }

    function getAllOrder($c_ID)
    {
        global $conn;
        $orderList = array();
        $sql = "SELECT * FROM `order` WHERE c_ID = '" . $c_ID . "' ORDER BY o_Time DESC";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $order = new order($rc['o_ID'], $rc['c_ID'], $rc['r_ID'], $rc['d_ID'], $rc['o_Time'], $rc['o_Delivery_Address'], $rc['o_Payment_Method'] , $rc['o_Status'],$rc['o_Estimated_Time'],$rc['o_Delivery_Time'],$rc['o_Food_Rate'],$rc['o_Service_Rate'],$rc['o_Comment'], $rc['o_Total_Amount'],$rc['o_Delivery_Fee']);
            array_push($orderList, $order);
        }
        return $orderList;
    }

    function customer_get_all_restaurant_list()
    {
        global $conn;
        $customer_get_all_restaurant_list_array = array();
        $sql = "SELECT * FROM restaurant;";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            $customer_get_all_restaurant_lists = new restaurant($rc['r_ID'], $rc['r_Name'], $rc['r_Password'], $rc['r_Telephone_Number'], $rc['r_Address'], $rc['r_Image'] );
            array_push($customer_get_all_restaurant_list_array, $customer_get_all_restaurant_lists);
        }
        return $customer_get_all_restaurant_list_array;
    }





//Login Command
    function customer_login($c_Name, $c_Password)
    {
        global $conn;
        global $user;
        $sql = "SELECT * FROM customer WHERE c_Name = '" . $c_Name . "' AND c_Password = '" . $c_Password . "' ";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            if ( $rc['c_Name'] == $c_Name && $rc['c_Password'] == $c_Password) {
                $_SESSION['user'] = new user($rc['c_ID'], $rc['c_Name'], $rc['c_Password'], $rc['c_Email_Address'], $rc['c_Phone_Number'],$rc['c_Address'], "", "", "", "customer") ;
                return true;
            }
        }
        $_SESSION['user'] ="";
        return false;
    }

    function restaurant_login($r_Name, $r_Password)
    {
        global $conn;
        global $user;
        $sql = "SELECT * FROM restaurant WHERE r_Name = '" . $r_Name . "' AND r_Password = '" . $r_Password . "' ";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            if ( $rc['r_Name'] == $r_Name && $rc['r_Password'] == $r_Password) {
                $_SESSION['user'] = new user($rc['r_ID'], $rc['r_Name'], $rc['r_Password'], "", $rc['r_Telephone_Number'], $rc['r_Address'], "", "", $rc['r_Image'] , "restaurant") ;
                return true;
            }
        }
        $_SESSION['user'] ="";
        return false;
    }

    function delivery_personnel_login($d_Name, $d_Password)
    {
        global $conn;
        global $user;
        $sql = "SELECT * FROM delivery_personnel WHERE d_Name = '" . $d_Name . "' AND d_Password = '" . $d_Password . "' ";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            if ( $rc['d_Name'] == $d_Name && $rc['d_Password'] == $d_Password) {
                $_SESSION['user']  = new user($rc['d_ID'], $rc['d_Name'], $rc['d_Password'], "", $rc['d_Phone_Number'], "", $rc['d_District'], $rc['d_Transportation'], "" , "deliveryPersonnel") ;
                return true;
            }
        }
        $_SESSION['user'] ="";
        return false;
    }

    function check_name($check_Name)
    {
        global $conn;
        $sql = "SELECT c.c_Name, r.r_Name, d.d_Name 
                FROM customer c, restaurant r, delivery_personnel d;";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            if ( $rc['c_Name'] == $check_Name || $rc['r_Name'] == $check_Name || $rc['d_Name'] == $check_Name) {
                return true;
            }
        }
        return false;
    }

    function check_customer_name($c_Name)
    {
        global $conn;
        $sql = "SELECT c_Name FROM customer;";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            if ( $rc['c_Name'] == $c_Name) {
                return true;
            }
        }
        return false;
    }

    function check_restaurant_name($r_Name)
    {
        global $conn;
        $sql = "SELECT r_Name FROM restaurant;";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            if ( $rc['r_Name'] == $r_Name) {
                return true;
            }
        }
        return false;
    }

    function check_delivery_personnel_name($d_Name)
    {
        global $conn;
        $sql = "SELECT d_Name FROM delivery_personnel;";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while ($rc = mysqli_fetch_array($rs)) {
            if ( $rc['d_Name'] == $d_Name) {
                return true;
            }
        }
        return false;
    }

    function get_id($get_type)
    {
        global $conn;
        $next_user_id = 0;
        $sql = "SELECT Seq_ID, Seq_Header FROM id_number WHERE Seq_Name = '" . $get_type . "';";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $rc = mysqli_fetch_array($rs);
        $next_user_id = $rc['Seq_ID'];
        $next_user_id++;
        $sql = "UPDATE id_number
                SET Seq_ID = $next_user_id
                WHERE Seq_Name = '" . $get_type . "';";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));  
        $new_id = sprintf("%s%'.07d", $rc['Seq_Header'], $next_user_id);  
        return $new_id; 
    }

    function create_account_customer($c_Name, $c_Password, $c_Email_Address, $c_Phone_Number, $c_Address)
    {
        global $conn;
        $new_customer_id = get_id('Customer');
        $sql = "INSERT INTO customer(c_ID, c_Name, c_Password, c_Email_Address, c_Phone_Number, c_Address)
                VALUES (\"$new_customer_id\", \"$c_Name\", \"$c_Password\", \"$c_Email_Address\", $c_Phone_Number, \"$c_Address\");";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));        
    }

    function create_account_restaurant($r_Name, $r_Password, $r_Address, $r_Telephone_Number, $r_Image)
    {
        global $conn;
        $new_restaurant_id = get_id('Restaurant');
        $sql = "INSERT INTO restaurant(r_ID, r_Name, r_Password, r_Address, r_Telephone_Number, r_Image)
                VALUES (\"$new_restaurant_id\", \"$r_Name\", \"$r_Password\", \"$r_Address\", $r_Telephone_Number, \"$r_Image\");";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));        
    }

    function create_account_delivery_personnel($d_Name, $d_Password, $d_Phone_Number, $d_District, $d_Transportation)
    {
        global $conn;
        $new_delivery_personnel_id = get_id('Delivery_Personnel');
        $sql = "INSERT INTO delivery_personnel(d_ID, d_Name, d_Password, d_Phone_Number, d_District, d_Transportation)
                VALUES (\"$new_delivery_personnel_id\", \"$d_Name\", \"$d_Password\", $d_Phone_Number, \"$d_District\", \"$d_Transportation\");";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));        
    }
?>