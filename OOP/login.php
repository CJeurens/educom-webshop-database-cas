<?php
class Login
{
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function showLogIn()
    {
        if (!empty($this->user))
        {
            print "Welcome ".$this->user."!
            <input type='hidden' value='logout' form='logout' name='page'>";
            //showShoppingCart();
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