<?php 
// in htmldoc.php :

require_once "getpage.php";
$getPage = new getPage();

class HtmlDoc
{
    private $title;
    private $author;
    private $getPage;

//======================================================
// PUBLIC
//======================================================
    public function __construct(string $title, GetPage $getPage)
    {
        $this->title = $title;
        $this->getPage = $getPage;
    }

    public function show()
    {
        $this->beginDoc();
        $this->beginHead();
        $this->showHeadContent();
        $this->endHead();
        $this->beginBody();
        $this->showBodyContent();
        $this->endBody();
        $this->endDoc();
    }    
//======================================================
// PROTECTED
//======================================================
    protected function beginDoc() 
    { 
        echo '<!DOCTYPE html>'.PHP_EOL.'<html>'; 
    }

    protected function showHeadContent() 
    { 
        print "<meta charset='UTF-8'>".$this->setTitle($this->getPage->getPage()).
        "<link rel='stylesheet' href='/educom-webshop-database-cas/oop/stylesheet.css'>";
    }
    
    protected function setTitle($data)
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
            case "cart":
                print "<title>".htmlspecialchars("🛒YOUR CART")."</title>";
                break;
        }
    }

    protected function showBodyContent() 
    { 
        require_once "header.php";
        $this->header = new Header($this->getPage);
        $this->header->showHeader();
        

        require_once "navbar.php";
        $this->navbar = new NavBar();
        $this->navbar->showNav();
        //showNav();

        require_once "content.php";
        $this->content = new Content($this->getPage);
        //$this->content = $content;
        $this->content->showContent();

        require_once "footer.php";
        $this->footer = new Footer("Cas Jeurens");
        $this->footer->showFooter();
    }
//======================================================
// PRIVATE
//======================================================
    private function beginHead() 
    { 
        echo '<head>'.PHP_EOL; 
    }

    private function endHead()
    { 
        echo '</head>'.PHP_EOL; 
    }
    
    private function beginBody() 
    { 
        echo '<body>'.PHP_EOL; 
    }

    private function endBody() 
    { 
        echo '</body>'.PHP_EOL; 
    }
    
    private function endDoc() 
    { 
        echo '</html>'.PHP_EOL; 
    }
}

?>