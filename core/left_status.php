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
            
            $getGRank = "SELECT * FROM guild_ranks WHERE id='" . $row['guild_rank'] . "'";
            $resoultRank = $conn->query($getGRank);
            if($resoultRank->num_rows > 0){
                foreach($resoultRank as $rank){
                    $guild_rank = $rank['rank_name'];
                }
            }
            $sqlCountChars = "SELECT * FROM characters WHERE owner_id='" . $_COOKIE['logged_in'] . "'";
            $counter = $conn->query($sqlCountChars);
            $chars_table = "";
            if($counter->num_rows > 0){
                $characters_count = $counter->num_rows;
                foreach($counter as $my_char){
                    if($my_char['fraction'] == 1){
                        $chars_table = $chars_table . "<tr><td><img id='banner_horde'></td><td><img id='" . $my_char['char_class'] . "'></td><td><img id='" . $my_char['char_race'] . "'></td><td id='char_name'>" . $my_char['char_name'] . "</td><td>" . $my_char['char_level'] . "</td></tr>";
                    }else{
                        $chars_table = $chars_table . "<tr><td><img id='banner_ally'></td><td><img id='" . $my_char['char_class'] . "'></td><td><img id='" . $my_char['char_race'] . "'></td><td id='char_name'>" . $my_char['char_name'] . "</td><td>" . $my_char['char_level'] . "</td></tr>";
                    }
                }
            }

        }
    }

    
    
    
    include(LEFT_STATUS);
    
?>