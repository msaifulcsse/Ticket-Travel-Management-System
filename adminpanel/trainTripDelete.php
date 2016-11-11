<?php
  session_start();
  if (!isset($_SESSION["admin"])) {
    header('Location: ../index.php');
    exit;
  } 
  require_once('../mysqldb.php');
   $id = $_REQUEST['id'];
   
	$usql= "DELETE FROM ticket_invoice WHERE flight_id ='$id'";
		if(!mysql_query($usql))
		{
			echo "Error: " . $usql . "<br>" . mysql_error($conn);
		}
	$usql= "DELETE FROM seat_info WHERE flight_id ='$id'";
		if(!mysql_query($usql))
		{
			echo "Error: " . $usql . "<br>" . mysql_error($conn);
		}
	$usql= "DELETE FROM flight_trips WHERE flight_id ='$id'";
		if(!mysql_query($usql))
		{
			echo "Error: " . $usql . "<br>" . mysql_error($conn);
		}	
		
	else
	{
		header('Location: adminFlight.php');
        exit();
	}			
?>