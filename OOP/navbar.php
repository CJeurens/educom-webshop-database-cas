<?php
class NavBar
{
    public function __construct(array $links)
    {
        $this->links = $links;
    }

    public function show()
    {
        print "
        <div class='navbar'>
            <ul class='nav' style='color:rgb(58, 106, 157)'>".PHP_EOL;
            
                foreach ($this->links as $link=>$name)
                {
                    print "             <li><a href='?page=".$link."'>".htmlspecialchars($name)."</a> | </li>".PHP_EOL;
                }
                print "             <span class='account'><form method='post' id='logout' name='logout'><input type='hidden' name='page' value='logout'>";
                
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