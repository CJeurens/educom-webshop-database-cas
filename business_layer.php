<?php
include "data_layer.php";
include "login_functions.php";
include "register_functions.php";






function connectMySQLi($dbname)
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    else 
    {
        return $conn;
    }
    
}














































//================================================================================
// Check if page value in URL exists and not NULL, then set $pageID to that value
//================================================================================
function getPage()
{
    if (empty($pageID))
    {
        if (isset($_GET["page"])) 
        {
            return $_GET["page"];
        }
        else
        {
            return "home";
        }   
    }
}


//===================================================================
// Looks at result of different forms only on their respective pages
//===================================================================
function handleRequest($pageID) 
{
    switch($pageID) 
    {
        case 'account':
            $data = validateLoginInput();
            if ($data["valid"])
            {
                $pageID = "home";
            }
            break;
        case 'register':
            $user_login = validateRegInput();
            if ($user_login["valid"])
            {
                $pageID = "home";
            }
            break;
        case 'contact':            
            $form_data = validateContactInput();
            if ($form_data["valid"])
            {
                $pageID =  "msg_sent";
            }
            break;
    }
    $data['page'] = $pageID;
    return $data;
}

//==================================
// 
//==================================
function validateContactInput()
{
    $form_data = array(
                    "name"=>"",
                    "email"=>"",
                    "msg"=>"",
                    "nameErr"=>"",
                    "emailErr"=>"",
                    "msgErr"=>"",
                    "valid"=>FALSE
                );

    if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {        
        $form_data = array_merge($form_data,retrieveContactInput());

        if ($_POST['name'] && $_POST['email'] && $_POST['msg'] != NULL) 
        {
            $form_data["valid"] = TRUE;
        }

        if ($_POST["name"] == NULL)
        {
            $form_data["nameErr"] = "Please fill in a name";
        }

        if ($_POST["email"] == NULL)
        {
            $form_data["emailErr"] = "Please fill in an e-mail adress";
        }

        if ($_POST["msg"] == NULL)
        {
            $form_data["msgErr"] = "Please fill in a message";
        }
    }
    return $form_data;
}


//=====================================================
// Check wether log out form is submitted
// If valid: set userID to NULL and return to homepage
//=====================================================
checkLogOut();
function checkLogOut()
{
    if (($_SERVER["REQUEST_METHOD"] == "POST") and isset($_POST["logout"]) and (getLoginSession() != NULL))
    {
        $_SESSION["userID"] = NULL;
        header("location:?page=home");
    }

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