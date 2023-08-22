<?php
class GetPage
{
    function getPage()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            if (isset($_GET["page"])) 
            {
                if (isset($_GET["product"]))
                {
                    $get_return["product"] = $_GET["product"];
                }
                //$get_return["page"] = $_GET["page"];
                $get_return = $_GET["page"];
                return $get_return;
            }
            else
            {
                //$get_return["page"] = "home";
                $get_return = "home";
                return $get_return;
            }   
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (isset($_POST["page"])) 
            {
                $post_return["page"] = $_POST["page"];
                return $post_return;
            }
            else
            {
                $post_return = getCurrentPage();
                return $post_return;
            }
        }
    }
}
?>