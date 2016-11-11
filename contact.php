<?php
  require_once('mysqldb.php');
  $err = "";
   if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['submit']))
      { 
        $name = $_REQUEST['name'];
        $subject = $_REQUEST['subject'];
        $email = mysql_escape_string($_REQUEST['email']);
        $message = $_REQUEST["message"];

        $sql ="INSERT INTO contact_info (name, subject, email, message) VALUES ('$name', '$subject', '$email', '$message')";
        if(!mysql_query($sql))
          {
            $err = '<h3 style="color:red">Error with Message Sending, please send again </h3>';
          }
        else 
          $err = '<h3 style="color:green">Send Successfully<br/>Thanks For Being With Us!!!</h3>';
      }
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Software Project One</title>
	<link rel="stylesheet" href="css/mainCSS.css">
  <link rel="stylesheet" href="css/responsive.css">
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
          <li><a href="index.php">Flights</a></li>
          <li><a href="bus.php">Buses</a></li>
          <li><a href="train.php">Train</a></li>
          <li><a href="login.php">Login/Signup</a></li>
        </ul>
      </nav>
    </header>
<h3 style="color: #599a68;"><u>Contact With Us, We Are Friendly.</u></h3>
   <div>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
           <table>
              <tr>
               <th>Your Name:</th>
               <td><input type="text" name="name" id="name" required size="29" /></td>
             </tr>
              <tr>
               <th>Subject: </th>
               <td><input type="text" name="subject" id="subject" required size="29" /></td>
             </tr>
             <tr>
               <th>Email: </th>
               <td><input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required placeholder="Enter a valid email" title="Input valid email,please!" size="29" /></td>
             </tr>
             <tr>
                <th>Your Message: </th> 
                <td><textarea id="message" name="message" cols=31 rows="8" required></textarea></td>
            </tr>
              <tr>
              <th></th>
              <td><input type="submit" name="submit" value="Send" style="background-color: 008080; color: white; font-size: 20px;" /></td>
              </tr>   
            </table>
            </form>
            <span> <?php echo $err; ?> </span>
      </div>
<br/> <br/>
    <header>
    <nav>
        <ul>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php" class="selected">Contact</a></li>
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
    </center>
</body>
</html>