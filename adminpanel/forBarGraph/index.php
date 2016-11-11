<?php
  session_start();
  if (!isset($_SESSION["admin"])) {
    header('Location: ../index.php');
    exit;
  }
  else
  	echo "Please Select Your Desire Page!!!";
?>