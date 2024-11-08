<?php $urlpage= basename($_SERVER['PHP_SELF']);
$active='';

?>
<div class="appBottomMenu">
 

    
   
  
   <?php 
   if(isset($_SESSION['AuthUser']['username'])){
   //if(isset($_SESSION['frontuserid'])){
   ?>
    <div class="item <?php if($urlpage=='earn-money.php'){echo'active';}?>"> 
	<!--
	<a href="earn-money.php">
	<p> <i class="icon"><i class="fa fa-user-plus"></i></i> <span>Reffer & Earn</span> </p>
	</a> 
	-->
	</div>
    <div class="item <?php if($urlpage=='gamedashboard.php'){echo'active';}?>"> <a href="gamedashboard.php">
    <p> <i class="icon ion-md-star"></i> <span>Play Game</span> </p>
    </a> </div>
     <div class="item <?php if($urlpage=='myaccount.php'){echo'active';}?>"> <a href="myaccount.php">
    <p> <i class="icon ion-md-person"></i> <span>My Account</span> </p>
    </a> </div>
     
    
    
   
    <?php }else{?>
    <div class="item <?php if($urlpage=='index.php'){echo'active';}?>"> <a href="index.php">
    <p> <i class="icon ion-md-home"></i> <span>Login</span> </p>
    </a> </div>
  
  <div class="item <?php if($urlpage=='index.php' || $urlpage=='signup.php' || $urlpage=='forgot-password.php'){echo'active';}?>"> <a href="signup.php" class="icon toggleSidebar">
    <p> <i class="icon ion-md-person"></i> <span>Register </span> </p>
    </a> </div>
    <?php }?>
</div>