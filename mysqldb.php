<?php
 $conn = mysql_connect("localhost",'root','');
    if($conn == null)
    {
        die('error connecting database');
        return;
    }
    mysql_select_db('ticketmanagement', $conn);

?>
