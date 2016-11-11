<?php
	session_start();
    if (!isset($_SESSION["user"])) {
	    header('Location: ../index.php');
	    exit;
    }
	if($_SESSION["train1"] == "")
	{
		header("Location: index.php");
		exit();
	}

	require_once('../mysqldb.php');
	 $trainId = $_REQUEST['id'];
	$_SESSION["train_id"] = $trainId;
	$a1 = $a2 = $a3 = $a4 = "";
	$b1 = $b2 = $b3 = $b4 = "";
	$c1 = $c2 = $c3 = $c4 = "";
	$d1 = $d2 = $d3 = $d4 = "";
	$e1 = $e2 = $e3 = $e4 = "";
	$f1 = $f2 = $f3 = $f4 = "";
	$g1 = $g2 = $g3 = $g4 = "";
	$h1 = $h2 = $h3 = $h4 = "";
	$i1 = $i2 = $i3 = $i4 = "";
	$j1 = $j2 = $j3 = $j4 = "";

	$sql = "select * from seat_info where train_id = '$trainId';";
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
			case 'B1' : $b1 = "disabled";
						break;
			case 'B2' : $b2 = "disabled";
						break;
			case 'B3' : $b3 = "disabled";
						break;
			case 'B4' : $b4 = "disabled";;
						break;
			case 'C1' : $c1 = "disabled";
						break;
			case 'C2' : $c2 = "disabled";
						break;
			case 'C3' : $c3 = "disabled";
						break;
			case 'C4' : $c4 = "disabled";
			            break;
			case 'D1' : $d1 = "disabled";
						break;
			case 'D2' : $d2 = "disabled";
						break;
			case 'D3' : $d3 = "disabled";
						break;
			case 'D4' : $d4 = "disabled";
						break;
			case 'E1' : $e1 = "disabled";
						break;
			case 'E2' : $e2 = "disabled";
						break;
			case 'E3' : $e3 = "disabled";
						break;
			case 'E4' : $e4 = "disabled";
						break;
			case 'F1' : $f1 = "disabled";
						break;
			case 'F2' : $f2 = "disabled";
						break;
			case 'F3' : $f3 = "disabled";
						break;
			case 'F4' : $f4 = "disabled";
						break;
			case 'G1' : $g1 = "disabled";
						break;
			case 'A2' : $g2 = "disabled";
						break;
			case 'G3' : $g3 = "disabled";
						break;
			case 'G4' : $g4 = "disabled";
						break;
			case 'H1' : $h1 = "disabled";
						break;
			case 'H2' : $h2 = "disabled";
						break;
			case 'H3' : $h3 = "disabled";
						break;
			case 'H4' : $h4 = "disabled";
						break;
			case 'I1' : $i1 = "disabled";
						break;
			case 'I2' : $i2 = "disabled";
						break;
			case 'I3' : $i3 = "disabled";
						break;
			case 'I4' : $i4 = "disabled";
						break;
			case 'J1' : $j1 = "disabled";
						break;
			case 'J2' : $j2 = "disabled";
						break;
			case 'J3' : $j3 = "disabled";
						break;
			case 'J4' : $j4 = "disabled";
						break;			
			default : 	break;

		}
	}
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	$_SESSION["seats"] = $_POST["seats"];
        $_SESSION["tt"] = "on";
		header('Location: userTrainFare.php');
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
      <a href="index.php" id="logo">
        <h1>Ticket & Travel Management</h1>
        <h2>Software Project One</h2>
      </a>
      <nav>
        <ul>
          <li><a href="index.php">Flights</a></li>
          <li><a href="userBus.php">Buses</a></li>
          <li><a href="userTrain.php"  class="selected">Trains</a></li>
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
<hr style="background-color: black;border: 2px ridge black; width: 980px;"/>
<table>
       <tr>
        <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="A1" name="seats[]" value="A1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a1; ?> /><label for="A1" class="seat"><span></span>A1</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="B1" name="seats[]" value="B1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b1; ?> /><label for="B1" class="seat"><span></span>B1</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>   
        <td><input type="checkbox" id="C1" name="seats[]" value="C1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c1; ?> /><label for="C1" class="seat"><span></span>C1</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>   
        <td><input type="checkbox" id="D1" name="seats[]" value="D1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d1; ?> /><label for="D1" class="seat"><span></span>D1</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="E1" name="seats[]" value="E1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e1; ?> /><label for="E1" class="seat"><span></span>E1</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="F1" name="seats[]" value="F1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $f1; ?> /><label for="F1" class="seat"><span></span>F1</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="G1" name="seats[]" value="G1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $g1; ?> /><label for="G1" class="seat"><span></span>G1</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="H1" name="seats[]" value="H1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $h1; ?> /><label for="H1" class="seat"><span></span>H1</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="I1" name="seats[]" value="I1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $i1; ?> /><label for="I1" class="seat"><span></span>I1</label></td><td> &nbsp; </td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="J1" name="seats[]" value="J1" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $j1; ?> /><label for="J1" class="seat"><span></span>J1</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       </tr>
 </table>
 <hr style="background-color: black;border: 2px ridge black; width: 980px;"/>
 <table>
      <tr>
       <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="A2" name="seats[]" value="A2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a2; ?> /><label for="A2" class="seat"><span></span>A2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="B2" name="seats[]" value="B2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b2; ?> /><label for="B2" class="seat"><span></span>B2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="C2" name="seats[]" value="C2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c2; ?> /><label for="C2" class="seat"><span></span>C2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="D2" name="seats[]" value="D2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d2; ?> /><label for="D2" class="seat"><span></span>D2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="E2" name="seats[]" value="E2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e2; ?> /><label for="E2" class="seat"><span></span>E2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="F2" name="seats[]" value="F2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $f2; ?> /><label for="F2" class="seat"><span></span>F2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="G2" name="seats[]" value="G2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $g2; ?> /><label for="G2" class="seat"><span></span>G2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="H2" name="seats[]" value="H2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $h2; ?> /><label for="H2" class="seat"><span></span>H2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="I2" name="seats[]" value="I2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $i2; ?> /><label for="I2" class="seat"><span></span>I2</label></td><td> &nbsp; </td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="J2" name="seats[]" value="J2" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $j2; ?> /><label for="J2" class="seat"><span></span>J2</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
      </tr>
  </table>
  <hr style="background-color: black;border: 2px ridge black; width: 980px;"/>
  <br>
  <hr style="background-color: black;border: 2px ridge black; width: 980px;"/>
 <table>
       <tr>
       <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="A3" name="seats[]" value="A3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a3; ?> /><label for="A3" class="seat"><span></span>A3</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="B3" name="seats[]" value="B3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b3; ?> /><label for="B3" class="seat"><span></span>B3</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="C3" name="seats[]" value="C3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c3; ?> /><label for="C3" class="seat"><span></span>C3</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="D3" name="seats[]" value="D3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d3; ?> /><label for="D3" class="seat"><span></span>D3</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="E3" name="seats[]" value="E3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e3; ?> /><label for="E3" class="seat"><span></span>E3</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="F3" name="seats[]" value="F3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $f3; ?> /><label for="F3" class="seat"><span></span>F3</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="H3" name="seats[]" value="H3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $h3; ?> /><label for="H3" class="seat"><span></span>H3</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="G3" name="seats[]" value="G3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $g3; ?> /><label for="G3" class="seat"><span></span>G3</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="I3" name="seats[]" value="I3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $i3; ?> /><label for="I3" class="seat"><span></span>I3</label></td><td><td> &nbsp; </td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="J3" name="seats[]" value="J3" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $j3; ?> /><label for="J3" class="seat"><span></span>J3</label></td></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       </tr>
  </table>
 <hr style="background-color: black;border: 2px ridge black; width: 980px;"/>
  <table>
       <tr>
       <td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="A4" name="seats[]" value="A4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $a4; ?> /><label for="A4" class="seat"><span></span>A4</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="B4" name="seats[]" value="B4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $b4; ?> /><label for="B4" class="seat"><span></span>B4</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       <td><input type="checkbox" id="C4" name="seats[]" value="C4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $c4; ?> /><label for="C4" class="seat"><span></span>C4</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="D4" name="seats[]" value="D4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $d4; ?> /><label for="D4" class="seat"><span></span>D4</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="E4" name="seats[]" value="E4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $e4; ?> /><label for="E4" class="seat"><span></span>E4</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="F4" name="seats[]" value="F4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $f4; ?> /><label for="F4" class="seat"><span></span>F4</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="G4" name="seats[]" value="G4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $g4; ?> /><label for="G4" class="seat"><span></span>G4</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="H4" name="seats[]" value="H4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $h4; ?> /><label for="H4" class="seat"><span></span>H4</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="I4" name="seats[]" value="I4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $i4; ?> /><label for="I4" class="seat"><span></span>I4</label></td><td> &nbsp; </td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
        <td><input type="checkbox" id="J4" name="seats[]" value="J4" onchange="document.getElementById('checkBtn').disabled = !this.checked;" <?php echo $j4; ?> /><label for="J4" class="seat"><span></span>J4</label></td>
        <td> &nbsp; </td><td><div class="vertical-line" style="height: 70px;" /></td><td> &nbsp; </td>
       </tr>
  </table>
  <hr style="background-color: black;border: 2px ridge black; width: 980px;"/>
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