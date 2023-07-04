<?php

//========================================================================
// Create array for login info
// If post is sent, fill login array with matching users.txt if present
// If a field is empty, fill error key with appropriate error
// If no fields are empty, fill array w/ results from password validation
//========================================================================
function validateLoginInput()
{
    $login_input = array("email"=>"","name"=>"","pass"=>"","emailErr"=>"","passwordErr"=>"","emailMatch"=>"","valid"=>"");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $login_input = array_merge($login_input,retrieveLoginInput());
        if ($login_input["email"] == NULL)
        {
            $login_input["emailErr"] = "Please enter e-mail";
        }
        if ($login_input["pass"] == NULL)
        {
            $login_input["passwordErr"] = "Please enter password";
        }

        if ($login_input["email"] != NULL && $login_input["pass"] != NULL)
        {
            $login_input = array_merge($login_input,validateLoginPassword($login_input));
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


//=====================================================================================================
// Compares password in user_info with password in login_input, then sets valid/error keys accordingly
//=====================================================================================================
function validateLoginPassword($login_input)
{
    $result = array('emailMatch' => false, 'passwordMatch' => false, "valid"=>FALSE);
    $email = $login_input["email"];
    $user_info = retrieveUserInfo($email);   
    if (empty($user_info)) 
    {
        return $result; 
    }

    $result['emailMatch'] = true;
    
    if(strcmp($login_input["pass"],$user_info["pass"]) != 0) 
    {
        return $result;
    }

    $result['passwordMatch'] = TRUE;
    $result['valid'] = TRUE;
    $result['username'] = $user_info['username']; 
    
    
       
    return $result;
}

//========================
// Logs in user w/ userID
//========================
function doLoginSession($result)
{
    if ($result["valid"])
    {
        $_SESSION["userID"] = $result["username"];
    }
}

?>