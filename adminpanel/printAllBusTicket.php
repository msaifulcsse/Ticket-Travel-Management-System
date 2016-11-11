<?php
 session_start();
  if (!isset($_SESSION["admin"])) {
    header('Location: ../index.php');
    exit;
  }
    require_once('../mysqldb.php');       
	  $sql = "SELECT user_name, gender, jdate, vehicle_name, route, category, jtime, seats, amount, pay_method, phone, bus_id, ticket_id FROM ticket_invoice WHERE ticket_invoice.flight_id IS NULL AND ticket_invoice.train_id IS NULL UNION SELECT name, gender, jdate, vehicle_name, route, category, jtime, seats, amount, pay_method, phone, bus_id, ticket_id FROM user_info, user_ticket_info WHERE user_info.user_id = user_ticket_info.user_id AND user_ticket_info.flight_id IS NULL AND user_ticket_info.train_id IS NULL";
	  $result = mysql_query($sql);
	  $i = 0;        
           
date_default_timezone_set('Asia/Dhaka');
$date = date('d/m/Y h:i:s A', time());
$dateTime = "Print@: ".$date;
			
	  require ("fpdf/fpdf.php");
	  $pdf = new FPDF('P','mm',array(400,320));

	  $pdf->AddPage();
 
	  $pdf->SetFont("Arial",'',10);
	  $pdf->Cell(300,10,"All Tickets of Flight",1,1,"C");

      $pdf->Cell(23,10,"DOJ",1,0,"C");
      $pdf->Cell(36,10,"Route",1,0,"C");
      $pdf->Cell(36,10,"Time",1,0,"C");
      $pdf->Cell(16,10,"Ticket#",1,0,"C"); 
	  $pdf->Cell(16,10,"Bus#",1,0,"C");
	  $pdf->Cell(26,10,"V.Name",1,0,"C");
	  $pdf->Cell(24,10,"Seat#",1,0,"C");
	  $pdf->Cell(26,10,"Category",1,0,"C");
	  $pdf->Cell(18,10,"Fare",1,0,"C");
	  $pdf->Cell(25,10,"Name",1,0,"C");
	  $pdf->Cell(24,10,"Gender",1,0,"C");
	  $pdf->Cell(30,10,"Phone",1,0,"C");
      
    while($row = mysql_fetch_array($result)) {
      echo $pdf->Cell(24,10,"",2,1,"C");
      echo $pdf->Cell(23,10,$row['jdate'],1,0,"C");
      echo $pdf->Cell(36,10,$row['route'],1,0,"C");
      echo $pdf->Cell(36,10,$row['jtime'],1,0,"C");
      echo $pdf->Cell(16,10,$row['ticket_id'],1,0,"C"); 
	  echo $pdf->Cell(16,10,$row['bus_id'],1,0,"C");
	  echo $pdf->Cell(26,10,$row['vehicle_name'],1,0,"C");
	  echo $pdf->Cell(24,10,$row['seats'],1,0,"C");
	  echo $pdf->Cell(26,10,$row['category'],1,0,"C");
	  echo $pdf->Cell(18,10,$row['amount'],1,0,"C");
	  echo $pdf->Cell(25,10,$row['user_name'],1,0,"C");
	  echo $pdf->Cell(24,10,$row['gender'],1,0,"C");
	  echo $pdf->Cell(30,10,$row['phone'],1,0,"C");
    }
      $pdf->Cell(300,10,$dateTime,0,0,"R");
      $pdf->Output();

?>