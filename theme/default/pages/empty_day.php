<?php
    if(isset($_GET['date'])){
        $var = "This is empty day. Here will be options for admins to set new event date - " . $_GET['date'];
    }

    // if moderator or administrator options to create new event 
    
    include("empty_day.html");
?>