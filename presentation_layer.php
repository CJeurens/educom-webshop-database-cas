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
    ."<link rel='stylesheet' href='/opdracht_0.1/[RESTRUCTURE] opdracht_1.6/stylesheet.css'>
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
        case "account":
            print "<title>".htmlspecialchars("👤ACCOUNT")."</title>";
            break;
        case "register":
            print "<title>".htmlspecialchars("👤ACCOUNT")."</title>";
            break;
    }
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
            <span class='account'><form method='post' id='logout' name='logout'>";
            showLogIn(); print "</form></span>
        </ul>
    </div>
    ";
}

//=======================================
// Show different header for each pageID
//=======================================
function showHeader($data)
{
    print "<header><h2 style=font-family:dubai>";
    
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
        case "account":
            print htmlspecialchars("👤ACCOUNT");
            break;
        case "register":
            print htmlspecialchars("👤ACCOUNT");
            break;
    }

    print "</h2></header>";
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
        print "Welkom ".$current_user."!
        <input type='hidden' value='logout' form='logout' name='logout'>
        <button type='submit'> Log out </button>
        ";
    }
    
    else
    {
        print "<a href='?page=account'>Log in/register</a>";
    }
}


//==================================================
// Show different page main content for each pageID
//==================================================
function showContent($data)
{
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
        case "account":
            showLoginContent();
            break;
        case "register":
            showRegisterContent();
            break;
    }

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
                    <td style='text-align:right'><input type='submit' style='width:64px' form='contact' value='Send'></td>
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
    $login_form_data = array("email"=>"");
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
                    <td style='text-align:right'><input style=width:64px; type='submit' value='Log in'></td>
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
                    <td><a style=font-size:14px; href='?page=account'>Log in instead</a></td>
                    <td style=text-align:right><input style=width:80px; type='submit' value='Register'></td>
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
    print "<footer>
    <p>".htmlspecialchars("©2023 Cas Jeurens")."</p>
    </footer>";
}


//=================
// End html page
//=================
function endHtmlDoc()
{
    print "</html>";
}


?>