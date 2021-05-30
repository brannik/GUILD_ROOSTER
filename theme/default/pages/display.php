<?php
    if(isset($_GET['date'])){
        $dateR = $_GET['date'];
    }
    if(isset($_GET['id'])){
        $idR = $_GET['id'];
    }
    // get data from db - event description and characters signed in - if admin or moderator options to aprove or decline applications
    // options to sign this event
    include("event_displ.html");
?>