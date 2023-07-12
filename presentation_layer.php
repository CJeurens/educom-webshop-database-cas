<?php
include "business_layer.php";
include "content_functions.php";

function startHtmlDoc()
{
    print "<!DOCTYPE html>
    <html>
    ";
}

function showHtmlHeadSection($data)
{
    print "
    <head>
    <meta charset='UTF-8'>".
    setTitle($data)
    ."<link rel='stylesheet' href='/educom-webshop-database-cas/stylesheet.css'>
    </head>
    ";
}

function showHtmlBodySection($data)
{
    startBody();
        showHeader($data);
        showNav();
        showContent($data);
        showFooter();
    endBody();
}

function setTitle($data)
{
    switch($data["page"])
    {
        case "home":
            print "<title>".htmlspecialchars("🏠HOME")."</title>";
            break;
        case "about":
            print "<title>".htmlspecialchars("ℹ️ABOUT")."</title>";
            break;
        case "contact":
            print "<title>".htmlspecialchars("📞CONTACT")."</title>";
            break;
        case "msg_sent":
            print "<title>".htmlspecialchars("📞CONTACT")."</title>";
            break;
        case "login":
            print "<title>".htmlspecialchars("👤ACCOUNT")."</title>";
            break;
        case "register":
            print "<title>".htmlspecialchars("👤ACCOUNT")."</title>";
            break;
        case "shop":
            if(!empty($data["product"]))
            {
                $products = getProductData();
                $product = $products[$data["product"]];
                print "<title>".$product["name"]."</title>";
            }
            else
            {
                print "<title>".htmlspecialchars("🛍️SHOP")."</title>";
            }
            break;
        case "cart":
            print "<title>".htmlspecialchars("🛒YOUR CART")."</title>";
            break;
    }
}

//=======================================
// Show different header for each pageID
//=======================================
function showHeader($data)
{
    print "<div class='pagetop'><header><h2 style=font-family:dubai>";
    switch ($data["page"])
    {
        case "home":
            print htmlspecialchars("🏠DIT IS HOME");
            break;
        case "about":
            print htmlspecialchars("ℹ️DIT IS ABOUT");
            break;
        case "contact":
            print htmlspecialchars("📞DIT IS CONTACT");
            break;
        case "msg_sent":
            print htmlspecialchars("📞DIT IS CONTACT");
            break;
        case "login":
            print htmlspecialchars("👤ACCOUNT");
            break;
        case "register":
            print htmlspecialchars("👤ACCOUNT");
            break;
        case "shop":
            print htmlspecialchars("🛍️DIT IS DE SHOP");
            break;
        case "cart":
            print htmlspecialchars("🛒YOUR CART");
            break;
    }
    print "</h2></header>";
}

//===========================================
// Show navigation menu linking to each page
//===========================================
function showNav()
{
    print "
    <div class='navbar'>
        <ul class='nav' style='color:rgb(58, 106, 157)'>
            <li><a href='?page=home'>".htmlspecialchars("🏠HOME")."</a> | </li>
            <li><a href='?page=about'>".htmlspecialchars("ℹ️ABOUT")."</a> | </li>
            <li><a href='?page=contact'>".htmlspecialchars("📞CONTACT")."</a> | </li>
            <li><a href='?page=shop'>".htmlspecialchars("🛍️SHOP")."</a></li>
            <span class='account'><form method='post' id='logout' name='logout'><input type='hidden' name='page' value='logout'>";
            showLogIn(); print "</form></span>
        </ul>
    </div>
    </div>
    ";
}

//====================================================
// If userID is set: show welcome message w/ username
// If userID is not set: show log in/register option
//====================================================
function showLogIn()
{
    $current_user = getLoginSession();
    if (!empty($current_user))
    {
        print "Welcome ".$current_user."!
        <input type='hidden' value='logout' form='logout' name='page'>";
        showShoppingCart();
        print "<button type='submit'> Log out </button>
        ";
    }
    
    else
    {
        print "<a href='?page=login'>Log in/register</a>";
    }
}

//==================================================
// Show different page main content for each pageID
// See content_functions.php
//==================================================
function showContent($data)
{
    print "<div class='content'>";
    switch($data["page"])
    {
        case "home":
            showHomeContent();
            break;
        case "about":
            showAboutContent();
            break;
        case "contact":
            showContactContent();
            break;
        case "msg_sent":
            showMsgSentContent();
            break;
        case "login":
            showLoginContent();
            break;
        case "register":
            showRegisterContent();
            break;
        case "shop":
            showShopContent($data);
            break; 
        case "cart":
            showShoppingCartContent();
            break;
    }
    print "</div>";
}

//====================
// Start body section
//====================
function startBody()
{
    print "<body>";
}

//==================
// End body section
//==================
function endBody()
{
    print "</body>";
}

//=============================================
// Show footer with ©, current year and author
//=============================================
function showFooter()
{
    print "<footer><p>".htmlspecialchars("©2023 Cas Jeurens")."</p></footer>";
}

//=================
// End html page
//=================
function endHtmlDoc()
{
    print "</html>";
}

?>