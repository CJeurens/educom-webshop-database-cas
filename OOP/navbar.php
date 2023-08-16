<?php
class NavBar
{
    public function showNav()
    {
        print "
        <div class='navbar'>
            <ul class='nav' style='color:rgb(58, 106, 157)'>
                <li><a href='?page=home'>".htmlspecialchars("🏠HOME")."</a> | </li>
                <li><a href='?page=about'>".htmlspecialchars("ℹ️ABOUT")."</a> | </li>
                <li><a href='?page=contact'>".htmlspecialchars("📞CONTACT")."</a> | </li>
                <li><a href='?page=shop'>".htmlspecialchars("🛍️SHOP")."</a></li>
                <span class='account'><form method='post' id='logout' name='logout'><input type='hidden' name='page' value='logout'>";
                
                require_once "login.php";
                $this->login = new Login();
                
                $this->login->showLogIn(); print "</form></span>
            </ul>
        </div>
        </div>
        ";
    }
}
?>