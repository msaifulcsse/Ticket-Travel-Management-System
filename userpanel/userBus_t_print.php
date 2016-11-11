<?php
session_start();
if (!isset($_SESSION["user"])) {
      header('Location: ../index.php');
      exit;
    }
        $busId =  $_SESSION["bus_id"];
		
		require_once('../mysqldb.php');;
		  $sql5 = "SELECT * FROM user_info";
		  $result5 = mysql_query($sql5);
		  while($row = mysql_fetch_array($result5))
		    {
		      $u_id= $row['email'];
		      if($_SESSION["user"] == $u_id)
		      {
		        $getName = $row['name'];
		        $getGen = $row['gender'];
		        $getEmail = $row['email'];
		        $getPhn = $row['phone'];
		      }   
		    }
			  $sql6 = "select * from user_ticket_info where bus_id = '$busId'";
			  $result6 = mysql_query($sql6);
			    while($row = mysql_fetch_array($result6))
			    {
			      $u_id= $row['user_id'];
			      $u_seat = $row['seats'];
			      if($_SESSION["user"] == $u_id && $_SESSION["seatNum"] == $u_seat)
			      {
			        $ticketID = $row['ticket_id'];
			      }   
			    }
		$getVehicle = $_SESSION["v_name"];
		$getDOJ = $_SESSION["jdate"];
		$getTime = $_SESSION["jtime"];
		$getRoute = $_SESSION["route"];
		$getSeats = $_SESSION["seatNum"];
		$getCategory = $_SESSION["category"];
		$getFare = $_SESSION["amount"];
		$getPaymethod = $_SESSION["payment"];

date_default_timezone_set('Asia/Dhaka');
$date = date('d/m/Y h:i:s A', time());
$dateTime = "Print@: ".$date;
		//////////////////////////
			
	  require ("fpdf/fpdf.php");
	  $pdf = new FPDF();

	  $pdf->AddPage();

	  $pdf->SetFont("Arial","B",10);
	  $pdf->Cell(190,10,"Your Ticket Information || Flight Ticket",1,1,"C");

      $pdf->Cell(95,10,"Ticket#: ",1,0,"C");
	  $pdf->Cell(95,10,$ticketID,1,1,"C");

	  $pdf->Cell(95,10,"Bus#: ",1,0,"C");
	  $pdf->Cell(95,10,$busId,1,1,"C");

	  $pdf->Cell(95,10,"Name: ",1,0,"C");
	  $pdf->Cell(95,10,$getName,1,1,"C");

	  $pdf->Cell(95,10,"Gender: ",1,0,"C");
	  $pdf->Cell(95,10,$getGen,1,1,"C");

	  $pdf->Cell(95,10,"Email: ",1,0,"C");
	  $pdf->Cell(95,10,$getEmail,1,1,"C");

	  $pdf->Cell(95,10,"Phone: ",1,0,"C");
	  $pdf->Cell(95,10,$getPhn,1,1,"C");

	  $pdf->Cell(95,10,"Vehicle Name: ",1,0,"C");
	  $pdf->Cell(95,10,$getVehicle,1,1,"C");

	  $pdf->Cell(95,10,"Date-Of-Journey: ",1,0,"C");
	  $pdf->Cell(95,10,$getDOJ,1,1,"C");

	  $pdf->Cell(95,10,"Time: ",1,0,"C");
	  $pdf->Cell(95,10,$getTime,1,1,"C");

	  $pdf->Cell(95,10,"Route: ",1,0,"C");
	  $pdf->Cell(95,10,$getRoute,1,1,"C");
	  
	  $pdf->Cell(95,10,"Seat Number: ",1,0,"C");
	  $pdf->Cell(95,10,$getSeats,1,1,"C");
	  
	  $pdf->Cell(95,10,"Seat Category: ",1,0,"C");
	  $pdf->Cell(95,10,$getCategory,1,1,"C");

	  $pdf->Cell(95,10,"Total Fare: ",1,0,"C");
	  $pdf->Cell(95,10,$getFare,1,1,"C");

	  $pdf->Cell(95,10,"Payment Getway: ",1,0,"C");
	  $pdf->Cell(95,10,$getPaymethod,1,1,"C");
      
      $pdf->Cell(190,10,$dateTime,0,0,"R");
      $pdf->Output();
?>