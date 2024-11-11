<?php
@$userid=$_POST['userid'];
include("include/connection.php");
 echo number_format(wallet($con_evolive,'balance',$userid), 2); 
 ?>
