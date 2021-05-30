<?php
    echo '<script src="../theme/default/pages/event_description.js"></script>';
    $events = array("EMPTY","ICC","RS","TOC","ULDUAR");
    $month = date('m');
    $year = date('Y');
    $calendar = "";
    $weeks = weeks_in_month($month,$year);
    $eventDates = array();
    $sqlGetEvents = "SELECT * FROM events WHERE MONTH(date) = '" . $month . "' AND YEAR(date) = '" . $year . "' ORDER BY date ASC"; 
    $resul = $conn->query($sqlGetEvents);
    if($resul->num_rows > 0){
        $eventDates = array();
        foreach($resul as $date){
            $temp = array($date['id'],$date['event_type'],$date['event_leader'],$date['date']);
            array_push($eventDates,$temp);
            //echo $events[$date['event_type']];
            //print_r ($eventDates);
        }
    }
    $elements_in_events = count($eventDates);
    $calendar = $calendar . "<table class='calendar'>" 
        . "<th class='c_header'><td colspan='7'>" . date('M') . " - " . $year ."</td></th>";
        $calendar = $calendar ."<tr class='c_row'><td class='c_cell'>Mon</td><td class='c_cell'>Tue</td><td class='c_cell'>Wed</td><td class='c_cell'>Thu</td><td class='c_cell'>Fri</td><td class='c_cell'>Sat</td><td class='c_cell'>Sun</td></tr>";

    $pointer = 0;
    // need to find 1-st day of week and his position
    
    $nameOfDay = date('D', strtotime(date('Y-m-01')));
    $fday = name_to_number($nameOfDay);

    $days_count = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    //$days_count = $days_count + 1;
    $start = 1;
    $end = 8;
    $todayDate = date("d");
    $firstWeek = true;
    for($i=0;$i<$weeks;$i++){
        $calendar = $calendar . "<tr class='c_row'>";
        for($y=$start;$y<$end;$y++){
            if($y<$days_count+$fday){
                if($y<$fday){
                    $calendar = $calendar . "<td></td>";
                }else{
                    $TMP = $y - $fday;
                    $TMP = $TMP + 1;
                    $dateS = new DateTime($eventDates[$pointer][3]);
                    $dateS = $dateS->format('d');
                    if(strcmp($TMP,$dateS) == 0){
                        $eventIdToSend = $eventDates[$pointer][0];
                        switch($eventDates[$pointer][1]){
                            
                            case 1:
                                if(strcmp($TMP,$todayDate) == 0){
                                    $calendar = $calendar . "<td class='c_cell' id='event_today'><span id='event_date'>" . $TMP . "</span><img src='' id='image_event_icc' onclick='disply_event_tw(" . $TMP. "," . $eventIdToSend . ")'>";
                                }else{
                                    $calendar = $calendar . "<td class='c_cell' id='event'><span id='event_date'>" . $TMP . "</span><img src='' id='image_event_icc' onclick='disply_event_tw(" . $TMP. "," . $eventIdToSend . ")'>";
                                }
                                
                                break;
                            case 2:
                                if(strcmp($TMP,$todayDate) == 0){
                                    $calendar = $calendar . "<td class='c_cell' id='event_today'><span id='event_date'>" . $TMP . "</span><img src='' id='image_event_rs' onclick='disply_event_tw(" . $TMP. "," . $eventIdToSend. ")'>";
                                }else{
                                    $calendar = $calendar . "<td class='c_cell' id='event'><span id='event_date'>" . $TMP . "</span><img src='' id='image_event_rs' onclick='disply_event_tw(" . $TMP. "," . $eventIdToSend. ")'>";
                                }
                                
                                break;
                            case 3:
                                if(strcmp($TMP,$todayDate) == 0){
                                    $calendar = $calendar . "<td class='c_cell' id='event_today'><span id='event_date'>" . $TMP . "</span><img src='' id='image_event_toc' onclick='disply_event_tw(" . $TMP. "," . $eventIdToSend . ")'>";
                                }else{
                                    $calendar = $calendar . "<td class='c_cell' id='event'><span id='event_date'>" . $TMP . "</span><img src='' id='image_event_toc' onclick='disply_event_tw(" . $TMP. "," . $eventIdToSend . ")'>";
                                }
                                
                                break;
                            case 4:
                                if(strcmp($TMP,$todayDate) == 0){
                                    $calendar = $calendar . "<td class='c_cell' id='event_today'><span id='event_date'>" . $TMP . "</span><img src='' id='image_event_ulduar' onclick='disply_event_tw(" . $TMP. "," . $eventIdToSend . ")'>";
                                }else{
                                    $calendar = $calendar . "<td class='c_cell' id='event'><span id='event_date'>" . $TMP . "</span><img src='' id='image_event_ulduar' onclick='disply_event_tw(" . $TMP. "," . $eventIdToSend . ")'>";
                                }
                                
                                break;
                        }
                        if($pointer < $elements_in_events-1){
                            $pointer = $pointer + 1;
                        }
                       
                    }else{
                        if(strcmp($TMP,$todayDate) == 0){
                            $calendar = $calendar . "<td class='c_cell' id='event_today' onclick='empty_event(". $TMP .")'>" . $TMP . "</td>";
                        }else{
                            $calendar = $calendar . "<td class='c_cell' onclick='empty_event(". $TMP .")'>" . $TMP . "</td>";
                        }
                        
                    }

                    
                    
                }
                //echo $eventDates[$pointer][3];
                
                
            }
        }
        $start = $start + 7;
        $end = $end + 7;

        $calendar = $calendar . "</tr>";
    }
    $calendar = $calendar . "</table>";
        
    include("events.html");

    function weeks_in_month($month, $year) {
        // Start of month
        $start = mktime(0, 0, 0, $month, 1, $year);
        // End of month
        $end = mktime(0, 0, 0, $month, date('t', $start), $year);
        // Start week
        $start_week = date('W', $start);
        // End week
        $end_week = date('W', $end);
       
        if ($end_week < $start_week) { // Month wraps
            return ((52 + $end_week) - $start_week) + 1;
        }
        
        return ($end_week - $start_week) + 1;
    }
    function name_to_number($name){
        $number = 0;
        switch($name){
            case 'Mon':
                $number = 1;
                break;
            case 'Tue':
                $number = 2;
                break;
            case 'Wed':
                $number = 3;
                break;
            case 'Thu':
                $number = 4;
                break;
            case 'Fri':
                $number = 5;
                break;
            case 'Sat':
                $number = 6;
                break;
            case 'Sun':
                $number = 7;
                break;
        }
        return $number;
    }
?>