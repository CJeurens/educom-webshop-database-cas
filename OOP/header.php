<?php
class Header
{
    public function __construct(GetPage $getPage)
    {
        $this->getPage = $getPage;
    }
    
    public function showHeader()
    {
        $data = $this->getPage->getPage();
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
}
?>