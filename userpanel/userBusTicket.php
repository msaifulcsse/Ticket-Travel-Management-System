<?php
  session_start();
  if (!isset($_SESSION["user"])) {
      header('Location: ../index.php');
      exit;
    }
  if($_SESSION["bus_id"] == "")
  {
    header("Location: index.php");
    exit();
  }
  require_once('../mysqldb.php');
  $busId =  $_SESSION["bus_id"];
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
?>


<html>
<head>
    <meta charset="utf-8">
    <title>Software Project One</title>
  <link rel="stylesheet" href="../css/mainCSS.css">
  <link rel="stylesheet" href="../css/responsive.css">
<style type="text/css">
    th{
      background-color: #FFE4E1;
      }
    td{
      color: #008000;
      text-align: center;
      background-color: #FFE4E1;
    }
</style>
</head>
<body>
    <header>
      <a href="index.php" id="logo">
        <h1>Ticket & Travel Management</h1>
        <h2>Software Project One</h2>
      </a>
      <nav>
        <ul>
          <li><a href="index.php">Flights</a></li>
          <li><a href="userBus.php" class="selected">Buses</a></li>
          <li><a href="userTrain.php">Trains</a></li>
          <li><a href="user.php">Your Profile</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>
    <center> 
<h3 style="color: coral"><u>Your Ticket Informations</u></h3>
    
      <table border="1" style="width: 40%">
        <tr>
          <th>Ticket#: </th>
          <td><?php echo $ticketID ?></td>
        </tr>
        <tr>
          <th>Bus#: </th>
          <td><?php echo $_SESSION["bus_id"] ?></td>
        </tr>
        <tr>
          <th>Your Name: </th>
          <td><?php echo $getName ?></td>
        </tr>
        <tr>
          <th>Your Gender: </th>
          <td><?php echo $getGen ?></td>
        </tr>
        <tr>
          <th>Your Email: </th>
          <td><?php echo $getEmail ?></td>
        </tr>
        <tr>
          <th>Your Phone: </th>
          <td><?php echo $getPhn ?></td>
        </tr>
         <tr>
          <th>Vehicle Name: </th>
          <td><?php echo $_SESSION["v_name"] ?></td>
        </tr>
        <tr>
          <th>Journey Date: </th>
          <td><?php echo $_SESSION["jdate"] ?></td>
        </tr>
        <tr>
          <th>Time: </th>
          <td><?php echo $_SESSION["jtime"] ?></td>
        </tr>
        <tr>
          <th>Route: </th>
          <td><?php echo $_SESSION["route"] ?></td>
        </tr>
        <tr>
          <th>Your Seat: </th>
          <td><?php echo $_SESSION["seatNum"] ?></td>
        </tr>
        <tr>
          <th>Seat Category: </th>
          <td><?php echo $_SESSION["category"] ?></td>
        </tr>
        <tr>
          <th>Fare: </th>
          <td><?php echo $_SESSION["amount"] ?></td>
        </tr>
        <tr>
          <th>Payment By: </th>
          <td><?php echo $_SESSION["payment"] ?></td>
        </tr>  
      </table>
      <a href="userBus_t_print.php"><h3 style="background-color: green;border: none;color: white; font-size: 20px;display: inline-block;">Print Your Ticket</h3></a>

    </center>
    <br/> <br/>
    <header>
    <nav>
        <ul>
          <li><a href="../about.php">About</a></li>
          <li><a href="../contact.php">Contact</a></li>
          <li class="phone"><a href="tel:+880-16-7509-4640">+8801675094640</a></li>
        </ul>
      </nav>
      <div align="center" style="padding-top: 10px">
          <h2>Copyright&copy; 2013-2016 by <b><i>Team 3'S</i></b></h2>
          <a href="http://www.facebook.com/msaifulbdjoy"><img src="../images/facebook-wrap.png" alt="Facebook Logo" width="35" height="30"></a>
          <a href="http://twitter.com/msaifulbdjoy"><img src="../images/twitter-wrap.png" alt="Twitter Logo" width="35" height="30"></a>
          <a href="http://plus.google.com/+MDSAIFULISLAMBD"><img src="../images/google-wrap.png" alt="GooglePlus Logo" width="35" height="30"></a>
      </div>
    </header>
</body>
</html>