<?php
    include($_SERVER["DOCUMENT_ROOT"]."/config/connection.php");
    //require($_SERVER["DOCUMENT_ROOT"]."/core/core.php");
    $id = 0;

    if(isset($_COOKIE['guild_id'])){
        $id = $_COOKIE['guild_id'];
    }
    

    $sqlGetGuild = "SELECT * FROM guild WHERE id='" . $id . "'";
    $name = "";
    $count = 0;
    $res = $conn->query($sqlGetGuild);
    if($res->num_rows > 0){
        foreach($res as $row){
            $name = $row['guild_name'];
            $count = $row['members_count'];
        }
    }
    print "<h2 id='guild_name_text'> < " . $name . " > (". $count ." members) </h2>";
?>