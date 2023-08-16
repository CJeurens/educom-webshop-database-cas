<?php
class Content
{
    public function __construct(GetPage $getPage)
    {
        $this->getPage = $getPage;
    }


    public function showContent()
    {
        $data=$this->getPage->getPage();
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
}
?>