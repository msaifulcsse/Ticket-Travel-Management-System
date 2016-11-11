<?php
session_start();
  
require_once('mysqldb.php');
$err = "";
  if($_SERVER["REQUEST_METHOD"] == "POST")
    {
   $email = $_POST['email'];
   $password = $_POST['pass'];

  $sql = "SELECT * FROM login";
  $result = mysql_query($sql);
     
    while($row = mysql_fetch_array($result))
    {
       $un= $row['email'];
       $up= $row['pass'];
       $acctype = $row['acctype'];
       
       if($un == $email && $up == $password && $acctype=="Admin")
      {
        $_SESSION["admin"] = $email;
        header('Location: adminpanel/index.php');
        exit;
      }
      else if($un == $email && $up == $password && $acctype=="User")
      {
        $_SESSION["user"] = $email;
        header('Location: userpanel/user.php');
        exit;      
      }
       else
      {
        $err = 'Invalid Email or Pass';
      }
    }
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
          <li><a href="login.php" class="selected">Login/Signup</a></li>
        </ul>
      </nav>
    </header>
<center>
      <div>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
           <table>
              <tr>
               <th>Email: </th>
               <td><input type="text" name="email" id="email" required /></td>
             </tr>
             <tr>
               <th>Password: </th>
               <td><input type="password" name="pass" id="pass" required /></td>
             </tr>
              <tr>
              <th></th>
              <td>
              <input type="submit" name="submit" value="Login" style="background-color: 008080; color: white; font-size: 20px;" />
              </td>
              </tr>   
            </table>
            <p style="color:red"><?php echo $err; ?></p>
         </form>
      </div>
      <div>
        <h2 style="color: coral;"><u>Not Registered Yet?</u></h2> &nbsp <a href="signup.php" style="color: black; font-size:20px; background-color: coral">SignUp Here.</a>
      </div>
</center>
<br/><br/><br/><br/>
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