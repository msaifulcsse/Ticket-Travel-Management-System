<?php
  session_start();
  if (!isset($_SESSION["admin"])) {
    header('Location: ../index.php');
    exit;
  }
 require_once('../mysqldb.php');
 if(isset($_POST["submit"]))
  {
    if(getimagesize($_FILES['image']['tmp_name']) == false)
    {
      echo "Please select an image";
    }
    else
    {
      $image = addslashes($_FILES['image']['tmp_name']);
      $name = addslashes($_FILES['image']['name']);
      $image = file_get_contents($image);
      $image = base64_encode($image);
      $couponNum = $_REQUEST['cnumber'];
      $discount = $_REQUEST['discount'];
      saveimage($name,$image,$couponNum,$discount);
    }
  }
  function saveimage($name,$image,$couponNum,$discount)
  {
    $sql = "update coupon_info set coupon_num = '$couponNum', coupon_image = '$image', coupon_name = '$name', discount = '$discount'";
       if(!mysql_query($sql))
       {
         echo mysql_error("Not Updated"); 
       }     
  }

  function displayimage()
  {
    $sql = "select * from coupon_info";
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result)){
      echo '<img alt="DiscountCoupon" id="coupon" width="350px" height="260px" src="data:image;base64,'.$row[3].'"/>';
      echo '<br/><h3 style="color: blue"><u>Details</u></h3>';
      echo '<h3 style="color: red; font-style: italic;">Coupon Number: '.$row[2].' </h3>';
      echo '<h3 style="color: red; font-style: italic;">It gives '.$row[4].' % discount on all tickets</h3> ';
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
          <li><a href="addCoupon.php" id="link" class="selected">Coupon Info</a></li>
          <li><a href="userMessage.php" id="link">Messages</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>
<center>
<h3 style="color: #2F4F4F;"> Admin Panel || Coupons</h3>
    <div>
	  <h3 style="background-color: FF4500;
	  color: white;"> Coupon That's Live</h3><br>
     <?php
        displayimage();
     ?>  
	</div>
    
    <div>
	  <h3 style="background-color: FF4500;
	  color: white;"> Add New Coupon(Coupon will be Updated!)</h3><br>
	  <form  method="POST" enctype="multipart/form-data">
	  	<table border="1" style="border-collapse: collapse; width:100%;">
	  		<tr style="color: 008000">
	  			<th>Coupon Image</th>
          <th>Coupon Number</th>
	  			<th>Discount Rate(%)</th>
          <th rowspan="2"><input type="submit" name="submit" value="Add Coupon" style="background-color: purple; color: white; font-size: 20px;"/></th>
	  		</tr>
	  		<tr>
	  			<td><input type="file" name="image" id="image" required /></td>
          <td><input type="text" name="cnumber" id="cnumber" required /></td>
	  			<td><input type="text" name="discount" id="discount" required/></td>
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
</body>
</html>