<?php

function retrieveContactInput()
{
    return array("name"=>$_POST["name"],"email"=>$_POST["email"],"msg"=>$_POST["msg"]);
}

function retrieveLoginInput()
{
    return array("email"=>$_POST["email"],"pass"=>$_POST["password"]);
}

function retrieveRegInput()
{
    return array("email"=>$_POST["email"],"username"=>$_POST["username"],"pass"=>$_POST["password"],"password_repeat"=>$_POST["password_repeat"]);
}

function retrieveUserInfo($login_input)
{
    $conn = connectMySQLi("users");

    $sql = "SELECT email, username, pass FROM users WHERE email='".$login_input["email"]."'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    return $row;

    mysqli_close($conn);
}

/*function addUserToTxt()///
{
    $f_users = fopen("users.txt", "a") or die ("Unable to open file!");
    $new_user = "\n".($_POST["email"])."|".($_POST["username"])."|".($_POST["password"]);
    fwrite($f_users, $new_user);
    fclose($f_users);
}*/

function addUserToDB()
{
    
}

?>