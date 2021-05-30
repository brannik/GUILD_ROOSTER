<?php
$xml=simplexml_load_file("config/deff_theme.xml") or die("Error: Cannot create object");
    if(isset($_COOKIE['logged_in'])){
        // load main page
        //header("Location: core/main.php");
        header("Location: " . $xml->path . "" . $xml->index_page);
    }else{
        // redirect to login-register page
        header("Location: account/router.php");
    }
?>