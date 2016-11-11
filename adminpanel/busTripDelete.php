<?php
  session_start();
  if (!isset($_SESSION["admin"])) {
    header('Location: ../index.php');
    exit;
  }  
  require_once('../mysqldb.php');
   $id = $_REQUEST['id'];
   
	$usql= "DELETE FROM ticket_invoice WHERE bus_id ='$id'";
		if(!mysql_query($usql))
		{
			echo "Error: " . $usql . "<br>" . mysql_error($conn);
		}
	$usql= "DELETE FROM user_ticket_info WHERE bus_id ='$id'";
		if(!mysql_query($usql))
		{
			echo "Error: " . $usql . "<br>" . mysql_error($conn);
		}
	$usql= "DELETE FROM seat_info WHERE bus_id ='$id'";
		if(!mysql_query($usql))
		{
			echo "Error: " . $usql . "<br>" . mysql_error($conn);
		}
	$usql= "DELETE FROM bus_trips WHERE bus_id ='$id'";
		if(!mysql_query($usql))
		{
			echo "Error: " . $usql . "<br>" . mysql_error($conn);
		}	
		
	else
	{
		header('Location: adminBus.php');
        exit();
	}			
?>