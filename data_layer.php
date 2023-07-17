<?php

//==============================================
// start connection with a given MySQL database
//==============================================
function connectMySQLi($db)
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if (!$conn)
    {
        throw new Exception("Connection failed".mysqli_connect_error());
    }
    return $conn;
}

//======================
// sanitizes input data
//======================
function testInput($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getCurrentPage()
{
    return $_GET;
}

//======================================================
// returns array with sanitized input from contact form
//======================================================
function retrieveContactInput()
{
    $return["name"] = isset($_POST["name"]) ? testInput($_POST["name"]) : "";
    $return["email"] = isset($_POST["email"]) ? testInput($_POST["email"]) : "";
    $return["msg"] = isset($_POST["msg"]) ? testInput($_POST["msg"]) : "";
    $return["nameErr"] = "";
    $return["emailErr"] = "";
    $return["msgErr"] = "";
    $return["valid"] = FALSE;
    
    return $return;
}

//=====================================================
// returns array with sanitized input from login form
//=====================================================
function retrieveLoginInput()
{
    $return["email"] = isset($_POST["email"]) ? testInput($_POST["email"]) : "";
    $return["password"] = isset($_POST["password"]) ? testInput($_POST["password"]) : "";
    $return["emailErr"] = "";
    $return["passwordErr"] = "";
    $return["valid"] = FALSE;

    return $return;
}

//===========================================================
// returns array with sanitized input from registration form
//===========================================================
function retrieveRegInput()
{
    $return["email"] = isset($_POST["email"]) ? testInput($_POST["email"]) : "";
    $return["username"] = isset($_POST["username"]) ? testInput($_POST["username"]) : "";
    $return["password"] = isset($_POST["password"]) ? testInput($_POST["password"]) : "";
    $return["rpassword"] = isset($_POST["rpassword"]) ? testInput($_POST["rpassword"]) : "";
    $return["emailErr"] = "";
    $return["usernameErr"] = "";
    $return["passwordErr"] = "";
    $return["rpasswordErr"] = "";
    $return["valid"] = FALSE;

    return $return;
}

//=========================================================================
// returns array with email and corresponding username from users database
//=========================================================================
function retrieveUserInfo($email)
{
    try
    {
        $conn = connectMySQLi("users");
    }
    catch (Exception $e)
    {
        print "We are experiencing some technical issues, please try again at a later time.";
        return array();
    }
    $email = mysqli_real_escape_string($conn,$email);
    $sql = "SELECT email, username, password FROM users WHERE email='".$email."'";
    $result = mysqli_query($conn,$sql);     
    $row = mysqli_fetch_assoc($result);
    
    mysqli_close($conn);
    return $row;
}

//===========================================
// adds new valid user info to user database
//===========================================
function addUserToDB($new_user)
{
    try
    {
        $conn = connectMySQLi("users");
    }
    catch (Exception $e)
    {
        print "We are experiencing some technical issues, please try again at a later time.";
        return array();
    }
    $email = mysqli_real_escape_string($conn,$new_user["email"]);
    $username = mysqli_real_escape_string($conn,$new_user["username"]);
    $password = mysqli_real_escape_string($conn,$new_user["password"]);

    $sql = "INSERT INTO users (email, username, password) VALUES ('".$email."','".$username."','".$password."')";
    mysqli_query($conn,$sql);       
}

//===============================================
// retrieves product data from products database
//===============================================
function getProductData()
{
    try
    {
        $conn = connectMySQLi("webshop");
    }
    catch (Exception $e)
    {
        print "We are experiencing some technical issues, please try again at a later time.";
        return array();
    }
    
    $sql = "SELECT id,imgurl,name,unitprice FROM products";
    $result = mysqli_query($conn,$sql);     
    $products = array();

    while ($row = mysqli_fetch_assoc($result))
    {
        $products[$row['id']] = $row;
    }

    mysqli_close($conn);
    return $products;
}

//================================================================================
// retrieves user ID from database that corresponds with currently logged in user
//================================================================================
function getUserCartData()
{
    initializeCart();
    try
    {
        $conn = connectMySQLi("users");
    }
    catch (Exception $e)
    {
        print "We are experiencing some technical issues, please try again at a later time.";
        return array();
    }
    $sql = "SELECT id FROM users WHERE username='".$_SESSION["userID"]."'";
    $result = mysqli_query($conn,$sql);     

    $row = mysqli_fetch_row($result);
    $userID = $row[0];

    $user_cart = array("userID"=>$userID,"cart"=>$_SESSION["cart"]["".$_SESSION["userID"].""]);

    mysqli_close($conn);
    return $user_cart;
}

//=================================================
// retrieves product data for each product in cart
//=================================================
function getCartProductData($product_id)
{
    try
    {
        $conn = connectMySQLi("webshop");
    }
    catch (Exception $e)
    {
        print "We are experiencing some technical issues, please try again at a later time.";
        return array();
    }
    $sql = "SELECT id,imgurl,name,unitprice FROM products WHERE id='".$product_id."'";
    $result = mysqli_query($conn,$sql);     
    $products = array();

    while ($row = mysqli_fetch_assoc($result))
    {
        $products[$row['id']] = $row;
    }

    mysqli_close($conn);
    return $products;
}

//============================================================================================
// creates order event in order database and assigns order ID to new entries in cart database
//============================================================================================
function placeOrder()
{
    if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {
        if (isset($_POST["cart_submit"]))
        {
            $user_cart = getUserCartData();
            $cart = $user_cart["cart"];

            if (!empty($cart))
            {                
                $conn = connectMySQLi("webshop"); //create order entry
                $sql = "INSERT into orders (user_id,date,status) VALUES ('".$user_cart["userID"]."','".date("Y/m/d")."','new')";
    
                mysqli_query($conn,$sql);
                $last_id = mysqli_insert_id($conn);
    
                mysqli_close($conn);
    
                foreach ($cart as $cart_product) //create cart entries
                {
                    $conn = connectMySQLi("webshop");
                    $sql = "INSERT into cart (order_id,user_id,product_id,units) VALUES ('".$last_id."','".$user_cart["userID"]."','".$cart_product["product_id"]."','".$cart_product["units"]."')";
    
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
    
                //clearcart
                $_SESSION["cart"] = array();
            }
        }
    }
}

//=============================================
// creates empty cart array for logged in user
//=============================================
function initializeCart()
{
    if (isset($_SESSION["userID"]))
    {
        $userID = $_SESSION["userID"];
        if (!isset($_SESSION["cart"][$userID]))
        {
            $_SESSION["cart"][$userID] = array();
        }
    }
}

//=========================================================================================================
// assign product_id and units to corresponding product_id and corresponding user in session cart variable
//=========================================================================================================
function addToCart($pageID)
{
    if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {
        $add = $_POST["units"];
        $id = $_POST["product_id"];
        $userID = $_SESSION["userID"];

        $_SESSION["cart"][$userID][$id] = array("product_id"=>$id,"units"=>$add);
        $pageID["product"] = "";
        return $pageID;
    }
    return $pageID;
}

//============================================================
// remove product_id entry from session cart for current user
//============================================================
function removeFromCart()
{
    if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {
        if (isset($_POST["remove"]))
        {
            unset($_SESSION["cart"][$_SESSION["userID"]][$_POST["remove"]]);
            
        }
    }
}

?>