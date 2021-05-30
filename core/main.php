<?php
    include($_SERVER['DOCUMENT_ROOT']."/redirections.php");
    if(isset($_GET['page'])){
        switch($_GET['page']){
            case 'events':
                include(EVENTS_PAGE);
                break;
            case 'account':
                include(ACCOUNT_PAGE);
                break;
            case 'rooster':
                include(ROOSTER_PAGE);
                break;
            case 'admin':
                include(ACP_PAGE);
                break;
            default:
                include(EVENTS_PAGE);
                break;
        }
    }
    
?>