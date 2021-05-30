<?php
    include($_SERVER['DOCUMENT_ROOT']."/redirections.php");
    $rank = 0;
    $menuItem="";
        $sqlGetAccRank = "SELECT * FROM accounts WHERE id='" . $_COOKIE['logged_in'] . "'";
        $resoult = $conn->query($sqlGetAccRank);
        if($resoult->num_rows > 0){
            foreach($resoult as $rankRow){
                $rank = $rankRow['rank'];
            }
        }
        if($rank > 1){
            $menuItem ='<li><a href="../core/main.php?page=admin" target="ifr_middle">ACP</a></li>';
        }

    include(MENU);
    
?>