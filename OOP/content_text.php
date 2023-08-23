<?php

require_once "appdoc.php";

class TextContent extends AppDoc
{
    public function __construct($title, $header, $navlinks, $text, $author)
    {
        parent::__construct($title, $header, $navlinks, $author);
        $this->text = $text;
    }

    public function showMainContent()
    {
        foreach ($this->text as $paragraph)
        {
            print "<p>".$paragraph."</p>".PHP_EOL;
        }
    }
    
}

?>