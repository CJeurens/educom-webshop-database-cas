<?php
    session_start();
    include 'presentation_layer.php';


    $pageID = getPage();

    $data = handleRequest($pageID);

    startHtmlDoc(); 
    showHtmlHeadSection($data); 
    showHtmlBodySection($data); 
    endHtmlDoc();
?>
