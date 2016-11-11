<?php
  session_start();;
  if(!$_SESSION["train"])
  {
    header("Location: index.php");
    exit();
  }
  $_SESSION['train1'] = "on";
  require_once('mysqldb.php');
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Software Project One</title>
  <link rel="stylesheet" href="css/mainCSS.css">
  <link rel="stylesheet" href="css/responsive.css">
  <style type="text/css">
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
        <h2>Software Project One</h2>
      </a>
      <nav>
        <ul>
          <li><a href="index.php">Flights</a></li>
          <li><a href="bus.php">Buses</a></li>
          <li><a href="train.php" class="selected">Train</a></li>
          <li><a href="login.php">Login/Signup</a></li>
        </ul>
      </nav>
    </header>
    <center>
          <?php
              $dfrom = $gto = $ddate = $rdate = "";
              if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $dfrom = $_POST['dfrom'];
                    $gto = $_POST['gto'];
                    $ddate = $_POST['ddate'];
                    $rdate = $_POST['rdate'];
                
              $sql = "select * from train_trips";
              if(!empty($_POST['rdate']))
                $sql = "select * from train_trips where (deptfrom like '$dfrom%' and goingto like '$gto%' and tourdate = '$ddate') or    (deptfrom like '$gto%' and goingto like '$dfrom%' and tourdate = '$rdate') order by train_id desc";

              else
               $sql = "select * from train_trips where deptfrom like '$dfrom%' and goingto like '$gto%' and tourdate = '$ddate' order by train_id desc";          
              
              
              $result = mysql_query($sql);
              $i = 0;        
            ?>
 <form method="POST">
      <table border="1" style="border-collapse: collapse; width:100%;">
              <tr style="color: 008000">
                <td>Route</td>
                <td>Date</td>
                <td>Time</td>
                <td>Train Name</td>
                <td>Seat Category</td>
                <td>Available Seat</td>
                <td>Fare</td>
                <td>Show Seat</td>
              </tr>

            <?php
              while($row = mysql_fetch_array($result)) {
               $tid = $row['train_id'];
               $_SESSION["route"] =  $row['deptfrom'] ." - ". $row['goingto']?>              
               
                 <tr>
                 <td>
                  <?php echo $row['deptfrom'] ." - ". $row['goingto']?>
                 </td>
                 <td>
                  <?php echo $row['tourdate'] ?>
                 </td>
                 <td>
                   <?php echo $row['dept_time'] ." - ". $row['arri_time']?>
                 </td>
                 <td>
                   <?php echo $row['t_name']?>
                 </td>
                 <td>
                   <?php echo $row['category']?>
                 </td>
                 <td>
                   <?php echo $row['avai_seat']?>
                 </td>
                 <td>
                   <?php echo $row['fare_per_seat']?> 
                 </td>
                 <td onclick="document.location = 'trainSeat.php?id=<?php echo urlencode($tid);?>'" style="background-color: coral; color: white; font-size: 20px; cursor:hand;">Show Seat</td>
                </tr>                
          <?php
          }
        }
        else
             echo "Please Search Your Desire Info";
          ?>
          </table>
   </form>
   </center>
    <br/> <br/>
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