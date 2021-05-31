<?php
    define("ROOT_FOLDER",$_SERVER['DOCUMENT_ROOT']);
    $xml=simplexml_load_file(ROOT_FOLDER."/config/deff_theme.xml") or die("Error: Cannot load theme file!!!");
    define("LOGIN_PAGE",$xml->path . "" . $xml->login_page);
    define("REGISTER_PAGE",$xml->path . "" . $xml->register_page);
    define("LEFT_STATUS",$xml->path . "" . $xml->left_status);
    define("MENU",$xml->path . "" . $xml->menu);
    define("INDEX_PAGE",ROOT_FOLDER . $xml->path . "" . $xml->index_page);
    define("EVENTS_PAGE",$xml->path . "" . $xml->events_page);
    define("ACCOUNT_PAGE",$xml->path . "" . $xml->account_page);
    define("ROOSTER_PAGE",$xml->path . "" . $xml->rooster_page);
    define("FOOTER_PAGE",$xml->path . "" . $xml->footer_page);
    define("ACP_PAGE",$xml->path . "" . $xml->acp_page);


    define("CONFIG_FOLDER",ROOT_FOLDER . "/config");
    include(CONFIG_FOLDER."/connection.php");

?>