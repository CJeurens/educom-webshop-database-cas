<?php

function connectMySQLi($db)
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error()); //TODO throw exception
    }
    else 
    {
        return $conn;
    }
}

function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function retrieveContactInput()
{
    $return["name"] = testInput($_POST["name"]);
    $return["email"] = testInput($_POST["email"]);
    $return["msg"] = testInput($_POST["msg"]);
    return $return;
    //return array("name"=>$_POST["name"],"email"=>$_POST["email"],"msg"=>$_POST["msg"]);
}

function retrieveLoginInput()
{
    $return["email"] = testInput($_POST["email"]);
    $return["pass"] = testInput($_POST["password"]);
    return $return;
    //return array("email"=>$_POST["email"],"pass"=>$_POST["password"]);
}

function retrieveRegInput()
{
    $return["email"] = testInput($_POST["email"]);
    $return["username"] = testInput($_POST["username"]);
    $return["pass"] = testInput($_POST["password"]);
    $return["password_repeat"] = testInput($_POST["password_repeat"]);
    return $return;
    //return array("email"=>$_POST["email"],"username"=>$_POST["username"],"pass"=>$_POST["password"],"password_repeat"=>$_POST["password_repeat"]);
}

function retrieveUserInfo($email)
{
    $conn = connectMySQLi("users");
    $email = mysqli_real_escape_string($conn,$email);
    $sql = "SELECT email, username, pass FROM users WHERE email='".$email."'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    
    
    mysqli_close($conn);
    return $row;
}

function addUserToDB($new_user)
{

    $conn = connectMySQLi("users");
    $email = mysqli_real_escape_string($conn,$new_user["email"]);
    $username = mysqli_real_escape_string($conn,$new_user["username"]);
    $pass = mysqli_real_escape_string($conn,$new_user["pass"]);

    $sql = "INSERT INTO users (email, username, pass) VALUES ('".$email."','".$username."','".$pass."')";
    mysqli_query($conn,$sql);

}

function getProductData()
{
    $conn = connectMySQLi("webshop");
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

?>