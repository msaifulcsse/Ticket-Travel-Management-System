<?php
session_start();
  if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
    exit;
  }
  $_SESSION["bus"] = "index";
  require_once('../mysqldb.php');
    $sql = "select * from coupon_info";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result)

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Software Project One</title>
  <link rel="stylesheet" href="../css/mainCSS.css">
  <link rel="stylesheet" href="../css/responsive.css">
</head>
<body background="../images/bus.jpg">
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
      <div id="iform">
         <form action="userBus1.php" method="post">
           <table>
             <tr>
               <th style="background-color: 008080; color: white; font-size: 20px;">Depart From</th>
               <td style="background-color: 008080; color: white; font-size: 20px;"><input type="text" name="dfrom" id="dfrom" required /></td>
               <td rowspan="5"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</td>
               <td rowspan="5">
                  <?php echo '<img alt="Discount Coupon" id="coupon" height="300px" width="400" src="data:image;base64,'.$row[3].'"/>'; ?>
               </td>
             </tr>
              <tr>
               <th style="background-color: 008080; color: white; font-size: 20px;">Going To</th>
               <td style="background-color: 008080; color: white; font-size: 20px;"><input type="text" name="gto" id="gto" required /></td>
             </tr>
              <tr>
               <th style="background-color: 008080; color: white; font-size: 20px;">Departure Date</th>
               <td style="background-color: 008080; color: white; font-size: 20px;"><input type="text" name="ddate" id="ddate" required /></td>
             </tr>
             <tr>
               <th style="background-color: 008080; color: white; font-size: 20px;">Return Date</th>
               <td style="background-color: 008080; color: white; font-size: 20px;"><input type="text" name="rdate" placeholder="optional" id="rdate" /></td>
             </tr>
              <tr>
              <th colspan="2"><input type="submit" name="submit" value="Search Desire Bus" style="background-color: coral; color: white; font-size: 20px;" /></th>
              </tr>   
            </table>
         </form>
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

<link href="../date_JS/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="../date_JS/jquery.js"></script>
<script src="../date_JS/jquery-ui.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){
        $( "#ddate" ).datepicker({
          dateFormat: 'dd/mm/yy',
          minDate: 0,
          maxDate: "+30D",
          changeMonth: true,
          onSelect: function() {
            var date = $(this).datepicker('getDate');
            if (date){
              date.setDate(date.getDate() + 0);
              $( "#rdate" ).datepicker( "option", "minDate", date );
            }
          }
        });
        $( "#rdate" ).datepicker({
          dateFormat: 'dd/mm/yy',
          maxDate: "+30D",
          changeMonth: true,
          onSelect: function() {
            var date = $(this).datepicker('getDate');
            if (date) {
              date.setDate(date.getDate() - 0);
              $( "#ddate" ).datepicker( "option", "maxDate", date );
            }
          }
        });
      });
      </script>
</body>
</html>