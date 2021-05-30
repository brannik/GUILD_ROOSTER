<?php
    include($_SERVER['DOCUMENT_ROOT']."/redirections.php");
    // get data from database
    $sqlGetAccInfo = "SELECT * FROM accounts WHERE id='" . $_COOKIE['logged_in']. "'";
    $res = $conn->query($sqlGetAccInfo);
    $webSite_rank = "";
    $webRankIndex = 0;
    $webRanks = array("Player","Moderator","Administrator");
    $net_dkp;
    $tot_dkp;
    $hours;
    $guild_rank;
    $guild_rank_index;
    $characters_count;
    if($res->num_rows > 0){
        foreach($res as $row){
            $username = $row['username'];
            $webRankIndex = $row['rank'];
            $webSite_rank = $webRanks[$webRankIndex];
            $net_dkp = $row['net_dkp'];
            $tot_dkp = $row['tot_dkp'];
            $hours = $row['hours'];
            $characters_count = 10; // calculate from db
            $getGRank = "SELECT * FROM guild_ranks WHERE id='" . $row['guild_rank'] . "'";
            $resoultRank = $conn->query($getGRank);
            if($resoultRank->num_rows > 0){
                foreach($resoultRank as $rank){
                    $guild_rank = $rank['rank_name'];
                }
            }
        }
    }
    
    
    include(LEFT_STATUS);
    
?>