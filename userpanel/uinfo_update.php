<?php
session_start();
  if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
    exit;
  }
 
 require_once('../mysqldb.php');
  if($_REQUEST['submit'] == "Update")
    {
      $getUserID = $_REQUEST['uid'];
      $getName = $_REQUEST['uname'];
      $getEmail = $_REQUEST['email'];
      $getPhn = $_REQUEST['phone'];
      $getAdrs = $_REQUEST['address'];    
      $getPass = mysql_escape_string($_REQUEST['password']);


      $query = mysql_query("SELECT * FROM `login` WHERE user_id='$getUserID'");
      $nn = mysql_num_rows($query);
      if($nn != 0)
      {
        $sql = "UPDATE `login` SET `email`='$getEmail',`pass`='$getPass',`acctype`='User' WHERE user_id='$getUserID'";
        if(!mysql_query($sql))
          {
            echo "Error in login: " . $sql. "<br>" . mysql_error($conn);
          }


        $sql1 = "UPDATE `user_info` SET `name`='$getName',`email`='$getEmail',`phone`='$getPhn',`address`='$getAdrs' WHERE user_id='$getUserID'";
        if(!mysql_query($sql1))
          {
            echo "Error in user_info: " . $sql1 . "<br>" . mysql_error($conn);
          }
        else
        {
          header('Location: user.php');
          exit();
        }
     }
  } 
?>