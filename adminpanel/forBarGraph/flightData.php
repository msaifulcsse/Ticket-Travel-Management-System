<?php
 session_start();
  if (!isset($_SESSION["admin"])) {
    header('Location: ../../index.php');
    exit;
  } 
header('Content-Type: application/json');
require_once('../../mysqldb.php');
$data  = array();
$fetch = mysql_query("SELECT concat(deptfrom, '-' , goingto) as Route, count(*) as JourneyNum FROM `flight_trips` group by (concat(deptfrom, '-' , goingto)) order by JourneyNum desc");
$i = 0;  
while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
    $row_array['Route'] = $row['Route'];
    $row_array['JourneyNum'] = $row['JourneyNum'];

    array_push($data,$row_array);
}
echo json_encode($data);
?>