<?php
	session_start();
    if (!isset($_SESSION["user"])) {
	    header('Location: ../index.php');
	    exit;
    }
	if($_SESSION["flight1"] == "")
	{
		header("Location: index.php");
		exit();
	}

	require_once('../mysqldb.php');
	$flightId = $_REQUEST['id'];
	$_SESSION["flight_id"] = $flightId;
	$a1 = $a2 = $a3 = $a4 = $a5 = $a6 = $a7 = "";
	$b1 = $b2 = $b3 = $b4 = $b5 = $b6 = $b7= "";
	$c1 = $c2 = $c3 = $c4 = $c5 = $c6 = $c7= "";
	$d1 = $d2 = $d3 = $d4 = $d5 = $d6 = $d7= "";
	$e1 = $e2 = $e3 = $e4 = $e5 = $e6 = $e7= "";

	$sql = "select * from seat_info where flight_id = '$flightId';";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		switch($row["seat_num"])
		{
			case 'A1' : $a1 = "disabled";
						break;
			case 'A2' : $a2 = "disabled";
						break;
			case 'A3' : $a3 = "disabled";
						break;
			case 'A4' : $a4 = "disabled";
						break;
			case 'A5' : $a5 = "disabled";
						break;
			case 'A6' : $a6 = "disabled";
						break;
			case 'A7' : $a7 = "disabled";
						break;
			case 'B1' : $b1 = "disabled";
						break;
			case 'B2' : $b2 = "disabled";
						break;
			case 'B3' : $b3 = "disabled";
						break;
			case 'B4' : $b4 = "disabled";
						break;
			case 'B5' : $b5 = "disabled";
						break;
			case 'B6' : $b6 = "disabled";
						break;
			case 'B7' : $b7 = "disabled";
						break;
			case 'C1' : $c1 = "disabled";
						break;
			case 'C2' : $c2 = "disabled";
						break;
			case 'C3' : $c3 = "disabled";
						break;
			case 'C4' : $c4 = "disabled";
						break;
			case 'C5' : $c5 = "disabled";
						break;
			case 'C6' : $c6 = "disabled";
						break;
			case 'C7' : $c7 = "disabled";
						break;
			case 'D1' : $d1 = "disabled";
						break;
			case 'D2' : $d2 = "disabled";
						break;
			case 'D3' : $d3 = "disabled";
						break;
			case 'D4' : $d4 = "disabled";
						break;
			case 'D5' : $d5 = "disabled";
						break;
			case 'D6' : $d6 = "disabled";
						break;
			case 'D7' : $d7 = "disabled";
						break;
			case 'E1' : $e1 = "disabled";
						break;
			case 'E2' : $e2 = "disabled";
						break;
			case 'E3' : $e3 = "disabled";
						break;
			case 'E4' : $e4 = "disabled";
						break;
			case 'E5' : $e5 = "disabled";
						break;
			case 'E6' : $e6 = "disabled";
						break;
			case 'E7' : $e7 = "disabled";
						break;			
			default : 	break;

		}
	}
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	$_SESSION["seats"] = $_POST["seats"];
	 	$_SESSION["ff"] = "on";
		header('Location: userFlightFare.php'); //.urlencode(serialize($_POST["seats"])));
		exit();
	}



?>

</html>
<head>
    <meta charset="utf-8">
    <title>Software Project One</title>
	<link rel="stylesheet" href="../css/mainCSS.css">
	<link rel="stylesheet" href="../css/responsive.css">
<style type="text/css">
    label.seat{
    	color: #FF8000;
    }
	div.vertical-line{
	  width: 1px;
	  background-color: black;
	  height: 100%;
	  float: left;
	  border: 2px ridge black ;
	  border-radius: 2px;
	}
	    
	input[type="checkbox"]{
	    display: none;
	    border: none !important;
	    box-shadow: none !important;
	}

	input[type="checkbox"] + label span {   
	    background: url("../images/uncheck.png");
	    width: 49px;
	    height: 49px;
	    display: inline-block;
	    vertical-align: middle;
	}

	input[type="checkbox"]:disabled + label span {
	    background: url("../images/booked.png");
	    width: 49px;
	    height: 49px;
		display: inline-block;
	    vertical-align: middle;
	}

	input[type="checkbox"]:checked + label span {
	    background: url("../images/check.png");
	    width: 49px;
	    height: 49px;
		display: inline-block;
	    vertical-align: middle;
	}
</style>
</head>
<body>
    <header>
      <a href="userFlight.php" id="logo">
        <h1>Ticket & Travel Management</h1>
        <h2>Software Project One</h2>
      </a>
      <nav>
        <ul>
          <li><a href="index.php" class="selected">Flights</a></li>
          <li><a href="userBus.php">Buses</a></li>
          <li><a href="userTrain.php">Trains</a></li>
          <li><a href="user.php">Your Profile</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>
 <center>
      <table>
      	<tr>
      		<th><img src="../images/uncheck.png" width="49px" height="49px" /></th>
      		<th><img src="../images/check.png" width="49px" height="49px" /></th>
      		<th><img src="../images/booked.png" width="49px" height="49px" /></th>
      	</tr>
      	<tr>
      		<td style="color: black">Available &nbsp;</td>
      		<td style="color: black">Selected &nbsp;</td>
      		<td style="color: black">Booked &nbsp;</td>
      	</tr>
      </table>

<form method="POST" "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
<hr style="background-color: black;border: 2px ridge black; width: 576px;"/>
  <table>
       <tr>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="A1" name="seats[]" value="A1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a1; ?> /><label for="A1" class="seat"><span></span>A1</label></td>
        <td><input type="checkbox" id="A2" name="seats[]" value="A2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a2; ?> /><label for="A2" class="seat"><span></span>A2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="A3" name="seats[]" value="A3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a3; ?> /><label for="A3" class="seat"><span></span>A3</label></td>
        <td><input type="checkbox" id="A4" name="seats[]" value="A4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a4; ?> /><label for="A4" class="seat"><span></span>A4</label></td>
        <td><input type="checkbox" id="A5" name="seats[]" value="A5" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a5; ?> /><label for="A5" class="seat"><span></span>A5</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="A6" name="seats[]" value="A6" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a6; ?> /><label for="A6" class="seat"><span></span>A6</label></td>
        <td><input type="checkbox" id="A7" name="seats[]" value="A7" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a7; ?> /><label for="A7" class="seat"><span></span>A7</label></td>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       </tr>
 </table>
   <hr style="background-color: black;border: 2px ridge black; width: 576px;"/>
 <table>
       <tr>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="B1" name="seats[]" value="B1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b1; ?> /><label for="B1" class="seat"><span></span>B1</label></td>
        <td><input type="checkbox" id="B2" name="seats[]" value="B2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b2; ?> /><label for="B2" class="seat"><span></span>B2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="B3" name="seats[]" value="B3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b3; ?> /><label for="B3" class="seat"><span></span>B3</label></td>
        <td><input type="checkbox" id="B4" name="seats[]" value="B4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b4; ?> /><label for="B4" class="seat"><span></span>B4</label></td>
        <td><input type="checkbox" id="B5" name="seats[]" value="B5" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b5; ?> /><label for="B5" class="seat"><span></span>B5</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="B6" name="seats[]" value="B6" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b6; ?> /><label for="B6" class="seat"><span></span>B6</label></td>
        <td><input type="checkbox" id="B7" name="seats[]" value="B7" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b7; ?> /><label for="B7" class="seat"><span></span>B7</label></td>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       </tr>
  </table>
   <hr style="background-color: black;border: 2px ridge black; width: 576px;"/>
   <table>
       <tr>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="C1" name="seats[]" value="C1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c1; ?> /><label for="C1" class="seat"><span></span>C1</label></td>
        <td><input type="checkbox" id="C2" name="seats[]" value="C2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c2; ?> /><label for="C2" class="seat"><span></span>C2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="C3" name="seats[]" value="C3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c3; ?> /><label for="C3" class="seat"><span></span>C3</label></td>
        <td><input type="checkbox" id="C4" name="seats[]" value="C4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c4; ?> /><label for="C4" class="seat"><span></span>C4</label></td>
        <td><input type="checkbox" id="C5" name="seats[]" value="C5" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c5; ?> /><label for="C5" class="seat"><span></span>C5</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="C6" name="seats[]" value="C6" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c6; ?> /><label for="C6" class="seat"><span></span>C6</label></td>
        <td><input type="checkbox" id="C7" name="seats[]" value="C7" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c7; ?> /><label for="C7" class="seat"><span></span>C7</label></td>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       </tr>
  </table>
   <hr style="background-color: black;border: 2px ridge black; width: 576px;"/>
  <table>
       <tr>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="D1" name="seats[]" value="D1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d1; ?> /><label for="D1" class="seat"><span></span>D1</label></td>
        <td><input type="checkbox" id="D2" name="seats[]" value="D2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d2; ?> /><label for="D2" class="seat"><span></span>D2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="D3" name="seats[]" value="D3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d3; ?> /><label for="D3" class="seat"><span></span>D3</label></td>
        <td><input type="checkbox" id="D4" name="seats[]" value="D4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d4; ?> /><label for="D4" class="seat"><span></span>D4</label></td>
        <td><input type="checkbox" id="D5" name="seats[]" value="D5" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d5; ?> /><label for="D5" class="seat"><span></span>D5</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="D6" name="seats[]" value="D6" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d6; ?> /><label for="D6" class="seat"><span></span>D6</label></td>
        <td><input type="checkbox" id="D7" name="seats[]" value="D7" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d7; ?> /><label for="D7" class="seat"><span></span>D7</label></td>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       </tr>
  </table>
   <hr style="background-color: black;border: 2px ridge black; width: 576px;"/>
   <table>
       <tr>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="E1" name="seats[]" value="E1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e1; ?> /><label for="E1" class="seat"><span></span>E1</label></td>
        <td><input type="checkbox" id="E2" name="seats[]" value="E2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e2; ?> /><label for="E2" class="seat"><span></span>E2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="E3" name="seats[]" value="E3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e3; ?> /><label for="E3" class="seat"><span></span>E3</label></td>
        <td><input type="checkbox" id="E4" name="seats[]" value="E4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e4; ?> /><label for="E4" class="seat"><span></span>E4</label></td>
        <td><input type="checkbox" id="E5" name="seats[]" value="E5" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e5; ?> /><label for="E5" class="seat"><span></span>E5</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="E6" name="seats[]" value="E6" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e6; ?> /><label for="E6" class="seat"><span></span>E6</label></td>
        <td><input type="checkbox" id="E7" name="seats[]" value="E7" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e7; ?> /><label for="E7" class="seat"><span></span>E7</label></td>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       </tr>
  </table>
   <hr style="background-color: black;border: 2px ridge black; width: 576px;"/>
   <br>
<input type="submit" id="checkBtn" value="Continue" style="background-color: coral; color: white; font-size: 20px;"/>
</form>
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