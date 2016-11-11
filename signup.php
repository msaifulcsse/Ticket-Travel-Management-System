<html>
<head>
    <title>SignUp Page || Software Project One</title>
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
  <h3 style="color: coral;"><u>User Registration Form</u></h3>
      <div>
         <form action="adduser.php" method="post">
           <table>
              <tr>
                <th>Full Name: </th>
                <td><input type="text" id="fname" name="fname" pattern=".{3,15}" title="3-15 characters" size="29" placeholder="write full name, Maximum(15 Char)" required></td>
              </tr>
              <tr>
                <th>Gender: </th>
                <td><input type="radio" id="gender" name="gender" value="Male" checked="checked"> Male<input type="radio" id="gender" name="gender" value="Female"> Female<input type="radio" id="gender" name="gender" value="Other"> Other
                </td>
              </tr>
              <tr>
               <th>Email: </th>
               <td><input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required placeholder="Enter a valid email" title="Input valid email,please!" size="29"/></td>
             </tr>
              <tr>
                <th>Phone: </th> 
                <td><input type="text" id="phone" name="phone" size="29" pattern=".{11,16}" placeholder="01XXXXXXXXX" required></td>
            </tr>
            <tr>
                <th>Address: </th> 
                <td><textarea id="address" name="address" cols=31 rows="8" required></textarea></td>
            </tr>
             <tr>
               <th>Password: </th>
               <td><input type="password" name="password" id="password" pattern=".{3,}" title="Three or more characters" size="29" required /></td>
             </tr>
              <tr>
              <th></th>
              <td><input type="submit" name="submit" value="SignUp" style="background-color: 008080; color: white; font-size: 20px;" /></td>
              </tr>   
            </table>
         </form>
      </div>
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