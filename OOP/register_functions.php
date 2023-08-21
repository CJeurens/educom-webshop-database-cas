<?php

//==============================================================================
// If post is sent, fill reg_form_data array with results from retrieveRegInput
// If any fields are empty, fill error keys with appropriate errors
// If no fields are empty, retrieve result from validateRegPassword
// If no errors, write new user to users database and login
//==============================================================================
function validateRegInput()
{
    //$reg_form_data = retrieveRegInput();

    require_once "sanitize_data.php";
    $sanitize = new SanitizeData;

    require_once "retrievepost.php";
    $data = new RetrievePost
    (
        array
        (
            "email",
            "username",
            "password",
            "rpassword",
            "emailErr",
            "usernameErr",
            "passwordErr",
            "rpasswordErr"
        ),
        $sanitize
    );

    $reg_form_data = $data->retrieve();
    $reg_form_data["valid"] = FALSE;
    var_dump($reg_form_data);

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $reg_form_data["emailErr"] = empty($reg_form_data["email"]) ? "Please fill in an e-mail adress" : "";
        $reg_form_data["usernameErr"] = empty($reg_form_data["username"]) ? "Please fill in a username" : "";
        $reg_form_data["passwordErr"] = empty($reg_form_data["password"]) ? "Please fill in a password" : "";
        $reg_form_data["rpasswordErr"] = empty($reg_form_data["rpassword"]) ? "Please repeat password" : "";

        if ($reg_form_data["email"] != NULL && $reg_form_data["username"] != NULL && $reg_form_data["password"] != NULL)
        {
            $reg_form_data = validateRegPassword($reg_form_data);

            if ($reg_form_data["emailErr"] == NULL && $reg_form_data["usernameErr"] == NULL && $reg_form_data["passwordErr"] == NULL && $reg_form_data["rpasswordErr"] == NULL)
            {
                $new_user = array("email"=>$reg_form_data["email"],"username"=>$reg_form_data["username"],"password"=>$reg_form_data["password"]);
                addUserToDB($new_user);
                $reg_form_data["valid"] = TRUE;
                return $reg_form_data;
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
function validateRegPassword($reg_form_data)
{
    $email = $reg_form_data["email"];
    if (retrieveUserInfo($email) != NULL)
    {
        $reg_form_data["emailErr"] = "E-mail already exists";
        return $reg_form_data;
    }

    if (strcmp($reg_form_data["password"],$reg_form_data["rpassword"]) == 0)
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