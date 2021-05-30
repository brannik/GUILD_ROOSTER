<?php
    if(isset($_GET['date'])){
        $dateR = $_GET['date'];
    }
    if(isset($_GET['id'])){
        $idR = $_GET['id'];
    }
    
    include("event_displ.html");
?>