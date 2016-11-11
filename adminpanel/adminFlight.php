<?php
  session_start();
  if (!isset($_SESSION["admin"])) {
    header('Location: ../index.php');
    exit;
  }
  require_once('../mysqldb.php');
  $err = "";
   if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['submit']))
      {    
        $date = $_REQUEST['datepicker'];
        $p_name = $_REQUEST['airName'];
        $dept_from = $_REQUEST['deptfrom'];
        $going_to = $_REQUEST['goingto'];
        $category = $_REQUEST['seat_category'];
        $dept_time = $_REQUEST['takeTime'];
        $arri_time = $_REQUEST['landTime'];
        $fare = $_REQUEST['fare'];

        $sql ="INSERT INTO flight_trips (tourdate, p_name, deptfrom, goingto, category, dept_time, arri_time, fare_per_seat, avai_seat) VALUES ('$date', '$p_name', '$dept_from', '$going_to', '$category', '$dept_time', '$arri_time', '$fare', 35)";
        if(!mysql_query($sql))
          {
            $err = '<h3 style="color:red">Trip Not Added, Please do it again </h3>';
          }
        else 
          $err = '<h3 style="color:green">Trip Successfully Added</h3>';
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
      background-color: white;
      }
    td{
      text-align: center;
      background-color: FFE4E1;
    }
  </style>
</head>
<body>
 <header>
      <a href="index.php" id="logo">
        <h1>Ticket & Travel Management</h1>
        <h2>Software Project One || <b><i>Admin Panel</i></b></h2>
      </a>
      <nav>
        <ul>
          <li><a href="adminFlight.php" class="selected">FlightInfo</a></li>
          <li><a href="forBarGraph/flightReport.php" >FlightReport</a></li>
          <li><a href="adminBus.php">BusInfo</a></li>
          <li><a href="forBarGraph/busReport.php">BusReport</a></li>
          <li><a href="adminTrain.php">TrainInfo</a></li>
          <li><a href="forBarGraph/trainReport.php">TrainReport</a></li>
          <li><a href="addCoupon.php" id="link">CouponInfo</a></li>
          <li><a href="userMessage.php" id="link">Messages</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>
<center>
<h3 style="color: #2F4F4F;"> Admin Panel || Flights </h3>

<!-- For Trip Delete -->
<div>
<?php        
    $sql = "select * from flight_trips";
    $result = mysql_query($sql);
    $i = 0;        
?>
<form method="POST">
  <h3 style="background-color: FF4500;color: white;"> Available Trips</h3><br>
    <table border="1" style="border-collapse: collapse; width:100%;">
      <tr style="color: 008000">
          <th>Journey Date</th>
          <th>Airplane Name </th>
          <th>Routes</th> 
          <th>Category</th>
          <th>Take Off</th> 
          <th>Landing</th>
          <th>Avai. Seats</th>
          <th>Trips Delete</th>
      </tr>

      <?php
      //?id = <?php echo $row['flight_id']
        while($row = mysql_fetch_array($result)) {
          $_SESSION["flight_id"]=$row['flight_id'];
      ?>              
               
       <tr> 
           <td>
            <?php echo $row['tourdate']?>
           </td>
           <td>
            <?php echo $row['p_name']?>
           </td>
           <td>
            <?php echo $row['deptfrom']." - ".$row['goingto'] ?>
           </td>
           <td>
             <?php echo $row['category']?>
           </td>
           <td>
             <?php echo $row['dept_time']?>
           </td>
           <td>
             <?php echo $row['arri_time']?>
           </td>
           <td>
             <?php echo $row['avai_seat']?>
           </td>
           <td onclick="document.location = 'flightTripDelete.php?id=<?php echo urlencode($row['flight_id']);?>'" style="background-color: coral; color: white; font-size: 20px; cursor:hand;">Delete</td>
      </tr>                
<?php
   }
?>
    </table>
  </form>
  </div>

    <!-- Add trips -->

      <div>
        <h3 style="background-color: FF4500;
    color: white;"> Add Trips</h3><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    <table border="1" style="border-collapse: collapse; width:100%;">
      <tr style="color: 008000">
        <th>Date</th>
        <th>Airplane Name</th>
        <th>From</th> 
        <th>To</th>
        <th rowspan="4" style="background-color: FFE4E1;"><input type="submit" name="submit" value="Add Trips" style="background-color: purple; color: white; font-size: 20px;"/></th>
      </tr>
      <tr>
        <td><input type="text" name="datepicker" id="datepicker" required /></td>
        <td><input type="text" name="airName" required /></td>
        <td><input type="text" name="deptfrom" required /></td> 
        <td><input type="text" name="goingto" required /></td>
      </tr>
      <tr style="color: 008000">
        <th>Category</th> 
        <th>Take Off Time</th> 
        <th>Landing Time</th>
        <th>Fare/Seat</th>
      </tr>
      <tr>
        <td>
          <select name="seat_category" required>
            <option disabled="disabled" selected="selected">Select a Category</option>
            <option value="First Class">First Class</option>
            <option value="Business Class">Business Class</option>
            <option value="Economy Class">Economy Class</option>
        </select>
        </td>
        <td id="time" class="ui-widget-content"><input type="text" name="takeTime" id="takeTime" required /></td> 
        <td id="time" class="ui-widget-content"><input type="text" name="landTime" id="landTime" required /></td>
        <td><input type="text" name="fare" required /></td>
      </tr>
    </table>
    </form>
    <span> <?php echo $err; ?> </span>
  </div>

<!-- All Ticket Print -->
  <div>
    <h3 style="background-color: FF4500;color: white;"> Those People Bought Ticket</h3><br>
    <form action="printAllFlightTicket.php" method="POST">
           <?php        
              $sql = "SELECT user_name, jdate, vehicle_name, route, category, jtime, seats, amount, pay_method, phone, flight_id, ticket_id FROM ticket_invoice WHERE ticket_invoice.bus_id IS NULL AND ticket_invoice.train_id IS NULL UNION SELECT name, jdate, vehicle_name, route, category, jtime, seats, amount, pay_method, phone, flight_id, ticket_id FROM user_info, user_ticket_info WHERE user_info.user_id = user_ticket_info.user_id AND user_ticket_info.bus_id IS NULL AND user_ticket_info.train_id IS NULL";
              $result = mysql_query($sql);
              $i = 0;        
            ?>
    <table border="1" style="border-collapse: collapse; width:100%;">
      <tr style="color: 008000">
        <th>Name</th>
        <th>Date</th>
        <th>Plane Name</th>
        <th>Routes</th> 
        <th>Category</th>
        <th>Time</th>
        <th>Seat Number</th>
        <th>Fare</th>
        <th>PaymentBy</th>
        <th>Mobile#</th>
        <th>Ticket#</th>
        <th>Flight#</th>
      </tr>
      
       <?php
        while($row = mysql_fetch_array($result)) {
      ?>

      <tr> 
       <td>
        <?php echo $row['user_name']?>
       </td>
       <td>
        <?php echo $row['jdate']?>
       </td>
       <td>
        <?php echo $row['vehicle_name']?>
       </td>
       <td>
        <?php echo $row['route'] ?>
       </td>
       <td>
         <?php echo $row['category']?>
       </td>
       <td>
         <?php echo $row['jtime']?>
       </td>
       <td>
         <?php echo $row['seats']?>
       </td>
       <td>
         <?php echo $row['amount']?>
       </td>
       <td>
         <?php echo $row['pay_method']?>
       </td>
       <td>
         <?php echo $row['phone']?>
       </td>
       <td>
         <?php echo $row['ticket_id']?>
       </td>
       <td>
         <?php echo $row['flight_id']?>
       </td>
      </tr>                
          <?php
          }
        ?>
    </table>
    <br>
    <input type="submit" name="submit" value="Print All Ticket" style="background-color: purple; color: white; font-size: 20px;" />
    </form>
  </div>
  <!-- For Registered User Ticket -->
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
<link href="../date/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="../date/jquery.min.js"></script>
<script src="../date/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../time_JS/jquery.ptTimeSelect.css" />
<script src="../time_JS/jquery.ptTimeSelect.js"></script>
<script>
  $(document).ready(function() {
    $("#datepicker").datepicker({
          dateFormat: 'dd/mm/yy',
          minDate: 0
        });
    $(document).ready(function(){
            $('#time input').ptTimeSelect();
        });
  });
  </script>
</body>
</html>