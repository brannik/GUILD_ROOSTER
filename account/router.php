<?php
    include($_SERVER['DOCUMENT_ROOT']."/redirections.php");
    //require("../config/connection.php");
    //require("../core/core.php");
    //$xml=simplexml_load_file("../config/deff_theme.xml") or die("Error: Cannot create object");
    if(isset($_GET['LOGIN_REQUEST'])){
        $userFound = false;
        $message = "";
        // check credentials and if true log in
        $upperNameL = strtoupper($_GET['userName']);
        $sqlGetAcc = "SELECT * FROM accounts WHERE username='" . $upperNameL . "'";
        $result = $conn->query($sqlGetAcc);
        $rememberLoggedIn = false;
        if($result->num_rows > 0){
            $pass = sha1($_GET['userPass']);
            foreach($result as $row){
                if(strcmp($pass,$row['password']) == 0){
                    $userFound = true;
                    if(isset($_GET['stayIn'])){
                        $rememberLoggedIn = true;
                    }else{
                        $rememberLoggedIn = false;
                    }
                    //$account->setData($row['id'],$row['rank'],$row['guild_id'],$rememberLoggedIn);
                    if($rememberLoggedIn){
                        setcookie("logged_in", $row['id'], time() + (86400 * 30), "/"); // 86400 = 1 day
                        setcookie("guild_id", $row['guild_id'], time() + (86400 * 30), "/");
                    }else{
                        setcookie("logged_in", $row['id'], 86400, "/"); // 86400 = 1 day
                        setcookie("guild_id", $row['guild_id'], 86400, "/");
                    }
                }else{
                    $userFound = false;
                    $message = $message . "Wrong password!!!";
                }
            }
        }else{
            $userFound = false;
            $message = $message . "Account not found!!!";
        }
        // validate data then do log in
        if($userFound){
            //echo $_GET['userName'] . " -> " . $_GET['userPass'];
            //include(INDEX_PAGE);
            header('Location: /');
            //include($xml->path . "" . $xml->index_page);
        }else{
            //include($xml->path . "" . $xml->login_page);
            include(LOGIN_PAGE);
            echo "Login error ->" . $message;
        }
    }elseif(isset($_GET['REGISTER_REQUEST'])){
        //include($xml->path . "" . $xml->register_page);
        include(REGISTER_PAGE);
    }elseif(isset($_GET['VALIDATE_REGISTER'])){
        $isValid = false;
        $msg = "";
        //validate data and if all good create account then go to login page
        if(!is_null($_GET['ReguserName'])){
            if(strlen($_GET['ReguserName']) > 3){
                if(!is_null($_GET['ReguserPass'])){
                    if(strlen($_GET['ReguserPass']) > 8){
                        //echo "Registering account with name {$_GET['ReguserName']} <br> Password {$_GET['ReguserPass']} <br> and fraction {$_GET['ReguserFraction']}";
                        // after sucsess query return to login page else display error
                        $fact = 0;
                        if(strcmp($_GET['ReguserFraction'],"horde") == 0){
                            $fact = 1;
                        }else{
                            $fact = 2;
                        }
                        $upperName = strtoupper($_GET['ReguserName']);
                        $hashed_pass = sha1($_GET['ReguserPass']);
                        $sqlFindAcc = "SELECT * FROM accounts WHERE username='" . $upperName . "'";
                        $count = $conn->query($sqlFindAcc);
                        if($count->num_rows > 0){
                            $msg = $msg . "This username exsist!!!";
                            $isValid = false;
                        }else{
                            $sqlRegister = "INSERT INTO accounts (username,password,rank,fraction) VALUES('" . $upperName . "','" . $hashed_pass . "','0','" . $fact. "')";
                        
                            if($conn->query($sqlRegister) === TRUE){
                                $isValid = true;   
                                //include($xml->path . "" . $xml->login_page); 
                            }else{
                                $isValid = false;
                            }
                        }
                        
                    }else{
                        $msg = $msg . "Password must be more than 8 symbols";
                    }
                }else{
                    $msg = $msg .  "Please enter password!<br>";        
                }
            }else{
                $msg = $msg .  "Username must have more than 3 symbols!<br>";
            }
        }else{
            $msg = $msg . "Please enter username!<br>";
        }
        if($isValid){
            include(LOGIN_PAGE);
            //include($xml->path . "" . $xml->login_page);
        }else{
            include(REGISTER_PAGE);
            //include($xml->path . "" . $xml->register_page);
            echo $msg;
        }
    }
    else{
        include(LOGIN_PAGE);
        // display login/register form
        //include($xml->path . "" . $xml->login_page);
    }
    
?>