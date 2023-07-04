<?php
include "business_layer.php";

function startHtmlDoc()
{
    print "
    <!DOCTYPE html>
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
        <ul class='nav'>
            <li><a href='?page=home'>".htmlspecialchars("🏠HOME")."</a></li>
            <li><a href='?page=about'>".htmlspecialchars("ℹ️ABOUT")."</a></li>
            <li><a href='?page=contact'>".htmlspecialchars("📞CONTACT")."</a></li>
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
        <input type='hidden' value='logout' form='logout' name='page'>
        <button type='submit'> Log out </button>
        ";
    }
    
    else
    {
        print "<a href='?page=login'>Log in/register</a>";
    }
}


//==================================================
// Show different page main content for each pageID
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
    }
    print "</div>";

}

function showHomeContent()
{
    print "<p>Van harte welkom op deze zeer mooie webpagina!</p>";
}

function showAboutContent()
{
    print "
    <p>Deze webpagina is speciaal ontwikkeld om mij te helpen de html-taal te leren.</p>
    <p>Ik heb biologie gestudeerd aan Wageningen University & Research waar ik coole dingen heb geleerd over plantjes, diertjes en ander gespuis.</p> 
    <p>Tevens ben ik opgegroeid in Roermond waar ik talloze vlaaien heb gegeten. Mijn favoriet is appel-citroen.</p>
    ";
}

function showContactContent()
{
    $form_data = validateContactInput();
    print "
    <div class=sidebar>
        <form method='post' id='contact'>
            <table>
                <tr>
                    <td style='text-align:right'> Name: </td>
                    <td><input class='contact' type='text' id='name' name='name' form='contact' value='".$form_data["name"]."'></td>
                    <td><span class=error>".$form_data["nameErr"]."</span></td>
                </tr>
                <tr>
                    <td style='text-align:right'> E-mail: </td>
                    <td><input class='contact' type='text' id='email' name='email' form='contact' value='".$form_data["email"]."'></td>
                    <td><span class=error>".$form_data["emailErr"]."</span></td>
                </tr>
                <tr>
                    <td style='text-align:right'> Message: </td>
                    <td><textarea class='contact' style='width:260px;height:80px' type='text' id='msg' name='msg' form='contact' value='".$form_data["msg"]."'></textarea></td>
                    <td><span class=error>".$form_data["msgErr"]."</span></td>
                </tr>
                <tr>    
                    <td></td>
                    <td style='text-align:right'><input type='submit' style='width:64px' form='contact' value='Send'><input type='hidden' name='page' value='contact'></td>
                </tr>
            </table>
        </form>
    </div>
    ";
}

function showMsgSentContent()
{
    $form_data = validateContactInput();
    print "Thank you for your message<br>";
    print "
    Naam:".$form_data["name"]."<br>
    E-mail:".$form_data["email"]."<br>
    Message:".$form_data["msg"]."<br>
    ";


}

function showShopContent($data)
{
    $products = getProductData();
    if (!empty($data["product"]))
    {
        $product = $products[$data["product"]];
        showProductDetails($product);
    }
    else
    {
        showProductOverview($products);
    }
     
}

function showProductOverview($products)
{
    print "
    <div class='flex-container'>";            
        
    foreach($products as $product)
        {
            print "<div class=product>
            <a href='?page=shop&product=".$product["id"]."'><img src=".$product["imgurl"]." width='94' height='94'><br>
            " .$product["name"]. "</a><br> " .htmlspecialchars('€').$product["unitprice"]. "</div>";
        }

    print "</div>
    "; 
}

function showProductDetails($product)
{
    print "<div class=product_detail>
    <img style='float:left;margin-right:16px' src=".$product["imgurl"]." width='384' height='384'>
    <section class=product_description>
    <h1>".$product["name"]."</h1>
    <p>".htmlspecialchars('€').$product["unitprice"]."</p>
    ";showPurchaseButton(); // knop stuurt naar account page als niet ingelogd
    print "</section></div>"; 
}

function showPurchaseButton()
{
    $current_user = getLoginSession();
    if (!empty($current_user))
    {
        print "<br><button>!!!BUY BUY BUY!!!(WIP)</button>";
    }
    else
    {
        print "<br><a href='?page=login'><button>!!!BUY BUY BUY!!!(WIP)</button></a>";
    }
}

function showLoginContent()
{
    showLoginForm();
    validateLoginInput();
}

function showRegisterContent()
{
    showRegisterForm();
    validateRegInput();
}

//=================================
// Shows the table with login form
//=================================
function showLoginForm()
{
    $login_form = validateLoginInput();
    $login_form_data["email"] = "";
    if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {
        $login_form_data = array_merge($login_form_data,$_POST);
    };
       
    print "
    <div class=sidebar style=height:135px>
        <form method='post'>
            <table>
                <tr>
                    <td style='text-align:right'>E-mail:</td>
                    <td><input type='text' name='email' value='".$login_form_data["email"]."'></td>
                    <td><span class=error style=font-size:12px>".$login_form["emailErr"]."</span></td>
                </tr>
                <tr>
                    <td style='text-align:right'>Password:</td>
                    <td><input type='text' name='password'></td>
                    <td><span class=error style=font-size:12px>".$login_form["passwordErr"]."</span></td>
                </tr>
                <tr>
                    <td><a style=font-size:14px; href='?page=register'>Register account</a></td>
                    <td style='text-align:right'><input style=width:64px; type='submit' value='Log in'><input type='hidden' name='page' value='login'></td>
                </tr>
            </table>
        </form>
    </div>
    ";
}



//====================================
// Shows the table with register form
//====================================
function showRegisterForm()
{
    $reg_form_data = validateRegInput();
    print "
    <div class=sidebar style=height:225px>
        <form method='post'>
            <table>
                <tr>
                    <td style='text-align:right'>E-mail:</td>
                    <td><input type='text' name='email' value='".$reg_form_data["email"]."'></td>
                    <td><span class=error style=font-size:12px>".$reg_form_data["emailErr"]."</span></td>
                </tr>
                <tr>
                    <td style='text-align:right'>Username:</td>
                    <td><input type='text' name='username' value='".$reg_form_data["username"]."'></td>
                    <td><span class=error style=font-size:12px>".$reg_form_data["usernameErr"]."</span></td>
                </tr>
                <tr>
                    <td style='text-align:right'>Password:</td>
                    <td><input type='text' name='password'></td>
                    <td><span class=error style=font-size:12px>".$reg_form_data["passwordErr"]."</span></td>
                </tr>
                <tr>
                    <td style='text-align:right'>Repeat password:</td>
                    <td><input type='text' name='password_repeat'></td>
                    <td><span class=error style=font-size:12px>".$reg_form_data["rpasswordErr"]."</span></td>
                </tr>
                <tr>
                    <td><a style=font-size:14px; href='?page=login'>Log in instead</a></td>
                    <td style=text-align:right><input style=width:80px; type='submit' value='Register'><input type='hidden' name='page' value='register'></td>
                </tr>
            </table>
        </form>
    </div>
    ";
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