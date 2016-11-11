<?php
  session_start();
  if($_SESSION["flight_id"] == "")
  {
    //echo $_SESSION["flight_id"];
    header("Location: index.php");
    exit();
  }
  $route = $_SESSION["route"];
  $flightId =  $_SESSION["flight_id"];
  $seats = $_SESSION["seats"]; 
  $disabled = $err = $seatNum = "";
  $fare = 0;
  $count = 0;
  require_once('mysqldb.php');
  if($_SERVER['REQUEST_METHOD'] != "POST")
  {
    $sql = "select fare_per_seat,tourdate, p_name, dept_time, category, arri_time from flight_trips where flight_id = '$flightId';";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $fare = $row["fare_per_seat"];
    $_SESSION["perfare"] = $fare;
    $_SESSION["jdate"] = $row["tourdate"];
    $_SESSION["jtime"] = $row["dept_time"]." - ".$row["arri_time"];
    $_SESSION["v_name"] = $v_name = $row["p_name"];
    $_SESSION["category"] = $category = $row["category"];
    $seatNum = "";
    $first = true;
    foreach($seats as $seat) 
    {
      if($first)
      {
        $seatNum = $seat;
        $first = false;
      }
      else
        $seatNum .= ", ".$seat;
      $count++;
      $_SESSION["seatNum"] = $seatNum;
    } $_SESSION["fare"] = $count*$_SESSION["perfare"];
  } 
 else{ 
    $first = true;
    foreach($seats as $seat)
    {
      if($first)
      {
        $seatNum = $seat;
        $first = false;
      }
      else
        $seatNum .= ", ".$seat;
      $_SESSION["seatNum"] = $seatNum;
      $count++;
    }
  }
  if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['submit']))
  { 
    if($_POST["amount"] == $_SESSION["fare"])
    {
      foreach ($seats as $seat) {
      $sql = "insert into seat_info (seat_num, flight_id, status) values ('$seat', '$flightId', 'checked')";
      if(!mysql_query($sql))
      {
        echo mysql_error($conn);
      }
    }
    $sql = "update flight_trips set avai_seat = avai_seat-$count where flight_id=$flightId;"; // 0 is allowed but not (-) value
     if(!mysql_query($sql))
        $err = mysql_error();
     
     //*****************//
      $_SESSION["fname"] = $fname = $_REQUEST['fname'];
      $_SESSION["gender"] = $gender = $_REQUEST['gender'];
      $_SESSION["email"] = $email = $_REQUEST['email'];
      $_SESSION["phone"] = $phone = $_REQUEST['phone'];
      $_SESSION["payment"] = $payment = $_REQUEST['payMethod'];
      $_SESSION["amount"] = $amount = $_REQUEST['amount'];
      $_SESSION["jdate"] = $jdate = $_SESSION["jdate"];
      $_SESSION["jtime"] = $jtime = $_SESSION["jtime"];
      $v_name = $_SESSION["v_name"];
      $category = $_SESSION["category"];
      $flightId =  $_SESSION["flight_id"];
      $sql1 = "insert into ticket_invoice (user_name, email, phone, gender,flight_id,vehicle_name, pay_method, amount, seats, category, route, jdate, jtime) values ('$fname', '$email','$phone','$gender','$flightId','$v_name','$payment','$amount','$seatNum','$category','$route','$jdate','$jtime');";
      if(!mysql_query($sql1))
        echo mysql_error();
      else
        {
          $sql = "SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'ticketmanagement' AND TABLE_NAME = 'ticket_invoice';";
          $result = mysql_query($sql);
          $row = mysql_fetch_array($result);
          $_SESSION["ticket_id"] = $row[0]-1;        
        
          //****************//
         header('Location: flightTicket.php');
         exit(); 
       }
    }
    else
    {
      $err = "Give Equal Amount of Money, Please!";
    }
    
  }
  
  if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["checkcoupon"]))
  {
    $coupon = $_POST["coupon"];
    $sql = "select * from coupon_info where coupon_num = '$coupon'";
    $result = mysql_query($sql);
    $isvalid = false;
    while($row = mysql_fetch_array($result)){
      $discount = $row["discount"];
      $f = $count * $_SESSION["perfare"];
      $_SESSION["fare"] = $f-($f * ($discount/100));    
      $disabled = "disabled";
      $isvalid = true;
      $err = "";
    }
    if(!$isvalid)
      $err = "Invalid coupon";
  }

?>

</html>
<head>
    <meta charset="utf-8">
    <title>Software Project One</title>
	<link rel="stylesheet" href="css/mainCSS.css">
	<link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <header>
      <a href="index.php" id="logo">
        <h1>Ticket & Travel Management</h1>
        <h2>Software Project One</h2>
      </a>
      <nav>
        <ul>
          <li><a href="index.php" class="selected">Flights</a></li>
          <li><a href="bus.php">Buses</a></li>
          <li><a href="train.php">Train</a></li>
          <li><a href="login.php">Login/Signup</a></li>
        </ul>
      </nav>
    </header>
     <center>
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
     <table>
       <tr>
         <th>Your Seat#: </th>
         <td><?php echo $seatNum; ?></td>
       </tr>
       <tr>
         <th>Total Fare: </th>
         <td> <?php echo $_SESSION["fare"]; ?></td>
       </tr>
       <tr>
         <th>Do You Have Any Coupon? </th>
         <td><input type="text" id="coupon" name="coupon" size="35" placeholder="Enter Your Valid Coupon" required></td>
         <td><input type="submit" name="checkcoupon" value="Check" style="background-color: 008080; color: white; font-size: 20px;" <?php echo $disabled; ?>/></td>
       </tr>
     </table>
     </form>
     <span style="color:red"> <?php echo $err; ?> </span>
<h3 style="color: coral;"><u>Please Provide Your Informations</u></h3>
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
           <table>
              <tr>
                <th>Full Name: </th>
                <td><input type="text" id="fname" name="fname" pattern=".{3,15}" title="3-15 characters" size="35" placeholder="write full name, Maximum(15 Char)" required></td>
              </tr>
              <tr>
                <th>Gender: </th>
                <td><input type="radio" id="gender" name="gender" value="Male" checked="checked"> Male<input type="radio" id="gender" name="gender" value="Female"> Female<input type="radio" id="gender" name="gender" value="Other"> Other
                </td>
              </tr>
              <tr>
               <th>Email: </th>
               <td><input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required placeholder="Enter a valid email" title="Input valid email,please!" size="35" /></td>
             </tr>
              <tr>
                <th>Phone: </th> 
                <td><input type="text" id="phone" name="phone" size="35" pattern=".{11,16}" title="valid phone number" placeholder="01XXXXXXXXX" required></td>
            </tr>
            <tr>
                <th>Payment By: </th> 
                <td>
                  <select name="payMethod" required>
                      <option value="" disabled="disabled" selected="selected">Select PaymentGetway</option>
                      <option value="Bkash">Bkash</option>
                      <option value="DBBL">DBBL</option>
                      <option value="M-Cash">M-Cash</option>
                  </select>
                </td>
            </tr>
            <tr>
                <th>Enter Amount: </th> 
                <td><input type="text" id="amount" name="amount" size="35" required></td>
            </tr>
            <tr>
              <th></th>
              <td><input type="submit" name="submit" value="Continue" style="background-color: 008080; color: white; font-size: 20px;" /></td>
              </tr>
        </table>
        </form>
     </center>
    <header>
    <nav>
        <ul>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li class="phone"><a href="tel:+880-16-7509-4640">+8801675094640</a></li>
        </ul>
      </nav>
      <div align="center" style="padding-top: 10px">
          <h2>Copyright&copy; 2013-2016 by <b><i>Team 3'S</i></b></h2>
          <a href="http://www.facebook.com/msaifulbdjoy"><img src="images/facebook-wrap.png" alt="Facebook Logo" width="35" height="30"></a>
          <a href="http://twitter.com/msaifulbdjoy"><img src="images/twitter-wrap.png" alt="Twitter Logo" width="35" height="30"></a>
          <a href="http://plus.google.com/+MDSAIFULISLAMBD"><img src="images/google-wrap.png" alt="GooglePlus Logo" width="35" height="30"></a>
      </div>
    </header>
</body>
</html>