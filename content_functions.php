<?php

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

function showShoppingCartContent()
{
    print "
    <div class='cart'>
    <table style='width:50%'>
        <tr style='text-decoration-line:underline;font-weight:bold'>
            <td></td>
            <td>ID</td>
            <td></td>
            <td>Name</td>
            <td>Amount</td>
            <td>Price per unit</td>
            <td>Subtotal</td>
        </tr>";
        showCartProducts();
    print "
    </table>
    </div>";

    print"
    <div class='cart'><form method='post'>
    <button type='submit' name='cart_submit' value='TRUE' style='width:240px;height:48px'"; disableOrderButton(); print ">Place order</button>
    </form></div>
    ";
}

function showCartProducts()
{
    $user_cart = getUserCartData();
    $cart = $user_cart["cart"];
    $product_total = "0";
    foreach($cart as $cart_product)
    {
        $product = consolidateCartData($cart_product);
        $product_total += $product["subtotal"];
        print "
        <tr>
            <td><form method='post'><button type='submit' name='remove' value='".$product["id"]."'>X</button><form></td>
            <td>".$product["id"]."</td>
            <td><img src=".$product["imgurl"]." width='32' height='32'></td>
            <td><a href='?page=shop&product=".$product["id"]."'>".$product["name"]."</a></td>
            <td>".$product["units"]."</td>
            <td>".htmlspecialchars('€').$product["unitprice"]."</td>
            <td>".htmlspecialchars('€').number_format($product["subtotal"],2)."</td>
        </tr>
        ";
    }
    print "
    <tr style='text-decoration-line:underline;font-weight:bold;vertical-align:bottom;height:48px'>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Total</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>".htmlspecialchars('€').number_format($product_total,2)."</td>
    </tr>
    ";
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
    ";showPurchaseButton($product); // knop stuurt naar account page als niet ingelogd
    print "</section></div>"; 
}

function showPurchaseButton($product)
{
    $current_user = getLoginSession();
    if (!empty($current_user))
    {
        print "<br><form method='post'>
        <input type='number' style='width:32px' name='units' min='1' max='4' value='1'>
        <button type='submit' name='product_id' value='".$product["id"]."'>!!!BUY BUY BUY!!!</button>
        </form>";
    }
    else
    {
        $current_page = getCurrentPage();
        print "<br>
            <a href='?page=login&referral=".$current_page["product"]."'>
                <button>Log in to purchase</button>
            </a>
        ";
    }
}

function showShoppingCart()
{
    $units_total = calculateTotalUnits();
    print "<a href='?page=cart'>".htmlspecialchars('🛒')."(".$units_total.")</a>";
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

?>