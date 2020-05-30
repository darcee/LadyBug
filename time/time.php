<?php
date_default_timezone_set('America/Los_Angeles');
function timezoneChange_From_UTC($rawtime,$timezone){
    $converttimestamp = new DateTime($rawtime, new DateTimeZone('UTC') );
    $converttimestamp->setTimeZone(new DateTimeZone($timezone));
    $converttimestamp =  $converttimestamp->format('Y-m-d H:i:s');
    return $converttimestamp;
}
function timezoneChange_To_UTC($rawtime,$timezone){
    $converttimestamp = new DateTime($rawtime, new DateTimeZone($timezone));
    $converttimestamp->setTimeZone(new DateTimeZone('UTC'));
    $converttimestamp =  $converttimestamp->format('Y-m-d H:i:s');
    return $converttimestamp;
}

$timezone  = 'America/Los_Angeles';
$starttime = date("Y-m-d H:i:s",  strtotime("midnight yesterday - 30 minutes"));
echo "This is the midnight yesterday PST : ".$starttime."<br>";
$starttime = timezoneChange_To_UTC($starttime, $timezone);
echo "This is the Start time: ".$starttime."<br>";
$endtime = date("Y-m-d",  strtotime("yesterday"));
$endtime =date("Y-m-d H:i:s",  strtotime($endtime." 23:59:59"));
$endtime = timezoneChange_To_UTC($starttime, $timezone);
echo "This is new time : ".$endtime."<br>";

$testtime = date("Y-m-d H:i:s",  strtotime('now'));
echo "This is now PST : ".$testtime."<br>";
$testtime = timezoneChange_To_UTC($starttime, $timezone);
echo "This is the shifted time: ".$testtime."<br>";
$testtime = timezoneChange_From_UTC($starttime, $timezone);
echo "This is new time : ".$testtime."<br>";
function stopWatch($time1, $time2){}

