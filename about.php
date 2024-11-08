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
    <div class="pageTitle">About us</div>
  </div>
</div>
<!-- * App Header --> 

<!-- App Capsule -->
<div id="appCapsule">
  <div class="appContent">
      
      <div data-v-a570ca90="" class="content" style="padding-top: 56px;"><p data-v-a570ca90=""></p><h2 data-v-a570ca90="">Company Introduction</h2><p data-v-a570ca90=""></p> <span data-v-a570ca90="">
            Colour Prediction is an online mall business that engages in full payment and pre-payment booking/unsubscription business according to the rules and conditions that we have established to regulate the business. We have tie-up with some other reputed companies to provide best and satisfactory services to our clients/customers. Our company is one of the best among to follow laws and we have certain restrictions to prevent online fraud with our clients we do not allow. Minors under the age of 18 are not permitted to participate in The Colour Prediction Advance Booking/unsubscribing.
            Note: Being responsible trader we advised our client to readout our Privacy Statement, Risk Disclosure Agreement and Risk Agreement carefully to minimize their risk.
        </span><br data-v-a570ca90=""> <span data-v-a570ca90="">
            Note: Being responsible trader we advised our client to readout our Privacy Statement, Risk Disclosure Agreement and Risk Agreement carefully to minimize their risk.
        </span> </div>

    
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