<?php

//==============================================================================
// Create empty array for registration form data
// If post is sent, fill reg_form_data array with results from retrieveRegInput
// If any fields are empty, fill error keys with appropriate errors
// If no fields are empty, retrieve result from validateRegPassword
// If no errors, write new user to users.txt and login
//==============================================================================
function validateRegInput()
{
    $reg_form_data = array("email"=>"","username"=>"","pass"=>"","password_repeat"=>"","emailErr"=>"","usernameErr"=>"","passwordErr"=>"","rpasswordErr"=>"","valid"=>"");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $login_input = retrieveRegInput();
        $reg_form_data = array_merge($reg_form_data,$login_input);

        if ($reg_form_data["email"] == NULL)
        {
            $reg_form_data["emailErr"] = "Please fill in an e-mail adress";
        }
        if ($reg_form_data["username"] == NULL)
        {
            $reg_form_data["usernameErr"] = "Please fill in a username";
        }
        if ($reg_form_data["pass"] == NULL)
        {
            $reg_form_data["passwordErr"] = "Please fill in a password";
        }
        if ($reg_form_data["password_repeat"] == NULL)
        {
            $reg_form_data["rpasswordErr"] = "Please repeat password";
        }

        if ($reg_form_data["email"] != NULL && $reg_form_data["username"] != NULL && $reg_form_data["pass"] != NULL)
        {
            $reg_form_data = validateRegPassword($login_input,$reg_form_data);

            if ($reg_form_data["emailErr"] == NULL && $reg_form_data["usernameErr"] == NULL && $reg_form_data["passwordErr"] == NULL && $reg_form_data["rpasswordErr"] == NULL)
            {
                $new_user = array("email"=>$login_input["email"],"username"=>$login_input["username"],"pass"=>$login_input["pass"]);
                addUserToDB($new_user);
                $login_input = $reg_form_data;
                $login_input["valid"] = TRUE;
                doLoginSession($login_input);
                return $login_input;
            }
        }
    }
    return $reg_form_data;
}


//===================================================================================================
// Get result from retrieveUserInfo
// If matching e-mail present, fill error key with appropriate error
// If no matching e-mail present, check if password == repeat password and give error if appropriate
//===================================================================================================
function validateRegPassword($login_input,$reg_form_data)
{
    $email = $login_input["email"];
    if (retrieveUserInfo($email) != NULL)
    {
        $reg_form_data["emailErr"] = "E-mail already exists";
        return $reg_form_data;
    }

    if (strcmp($login_input["pass"],$login_input["password_repeat"]) == 0)
    {
        return $reg_form_data;
    }
    else
    {
        $reg_form_data["rpasswordErr"] = "Incorrect repeat password";
        return $reg_form_data;
    }
}

?>