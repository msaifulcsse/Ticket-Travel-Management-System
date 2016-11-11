<?php
session_start();
  if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
    exit;
  }
 
 require_once('../mysqldb.php');
  $sql1 = "SELECT * FROM user_info";
  $result1 = mysql_query($sql1);
  while($row = mysql_fetch_array($result1))
  {
    $u_id= $row['email'];
    if($_SESSION["user"] == $u_id)
    {
      $getUID = $row['user_id'];
      $getName = $row['name'];
      $getEmail = $row['email'];
      $getGen = $row['gender'];
      $getPhn = $row['phone'];
      $getAdrs = $row['address'];
    }   
  }
  $_SESSION["UserID"] =  $getUID;
  $sql = "SELECT * FROM login where acctype = 'User'";
  $result = mysql_query($sql);
  $nn = mysql_num_rows($result);
     if($nn != 0)
       {
         while($row1 = mysql_fetch_array($result))
          {
           $up_id= $row1['email'];
     if($_SESSION["user"] == $up_id)
       {
          $getPass= $row1['pass'];
        }
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
    tr{
      color: #008000;
      }
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
<center>
 <header>
      <a href="index.php" id="logo">
        <h1>Ticket & Travel Management</h1>
        <h2>Software Project One</h2>
      </a>
      <nav>
        <ul>
          <li><a href="index.php" id="link">Flights</a></li>
          <li><a href="userBus.php" id="link">Buses</a></li>
          <li><a href="userTrain.php" id="link">Trains</a></li>
          <li><a href="user.php" id="link"  class="selected">Your Profile</a></li>
          <li><a href="../logout.php" id="link">Logout</a></li>
        </ul>
      </nav>
    </header>
    <u><h3 style="color: coral;">Here,You Can Update Your Information!</h3></u>
  <div>
	  <form action="uinfo_update.php" method="POST">
	  	<table border="1" style="border-collapse: collapse;">
        <input type="hidden" name="uid" readonly value= "<?php echo $getUID; ?>"/>
	  		<tr>
	  			<th>Name</th>
          <td><input type="text" name="uname" value="<?php echo $getName; ?>" required /></td>
        </tr>
	  		<tr>
          <th>Gender</th>
          <td><input type="text" name="gender" disabled value= "<?php echo $getGen; ?>" required/></td>
	  		</tr>
        <tr>
        <th>Email</th>
        <td><input type="text" name="email" readonly value= "<?php echo $getEmail; ?>" required /></td>
        </tr>
        <tr>
          <th>Phone</th>
          <td><input type="text" name="phone" value= "<?php echo $getPhn; ?>" required /></td>
        </tr>
        <tr>
          <th>Address</th>
          <td><input type="text" name="address" value= "<?php echo $getAdrs; ?>" required /></td>
        </tr>
        <tr>
          <th>Password</th>
          <td><input type="text" name="password" value= "<?php echo $getPass; ?>" required /></td>
        </tr>
        <tr>
          <th></th>
          <td><input type="submit" name="submit" value="Update" style="background-color: 008080; color: white; font-size: 20px;"/></td>
        </tr>
	  	</table>
	  </form>
  </div>
  <div>
<?php
 $sql = "SELECT * FROM user_info, user_ticket_info where user_ticket_info.bus_id IS NULL AND user_ticket_info.train_id IS NULL AND user_info.user_id = '$getUID' and user_ticket_info.user_id = '$getUID'";
              $result = mysql_query($sql);
              $i = 0;        
?>
 <form method="POST">
   <u><h3 style="color: coral; text-align: left;">Ticket (Flight)</h3></u>
      <table border="1" style="border-collapse: collapse; width:100%;">
                 <tr style="color: 008000">
                    <th>Date</th>
                    <th>Plane Name</th>
                    <th>Routes</th> 
                    <th>Category</th>
                    <th>Time</th>
                    <th>Seat Number</th>
                    <th>Fare</th>
                    <th>PaymentBy</th>
                    <th>Ticket#</th>
                    <th>Flight#</th>
                    <th>Print</th>
                 </tr> 
            <?php
              while($row = mysql_fetch_array($result)) {
               $ticketid = $row['ticket_id'];
               ?>             
               
                 <tr>
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
                     <?php echo $row['ticket_id']?>
                   </td>
                   <td>
                     <?php echo $row['flight_id']?>
                   </td>
                   <td onclick="document.location = 'userFlightPersonalTicket.php?id=<?php echo urlencode($ticketid);?>'" style="background-color: coral; color: white; font-size: 20px; cursor:hand;">Print</td>
                </tr>                
          <?php
          }
        ?>
          </table>
   </form>
  </div>
<div>
<?php
 $sql = "SELECT * FROM user_info, user_ticket_info where user_ticket_info.flight_id IS NULL AND user_ticket_info.train_id IS NULL AND user_info.user_id = '$getUID' and user_ticket_info.user_id = '$getUID'";
              $result = mysql_query($sql);
              $i = 0;        
?>
 <form method="POST">
   <u><h3 style="color: coral; text-align: left;">Ticket (Bus)</h3></u>
      <table border="1" style="border-collapse: collapse; width:100%;">
                 <tr style="color: 008000">
                    <th>Date</th>
                    <th>Bus Name</th>
                    <th>Routes</th> 
                    <th>Category</th>
                    <th>Time</th>
                    <th>Seat Number</th>
                    <th>Fare</th>
                    <th>PaymentBy</th>
                    <th>Ticket#</th>
                    <th>Bus#</th>
                    <th>Print</th>
                 </tr> 
            <?php
              while($row = mysql_fetch_array($result)) {
               $ticketid = $row['ticket_id'];
               ?>             
               
                 <tr>
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
                     <?php echo $row['ticket_id']?>
                   </td>
                   <td>
                     <?php echo $row['bus_id']?>
                   </td>
                   <td onclick="document.location = 'userBusPersonalTicket.php?id=<?php echo urlencode($ticketid);?>'" style="background-color: coral; color: white; font-size: 20px; cursor:hand;">Print</td>
                </tr>                
          <?php
          }
        ?>
        </table>
   </form>
</div>
<div>
<?php
 $sql = "SELECT * FROM user_info, user_ticket_info where user_ticket_info.flight_id IS NULL AND user_ticket_info.bus_id IS NULL AND user_info.user_id = '$getUID' and user_ticket_info.user_id = '$getUID'";
              $result = mysql_query($sql);
              $i = 0;        
?>
 <form method="POST">
   <u><h3 style="color: coral; text-align: left;">Ticket (Train)</h3></u>
      <table border="1" style="border-collapse: collapse; width:100%;">
                 <tr style="color: 008000">
                    <th>Date</th>
                    <th>Train Name</th>
                    <th>Routes</th> 
                    <th>Category</th>
                    <th>Time</th>
                    <th>Seat Number</th>
                    <th>Fare</th>
                    <th>PaymentBy</th>
                    <th>Ticket#</th>
                    <th>Train#</th>
                    <th>Print</th>
                 </tr> 
            <?php
              while($row = mysql_fetch_array($result)) {
               $ticketid = $row['ticket_id'];
               ?>             
               
                 <tr>
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
                     <?php echo $row['ticket_id']?>
                   </td>
                   <td>
                     <?php echo $row['train_id']?>
                   </td>
                   <td onclick="document.location = 'userTrainPersonalTicket.php?id=<?php echo urlencode($ticketid);?>'" style="background-color: coral; color: white; font-size: 20px; cursor:hand;">Print</td>
                </tr>                
          <?php
          }
        ?>
          </table>
   </form>
   </div>
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
</center>
</body>
</html>