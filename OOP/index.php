<?php
    session_start();
    include 'presentation_layer.php';
    //$pageID = getPage();
    //$data = handleRequest($pageID);
    //$data["page"] = "about";

    require_once 'htmldoc.php';
    $myDoc = new HtmlDoc('flip',$getPage);
    $myDoc -> show();

    /*startHtmlDoc(); 
    showHtmlHeadSection($data); 
    showHtmlBodySection($data); 
    endHtmlDoc();*/
?>
