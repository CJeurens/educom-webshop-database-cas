<?php
    session_start();
    include 'presentation_layer.php';
 
    require_once "PageController.php";
    $page = new PageController;
    $page->handleRequest();
?>
