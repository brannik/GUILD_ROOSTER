<?php
    include($_SERVER['DOCUMENT_ROOT']."/redirections.php");
    $transfer = "";
    $progress_table;
    if(isset($_GET["REG_VIA_JSON"])){
        //echo "register via json file";
        $acc_name = "select file first";
        include("interface_reg_via_json.html");
    }elseif(isset($_POST["submit"])){
        $target_dir = "../TEMP/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        if(strcmp($_FILES["file"]["name"],"registration.json") == 0) {
            //echo "File is an image - ";
            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }
            $string = file_get_contents($target_file);
            $json_a = json_decode($string, true);
            $transfer = $target_file;
            foreach($json_a['Characters'] as $character_data){
                //echo $character_data['name'] . " - " . $character_data['level'] . " - " . $character_data['is_main'] . " - " . $character_data['alt_of'];
                if($character_data['is_main']){
                    $acc_name = $character_data['name'];
                    $acc_fraction = $character_data['fraction'];
                    $acc_g_rank = $character_data['g_rank'];
                }
            }
            include("interface_reg_via_json.html");
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $acc_name = "Wrong file format, please fing correct file.";
            include("interface_reg_via_json.html");
            $uploadOk = 0;
        }
        
    }elseif(isset($_POST["REGISTER_FINAL"])){
        //echo $_POST["file_location"];
        $regValid = false;
        $string2 = file_get_contents($_POST["file_location"]);
        $json_b = json_decode($string2,true);
        $net_dkp = $json_b['DKP']['net'];
        $tot_dkp = $json_b['DKP']['total'];
        $hours = $json_b['DKP']['hours'];
        $guild_name = $json_b['DKP']['g_name'];
        $guildId = 0;
        $new_account_id = 0;
        //echo $_POST["usern_name_forReg"];
        //echo $_POST["pswd_text"];
        $rank_in_guild = $json_b['DKP']['g_rank'];
        //echo $_POST["rank_in_guild"];
        $progress_table = "";
        $string = file_get_contents($_POST["file_location"]);
        $json_a = json_decode($string, true);
        $msg = "";
        $UserName = $_POST["usern_name_forReg"];
        $upperName = strtoupper($UserName);
        $sqlGetGuild = "SELECT * FROM guild WHERE guild_name ='" . $guild_name . "'";
                    $ressu = $conn->query($sqlGetGuild);
                    if($ressu->num_rows > 0){
                        foreach($ressu as $guildN){
                            $guildId = $guildN["id"];
                        }
                    }
        // register account
        if(!is_null($_POST["pswd_text"])){
            if(strlen($_POST["pswd_text"]) > 8){
                //echo "Registering account with name {$_GET['ReguserName']} <br> Password {$_GET['ReguserPass']} <br> and fraction {$_GET['ReguserFraction']}";
                // after sucsess query return to login page else display error
                $fact = $_POST["fraction_forReg"];
                
                $hashed_pass = sha1($_POST["pswd_text"]);
                $sqlFindAcc = "SELECT * FROM accounts WHERE username='" . $upperName . "'";
                $count = $conn->query($sqlFindAcc);
                if($count->num_rows > 0){
                    $msg = $msg . "This username exsist!!!";
                    $regValid = false;
                }else{
                    // get guild id
                    
                    $sqlRegisterMe = "INSERT INTO accounts (username,password,rank,fraction,guild_id,guild_rank,net_dkp,tot_dkp,hours,active) 
                        VALUES('" . $upperName . "','" . $hashed_pass . "','0','" . $fact. "','" . $guildId . "','" . $rank_in_guild . "','" . $net_dkp . "','" . $tot_dkp . "','" . $hours . "','1')";
                
                    if($conn->query($sqlRegisterMe) === TRUE){
                        echo "REGISTERED"; 
                        $regValid = true;
                        //include($xml->path . "" . $xml->login_page); 
                    }else{
                        $regValid = false;
                        echo "REGISTER ERROR";
                    }
                }
                
            }else{
                $msg = $msg . "Password must be more than 8 symbols";
            }
        }else{
            $msg = $msg .  "Please enter password!<br>";        
        }
        echo $msg;
        // get acc_id
        $sqlGetId = "SELECT * FROM accounts WHERE username='" . $upperName . "'";
        $id_res = $conn->query($sqlGetId);
        if($id_res->num_rows > 0){
            foreach($id_res as $a_id){
                $new_account_id = $a_id['id'];
            }
        }
        if($regValid){
        foreach($json_a['Characters'] as $character_data){
            //echo $character_data['name'] . " - " . $character_data['level'] . " - " . $character_data['is_main'] . " - " . $character_data['alt_of'];
            $ch_name = $character_data['name'];
            $ch_faction = $character_data['fraction'];
            $ch_class = $character_data['class_index'];
            $ch_race = $character_data['race_index'];
            $ch_level = $character_data['level'];
            $ch_alt_of = $character_data['alt_of'];
            $ch_g_rank = $character_data['g_rank'];
            $ch_notes = $character_data['notes'];
            $ch_is_main = $character_data['is_main'];
            $sqlStoreChar = "INSERT INTO characters (char_name,fraction,char_class,char_race,char_level,char_owner,char_rank,notes,is_main,owner_id) 
                VALUES('" . $ch_name . "','" . $ch_faction. "','" . $ch_class . "','" . $ch_race . "','" . $ch_level . "','" . $ch_alt_of . "','" . $ch_g_rank . "','" . $ch_notes . "','" . $ch_is_main . "','" . $new_account_id . "')";
            if($conn->query($sqlStoreChar) === TRUE){
                if($character_data['is_main'] == 1){
                    if($character_data['fraction'] == 1){
                        $progress_table = $progress_table . "<tr><td><img id='banner_horde'></td><td><img id='" . $character_data['class_index'] . "'></td><td><img id='" . $character_data['race_index'] . "'></td><td id='char_name'>" . $character_data['name'] . "</td><td>Main</td><td>" . $character_data['g_rank'] . "</td><td>" . $character_data['level'] . "</td><td>" . $character_data['notes'] . "</td><td id='OK'>Imported</td><></tr>";
                    }elseif($character_data['fraction'] == 2){
                        $progress_table = $progress_table . "<tr><td><img id='banner_ally'></td><td><img id='" . $character_data['class_index'] . "'></td><td><img id='" . $character_data['race_index'] . "'></td><td id='char_name'>" . $character_data['name'] . "</td><td>Main</td><td>" . $character_data['g_rank'] . "</td><td>" . $character_data['level'] . "</td><td>" . $character_data['notes'] . "</td><td id='OK'>Imported</td></tr>";
                    }
                   
                }else{
                    if($character_data['fraction'] == 1){
                        $progress_table = $progress_table . "<tr><td><img id='banner_horde'></td><td><img id='" . $character_data['class_index'] . "'></td><td><img id='" . $character_data['race_index'] . "'></td><td id='char_name'>" . $character_data['name'] . "</td><td> of ". $character_data['alt_of'] ."</td><td>" . $character_data['g_rank'] . "</td><td>" . $character_data['level'] . "</td><td>" . $character_data['notes'] . "</td><td id='OK'>Imported</td></tr>";
                    }elseif($character_data['fraction'] == 2){
                        $progress_table = $progress_table . "<tr><td><img id='banner_ally'></td><td><img id='" . $character_data['class_index'] . "'></td><td><img id='" . $character_data['race_index'] . "'></td><td id='char_name'>" . $character_data['name'] . "</td><td> of ". $character_data['alt_of'] ."</td><td>" . $character_data['g_rank'] . "</td><td>" . $character_data['level'] . "</td><td>" . $character_data['notes'] . "</td><td id='OK'>Imported</td></tr>";
                    }
                    
                }
            }else{
                if($character_data['is_main']){
                    if($character_data['fraction'] == 1){
                        $progress_table = $progress_table . "<tr><td><img id='banner_horde'></td><td><img id='" . $character_data['class_index'] . "'></td><td><img id='" . $character_data['race_index'] . "'></td><td id='char_name'>" . $character_data['name'] . "</td><td>Main</td><td>" . $character_data['g_rank'] . "</td><td>" . $character_data['level'] . "</td><td>" . $character_data['notes'] . "</td><td id='ERR'>Error</td></tr>";
                    }elseif($character_data['fraction'] == 2){
                        $progress_table = $progress_table . "<tr><td><img id='banner_ally'></td><td><img id='" . $character_data['class_index'] . "'></td><td><img id='" . $character_data['race_index'] . "'></td><td id='char_name'>" . $character_data['name'] . "</td><td>Main</td><td>" . $character_data['g_rank'] . "</td><td>" . $character_data['level'] . "</td><td>" . $character_data['notes'] . "</td><td id='ERR'>Error</td></tr>";
                    }
                   
                }else{
                    if($character_data['fraction'] == 1){
                        $progress_table = $progress_table . "<tr><td><img id='banner_horde'></td><td><img id='" . $character_data['class_index'] . "'></td><td><img id='" . $character_data['race_index'] . "'></td><td id='char_name'>" . $character_data['name'] . "</td><td> of ". $character_data['alt_of'] ."</td><td>" . $character_data['g_rank'] . "</td><td>" . $character_data['level'] . "</td><td>" . $character_data['notes'] . "</td><td id='ERR'>Error</td></tr>";
                    }elseif($character_data['fraction'] == 2){
                        $progress_table = $progress_table . "<tr><td><img id='banner_ally'></td><td><img id='" . $character_data['class_index'] . "'></td><td><img id='" . $character_data['race_index'] . "'></td><td id='char_name'>" . $character_data['name'] . "</td><td> of ". $character_data['alt_of'] ."</td><td>" . $character_data['g_rank'] . "</td><td>" . $character_data['level'] . "</td><td>" . $character_data['notes'] . "</td><td id='ERR'>Error</td></tr>";
                    }
                    
                }
            }
            
            
        }
    }
        include("interface_reg_via_json_final.html");
    }elseif(isset($_POST['GO_TO_LOGGIN_PAGE'])){
        header('Location: /');
    }
?>