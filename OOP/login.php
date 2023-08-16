<?php
class Login
{
    public function showLogIn()
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
}
?>