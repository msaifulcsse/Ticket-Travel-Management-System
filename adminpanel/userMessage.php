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
        $sql = "DELETE FROM contact_info;";
        $result = mysql_query($sql);
        //$row = mysql_fetch_array($result);
        if(!mysql_query($sql))
          {
            $err = '<h3 style="color:red">contact Info Not Deleted</h3>';
          }
        else 
          $err = '<h3 style="color:green">contact Info Deleted Successfully</h3>';
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
          <li><a href="adminFlight.php">Flight Info</a></li>
          <li><a href="forBarGraph/flightReport.php" >Flight Report</a></li>
          <li><a href="adminBus.php">Bus Info</a></li>
          <li><a href="forBarGraph/busReport.php">Bus Report</a></li>
          <li><a href="adminTrain.php">Train Info</a></li>
          <li><a href="forBarGraph/trainReport.php">Train Report</a></li>
          <li><a href="addCoupon.php" id="link">Coupon Info</a></li>
          <li><a href="userMessage.php" id="link" class="selected">Messages</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>
 <center>
 <h3 style="color: #2F4F4F;"><u> Admin Panel || User Message</u></h3>
<div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
 <h3 style="background-color: FF4500;color: white;"> All Message From User's</h3><br>
          <?php
              $name = $subject = $email = $message = "";         
              $sql = "select * from contact_info";
              $result = mysql_query($sql);
              $i = 0;        
            ?>
    <table border="1" style="border-collapse: collapse; width:100%;">
      <tr style="color: 008000">
        <th>Name </th>
        <th>Subject</th>
        <th>Email</th> 
        <th>Message</th>
      </tr>

      <?php
        while($row = mysql_fetch_array($result)) {
      ?>              
               
       <tr> 
       <td>
        <?php echo $row['name']?>
       </td>
       <td>
        <?php echo $row['subject'] ?>
       </td>
       <td>
         <?php echo $row['email']?>
       </td>
       <td>
         <?php echo $row['message']?>
       </td>
      </tr>                
          <?php
          }
        ?>
    </table>
		<br>
		<input type="submit" name="submit" value="Clear All" style="background-color: purple; color: white; font-size: 20px;"/>
  </form>
  <span> <?php echo $err; ?> </span>
  </div>
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