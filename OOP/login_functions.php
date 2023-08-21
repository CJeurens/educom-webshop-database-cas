<?php

//========================================================================
// Create array for login info
// If post is sent, fill login array with matching users.txt if present
// If a field is empty, fill error key with appropriate error
// If no fields are empty, fill array w/ results from password validation
//========================================================================
function validateLoginInput()
{
    //$login_input = retrieveLoginInput();
    require_once "sanitize_data.php";
    $sanitize = new SanitizeData;

    require_once "retrievepost.php";
    $data = new RetrievePost
    (
        array
        (
            "email",
            "password",
            "emailErr",
            "passwordErr"
        ),
        $sanitize
    );

    $login_input = $data->retrieve();
    $login_input["valid"] = FALSE;

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $login_input["emailErr"] = empty($login_input["email"]) ? "Please enter e-mail" : "";
        $login_input["passwordErr"] = empty($login_input["password"]) ? "Please enter password" : "";
        
        if ($login_input["email"] != NULL && $login_input["password"] != NULL)
        {
            $login_input = validateLoginPassword($login_input);
            if (!$login_input["emailMatch"])
            {
                $login_input["emailErr"] = "Incorrect e-mail";
            }
            else if (!$login_input["passwordMatch"])
            {
                $login_input["passwordErr"] = "Incorrect password";
            }
        }
    }
    return $login_input;
}


//===============================================================================================
// Compares password in user_info with password in login_input, then sets array keys accordingly
//===============================================================================================
function validateLoginPassword($login_input)
{

    
    $login_input["emailMatch"] = FALSE;
    $login_input["passwordMatch"] = FALSE;

    $email = $login_input["email"];

    require_once "connectmysqli.php";
    $conn_users = new ConnectMySQLi(
        servername: "localhost",
        username: "root",
        password: "",
        database: "users"
    ); 

    require_once "RetrieveUserInfo.php";
    $info = new RetrieveUserInfo($email,$conn_users);
    $user_info = $info->retrieve();

    //$user_info = retrieveUserInfo($email);   
    if (empty($user_info)) 
    {
        return $login_input; 
    }

    $login_input['emailMatch'] = TRUE;
    
    if(strcmp($login_input["password"],$user_info["password"]) != 0) 
    {
        return $login_input;
    }

    $login_input["passwordMatch"] = TRUE;
    $login_input['valid'] = TRUE;
    $login_input['username'] = $user_info['username']; 
       
    return $login_input;
}

//========================
// Logs in user w/ userID
//========================
function doLoginSession($data)
{
    if ($data["valid"])
    {
        $_SESSION["userID"] = $data["username"];
    }
}

?>