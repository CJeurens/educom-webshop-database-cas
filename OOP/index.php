<?php
    session_start();
    include 'presentation_layer.php';
 
    require_once "PageController.php";
    $page = new PageController;
    $page->handleRequest();


    /*mySwitch();
    function mySwitch()
    {
        require_once "getpage.php";
        $getPage = new GetPage;

        $navlinks = array(
            "home"      => "🏠HOME",         //"link address" => "link display name"
            "about"     => "ℹ️ABOUT",
            "contact"   => "📞CONTACT",
            "shop"      => "🛍️SHOP"
        );

        $author = "Cas Jeurens";
        $page = "";

        switch($getPage->getPage())
        {
            case "home":
                require_once "page_home.php";
                $page = new HomePage(
                    title: "🏠HOME",
                    header: "🏠DIT IS HOME",
                    navlinks: $navlinks,
                    author: $author);
                break;
            case "about":
                require_once "page_about.php";
                $page = new AboutPage(
                    title: "ℹ️ABOUT",
                    header: "ℹ️DIT IS ABOUT",
                    navlinks: $navlinks,
                    author: $author);
                break;
            case "contact":
                require_once "page_contact.php";
                $page = new ContactPage(
                    title: "📞CONTACT",
                    header: "📞DIT IS CONTACT",
                    navlinks: $navlinks,
                    author: $author);
                break;

        }
        if (empty($page))
        {
            //error
        }
        else
        {
            $page->show();
        }
    }*/
?>
