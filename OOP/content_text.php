<?php

class TextContent
{
    public function __construct(array $text)
    {
        $this->text = $text;
    }

    public function show()
    {
        print "<div class='content'>";
        foreach ($this->text as $paragraph)
        {
            print "<p>".$paragraph."</p>";
        }
        print "</div>";
    }
}

?>