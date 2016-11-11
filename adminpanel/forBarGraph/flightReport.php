<?php
  session_start();
  if (!isset($_SESSION["admin"])) {
    header('Location: ../../index.php');
    exit;
  }
?>  
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Software Project One</title>
  <link rel="stylesheet" href="../../css/mainCSS.css">
  <link rel="stylesheet" href="../../css/responsive.css">
  <style type="text/css">
      #chart-container {
        width: 640px;
        height: auto;
      }
  </style>
</head>
<body>
 <header>
      <a href="../index.php" id="logo">
        <h1>Ticket & Travel Management</h1>
        <h2>Software Project One || <b><i>Admin Panel</i></b></h2>
      </a>
      <nav>
        <ul>
          <li><a href="../adminFlight.php">FlightInfo</a></li>
          <li><a href="flightReport.php" class="selected">FlightReport</a></li>
          <li><a href="../adminBus.php">BuseInfo</a></li>
          <li><a href="busReport.php">BusReport</a></li>
          <li><a href="../adminTrain.php">TrainInfo</a></li>
          <li><a href="trainReport.php">TrainReport</a></li>
          <li><a href="../addCoupon.php" id="link">CouponInfo</a></li>
          <li><a href="../userMessage.php" id="link">Messages</a></li>
          <li><a href="../../logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>
<center>
    <div id="chart-container">
      <canvas id="mycanvas"></canvas>
    </div>
    <h3 style="color: coral;"><u style="color: black;">Figure:</u> &nbsp; Route Vs HowManyTimes</h3>
</center>
<br/> <br/>
    <header>
    <nav>
        <ul>
          <li><a href="../../about.php">About</a></li>
          <li><a href="../../contact.php">Contact</a></li>
          <li class="phone"><a href="tel:+880-16-7509-4640">+8801675094640</a></li>
        </ul>
      </nav>
      <div align="center" style="padding-top: 10px">
          <h2>Copyright&copy; 2013-2016 by <b><i>Team 3'S</i></b></h2>
          <a href="http://www.facebook.com/msaifulbdjoy"><img src="../../images/facebook-wrap.png" alt="Facebook Logo" width="35" height="30"></a>
          <a href="http://twitter.com/msaifulbdjoy"><img src="../../images/twitter-wrap.png" alt="Twitter Logo" width="35" height="30"></a>
          <a href="http://plus.google.com/+MDSAIFULISLAMBD"><img src="../../images/google-wrap.png" alt="GooglePlus Logo" width="35" height="30"></a>
      </div>
    </header>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="Chart.min.js"></script>
    <script type="text/javascript" src="flightApp.js"></script>
</body>
</html>