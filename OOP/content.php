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
                require_once "content_text_home.php";
                $showHome = new ContentTextHome();
                $showHome->show();
                //showHomeContent();
                break;
            case "about":
                require_once "content_text_about.php";
                $showAbout = new ContentTextAbout();
                $showAbout->show();
                //showAboutContent();
                break;
            case "contact":
                showContactContent();
                break;
            case "msg_sent":
                showMsgSentContent();
                break;
            case "login":
                print "<div class=sidebar>";
                require_once "login_form.php";
                $showLoginForm = new LoginForm();
                $showLoginForm->showForm();
                print "</div>";
                validateLoginInput();
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