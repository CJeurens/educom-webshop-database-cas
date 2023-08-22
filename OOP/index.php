<?php
    session_start();
    include 'presentation_layer.php';
 
    mySwitch();
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

        switch($getPage->getPage())
        {
            case "home":
                require_once "page_home.php";
                $homepage = new HomePage(
                    title: "🏠HOME",
                    header: "🏠DIT IS HOME",
                    navlinks: $navlinks,
                    author: "Cas Jeurens");
                $homepage->show();
                break;
            case "about":
                require_once "page_about.php";
                $aboutpage = new AboutPage(
                    title: "ℹ️ABOUT",
                    header: "ℹ️DIT IS ABOUT",
                    navlinks: $navlinks,
                    author: "Cas Jeurens");
                $aboutpage->show();
                break;
            case "contact":
                require_once "page_contact.php";
                $contactpage = new ContactPage(
                    title: "📞CONTACT",
                    header: "📞DIT IS CONTACT",
                    navlinks: $navlinks,
                    author: "Cas Jeurens");
                $contactpage->show();
                break;
        }
    }
?>
