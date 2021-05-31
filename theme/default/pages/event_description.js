function disply_event_tw(data,id){
    document.getElementById("descr").src = "../theme/default/pages/display.php?date=" + data + "&id=" + id;
}
function empty_event(data){
    document.getElementById("descr").src = "../theme/default/pages/empty_day.php?date=" + data;
}