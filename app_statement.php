<?php
ob_start();
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php include'head.php' ?>
<link rel="stylesheet" href="assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<meta name="description" content="Lottlucy">
<style>
.appHeader1 {
    	background-image: url("bg.jpg");
}
.card {
	border-radius:0px;
}
.appContent {
  	padding-right:20px;
  		padding-left:20px;
}
h1{font-size:1.7rem; font-weight:600;}
h2{font-size:1.4rem; font-weight:600;}
</style>
</head>

<body>
<?php include("include/connection.php");?>
<!-- Page loading -->
<div class="loading" id="loading">
  <div class="spinner-grow"></div>
</div>
<!-- * Page loading --> 

<!-- App Header -->
<div class="appHeader1">
  <div class="left"> 
  <a href="https://evoliveonline.com" onClick="goBack()" class="icon goBack"> 
  <i class="icon ion-md-arrow-back"></i> 
  </a>
    <div class="pageTitle">App Statement</div>
  </div>
</div>
<!-- * App Header --> 

<!-- App Capsule -->
<div id="appCapsule">
  <div class="appContent">
      
     <div data-v-3c4fc972="" class="content" style="padding-top: 56px;"><h2 data-v-3c4fc972="">
            App Statement
        </h2> <span data-v-3c4fc972="">
            Colour Prediction is an app that lets you to access online business of the Veymo Fashions Private Limited which is incorporated company under Indian Companies Act. This app accesses your information to provide you better services and to protect your personal information. We promise to comply with relevant laws and regulations, provide you with latest versions of. If you agree to the content above/privacy statement of Colour Prediction
        </span></div>
    
  </div>
</div>
    <br><br> <br><br>
<?php include("include/footer.php");?>
<!-- Jquery --> 
<script src="assets/js/lib/jquery-3.4.1.min.js"></script> 
<!-- Bootstrap--> 
<script src="assets/js/lib/popper.min.js"></script> 
<script src="assets/js/lib/bootstrap.min.js"></script> 
<!-- Owl Carousel --> 
<script src="assets/js/plugins/owl.carousel.min.js"></script> 
<!-- Main Js File --> 
<script src="assets/js/app.js"></script>
</body>
</html>