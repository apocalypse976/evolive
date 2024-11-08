<?php
ob_start();
session_start();

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<script type="text/javascript">
  function preventBack(){window.history.forward()};
  setTimeout("preventBack()",0);
     window.onunload=function(){null;}
     </script>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php include'head.php' ?>
<link rel="stylesheet" href="assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<meta name="description" content="Bitter Mobile Template">
<meta name="keywords" content="bootstrap, mobile template, bootstrap 4, mobile, html, responsive" />

<style>
     .btn { 
        color: white;
    height:45px; 
    border-radius:13px; 
    background-image: linear-gradient(
#ae18e3, 
#5b1474);
   
}
.textbox {
  height: auto;
  width: 300;
  color: #fff;
  outline: none;
  border: none;
  border-radius: 8px;
  font-size: 18px;
  font-weight: 400;
  margin: 0px 0;
  cursor: pointer;
  transition: all 0.4s ease;
}
    
.appHeader1 {
	background-image: url("bg.jpg");

}
</style>
</head>

<body>


<!-- * Page loading --> 

<!-- App Header -->
<div class="appHeader1">
<div class="left">
            <a href="javascript:void(0);" class="icon goBack">&nbsp;</a>
            <div class="pageTitle">Login</div>
        </div>
 
 
</div>
 
 
<!-- * App Header --> 
<!-- App Capsule -->
<div id="appCapsule">
  <div class="appContent1">

	   <?php if(@$_SESSION['AuthUser']['username']) { ?>
	   <div class="text-center mt-3">
        <h3>Welcome <?php echo $_SESSION['AuthUser']['username'];?></h3>
		<h6>You can play the game. Good Luck !</h6>
	   </div>
	   
	   <div class="text-center mt-3">
        <a href="/evolive/game/myaccount.php">
		<button type="button" class="btn btn-sm btn-dark" style="width:200px; height:45px; border-radius:13px; background-image: linear-gradient(
#ae18e3, 
#5b1474);"> Play </button>
        </a>
	   </div>
      </div>
    
	   <?php }else{ ?>
		<div class="text-center mt-3">
        <h3>You are not logged In</h3>
		<h6>Please click on below button to login</h6>
	   </div>
	   
	   <div class="text-center mt-3">
        <a href="/evolive/login">
		<button type="button" class="btn btn-sm btn-dark" style="width:200px; height:45px; border-radius:13px; background-image: linear-gradient(
#ae18e3, 
#5b1474);"> Login </button>
        </a>
	   </div>
      </div>
    
	   <?php } ?>
	   
      </div>
	  
      
  </div>
</div><br><br><br><br><br><br><br><br><br><br><br><br>
        </a>
<!-- appCapsule -->

<?php //include("include/footer.php");?>
<div id="registertoast" class="modal fade" role="dialog">
    
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content ">
      <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">×</span></button>
        <div class="text-center" id="regtoast">          
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/lib/jquery-3.4.1.min.js"></script> 
<!-- Bootstrap--> 
<script src="assets/js/lib/popper.min.js"></script> 
<script src="assets/js/lib/bootstrap.min.js"></script> 
<!-- Owl Carousel --> 
<script src="assets/js/plugins/owl.carousel.min.js"></script> 
<!-- Main Js File --> 
<script src="assets/js/app.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/account.js"></script>

</body>
</html>