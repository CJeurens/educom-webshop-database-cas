<?php

require_once "htmldoc.php";

class HomePage extends HtmlDoc
{
    public function __construct($title, $header, $navlinks, $author)
    {
        $this->title = $title;
        $this->header = $header;
        $this->navlinks = $navlinks;
        $this->author = $author;
    }
    
    protected function showHeadContent() 
    { 
        print "<meta charset='UTF-8'><title>".$this->title.
        "</title><link rel='stylesheet' href='/educom-webshop-database-cas/oop/stylesheet.css'>";
    }

    protected function showBodyContent()
    {
        require_once "header.php";
        $header = new Header($this->header);
        $header->show();
        
        require_once "navbar.php";
        $navbar = new NavBar($this->navlinks);
        $navbar->show();

        require_once "content_text.php";
        $text = new TextContent(
            text: array(
            "Van harte welkom op deze zeer mooie webpagina!"
        ));
        $text->show();

        require_once "footer.php";
        $footer = new Footer($this->author);
        $footer->showFooter();
    }
}

?>