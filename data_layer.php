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
    
    
    mysqli_close($conn);
    return $row;
}


function addUserToDB()
{
    $conn = connectMySQLi("users");

    $sql = "INSERT INTO users (email, username, pass) VALUES ('".$_POST["email"]."','".$_POST["username"]."','".$_POST["password"]."')";
    mysqli_query($conn,$sql);
}

?>