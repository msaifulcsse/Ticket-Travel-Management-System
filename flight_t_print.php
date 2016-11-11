<?php
session_start();
        $flightId =  $_SESSION["flight_id"];
        $ticketNum = $_SESSION["ticket_id"];
		$getName = $_SESSION["fname"];
		$getGen = $_SESSION["gender"];
		$getEmail = $_SESSION["email"];
		$getPhn = $_SESSION["phone"];
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
	  $pdf->Cell(95,10,$ticketNum,1,1,"C");

	  $pdf->Cell(95,10,"Flight#: ",1,0,"C");
	  $pdf->Cell(95,10,$flightId,1,1,"C");

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

      //header('Location: index.php');
      //exit(); 
?>