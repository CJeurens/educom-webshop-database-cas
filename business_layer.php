<?php
include "data_layer.php";
include "login_functions.php";
include "register_functions.php";
include "shop_functions.php";

function getPage()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if (isset($_GET["page"])) 
        {
            if (isset($_GET["product"]))
            {
                $get_return["product"] = $_GET["product"];
            }
            $get_return["page"] = $_GET["page"];
            return $get_return;
        }
        else
        {
            $get_return["page"] = "home";
            return $get_return;
        }   
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_POST["page"])) 
        {
            $post_return["page"] = $_POST["page"];
            return $post_return;
        }
        else
        {
            $post_return = getCurrentPage();
            return $post_return;
        }
    }
}

//===================================================================
// Looks at result of different forms only on their respective pages
//===================================================================
function handleRequest($pageID) 
{ 
    switch($pageID["page"]) 
    {
        case 'login':
            $data = validateLoginInput();
            if ($data["valid"])
            {
                doLoginSession($data);
                if (isset($_GET["referral"]))
                {
                    //$pageID["page"] = "shop";
                    //$pageID["product"] = $_GET["referral"];
                    header("location: ?page=shop&product=".$_GET["referral"]."");
                }
                else
                {
                    $pageID["page"] = "home";
                }
            }
            break;
        case 'register':
            $user_login = validateRegInput();
            if ($user_login["valid"])
            {
                $pageID["page"] = "home";
            }
            break;
        case 'contact':     
            $form_data = validateContactInput();
            if ($form_data["valid"])
            {
                $pageID["page"] =  "msg_sent";
            }
            break;
        case 'logout':
            doLogoutSession();
            if (($_GET["page"] == "cart") OR ($_GET["page"] == "login"))
            {
                $pageID["page"] = "home";
                return $pageID;
            }
            return getCurrentPage();
            break;
        case 'shop':
            $pageID = addToCart($pageID);
            return $pageID;
            break;
        case 'cart':
            placeOrder();
            removeFromCart();
            return $pageID;
            break;
    }

    $data = $pageID;
    return $data;
}


function validateContactInput()
{
    $form_data = array("name"=>"","email"=>"","msg"=>"","nameErr"=>"","emailErr"=>"","msgErr"=>"","valid"=>FALSE); // create empty array with necessary keys

    if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {        
        $form_data = array_merge($form_data,retrieveContactInput()); //fill empty array with result from retrieveContactInput

        if (empty($form_data["name"]))
        {
            $form_data["nameErr"] = "Please fill in a name";
        }

        if (empty($form_data["email"]))
        {
            $form_data["emailErr"] = "Please fill in an e-mail adress";
        }

        if (empty($form_data["msg"]))
        {
            $form_data["msgErr"] = "Please fill in a message";
        }

        if (empty($form_data["nameErr"]) && empty($form_data["emailErr"]) && empty($form_data["msgErr"]) != NULL) 
        {
            $form_data["valid"] = TRUE;
        }
    }
    return $form_data;
}

//=====================================================
// Check whether log out form is submitted
// If valid: set userID to NULL and return to homepage
//=====================================================

function doLogoutSession()
{
    $_SESSION["userID"] = NULL;
}

//======================================
// retrieves currently logged in userID
//======================================
function getLoginSession()
{
    if(isset($_SESSION['userID']))
	{
        return $_SESSION['userID'];
	}
}

?>