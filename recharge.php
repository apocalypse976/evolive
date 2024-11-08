<?php 
ob_start();
session_start();
if($_SESSION['AuthUser']['username'] =="")
//if($_SESSION['frontuserid']=="")
{
	header("location:index.php");exit();
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php include'head.php' ?>
<link rel="stylesheet" href="assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Brozers Mall">
<meta name="keywords" content="Brozers Mall" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<style>
h3{ font-weight:normal; font-size:14px;}

.btn { 
        color: white;
    height:45px; 
    border-radius:13px; 
    background-image: linear-gradient(
#ae18e3, 
#5b1474);
    
}
.textbox {
    font-weight:normal;
  height: 45px;
  width: 300;
  color: #fff;
  outline: none;
  border: none;
  border-radius: 8px;
  font-size: 18px;
  font-weight: 400;
  margin: 8px 0;
  cursor: pointer;
  transition: all 0.4s ease;
}
 
    .appHeader1 {
    	background-image: url("bg.jpg");
}
    
.button {
    display: inline-block;
    margin: 5px;
    width: auto;
    height: auto;
    font-size: 20px;
    font-weight: bold;
    border-radius: 5px;
    box-sizing:border-box;
    font-family: Orbitron;
}
.digits {
    color: #181818;
    text-shadow: 1px 1px 0px #FFF;
    background-color: #EBEBEB;
    border-top: 2px solid #FFF;
    border-right: 2px solid #FFF;
    border-bottom: 2px solid #C1C1C1;
    border-left: 2px solid #C1C1C1;
    border-radius: 4px;
    box-shadow: 0px 0px 2px #030303;
}
.digits:hover,
.mathButtons:hover,
#clearButton:hover {
    background-color: #FFBA75;
    box-shadow: 0px 0px 2px #FFBA75, inset 0px -20px 1px #FF8000;
    border-top: 2px solid #FFF;
    border-right: 2px solid #FFF;
    border-bottom: 2px solid #AE5700;
    border-left: 2px solid #AE5700;
}
 .btn1 { 
        color: black;
    height:45px; 
    width: 75px;
    border-radius:13px; 
   background-color: #F6F6F6;
    
}
.vcard {
	box-shadow:true;
}
label{ display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0 10px;
  color: #291F53;
  margin-bottom: 0px;
  font-size: 20px;
}
</style>
</head>

<body>
<?php
include("include/connection.php");
$userid=$_SESSION['frontuserid'];?>


<!-- App Header -->
<div class="appHeader1">
<div class="left">
            <a href="myaccount.php" onClick="goBack();" class="icon goBack">
                <i class="icon ion-md-arrow-back"></i>
            </a>
            <div class="pageTitle">Recharge</div>
        </div>
 <div class="right"> 
 
  <a  href="rechargehistory.php" role="button" style="font-size:20px;">
    <i class="icon ion-md-paper"></i></a>
</div></div>
<!-- * App Header --> 
<!-- App Capsule -->
<div id="appCapsule">
  <div class="appContent1">
<h5 class="text-center m-2">Balance: <span>₹ <?php echo number_format(wallet($con,'amount',$userid), 2);?></span></h5><hr>
    <form  name="calculator" action="#" id="paymentForm" method="post" class="card-body " autocomplete="off"> <br>
      <div class="inner-addon left-addon">
      <i style="color:#841DA8;" class="icon ion-md-wallet">&emsp;&emsp;</i>
        <input type="number" id="userammount" name="userammount" class="form-control textbox" placeholder=" &nbsp;Enter recharge amount" onKeyPress="return isNumber(event)" >
      </div>
            <div>
     <!--   <p style="color: 696969; font-size:11px;" ><strong>Note:</strong> Minimmum Recharge = 200
        <br> -->
 <center>  <b><input class="btn1 btn-sm btn-light" type="button" value="200" onclick="calculator.userammount.value = '200'">
      <input class="btn1 btn-sm btn-light" type="button" value="500" onclick="calculator.userammount.value = '500'">
      <input class="btn1 btn-sm btn-light" type="button" value="1000" onclick="calculator.userammount.value = '1000'"><br>
      <input class="btn1 btn-sm btn-light" type="button" value="2000" onclick="calculator.userammount.value = '2000'">
      <input class="btn1 btn-sm btn-light" type="button" value="5000" onclick="calculator.userammount.value = '5000'">
      <input class="btn1 btn-sm btn-light" type="button" value="10000" onclick="calculator.userammount.value = '10000'">
   </center> </b> </div>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary" style="width:264px;"> Recharge </button>
        </div>
        
      
    </form>
  </div>
</div><!-- <hr>
   <div class="card"><center><br><b>  <label>Pay With QR Code</label> </b><br> <p style="color: 696969; font-size:11px;" ><strong>Note:</strong> After Payment, Send Me Screenshot <br>of payment, By Click On Contact us  Button <img src="recharge.jpeg" width="192" height="192"><a href="https://telegram.me/Starwingo"  class="btn btn-primary" style="width:200px;"> Contact us </a> </center>  <br>
</center><br><br>
</div> -->
</div>


<!-- appCapsule -->

<?php include("include/footer.php");?>
<div id="paymentdetail" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">×</span></button>
       <p>&nbsp;</p>
        <div class="">
        <form action="#" method="post" id="paymentdetailForm">
        <div class="inner-addon left-addon">
      <i style="color:#841DA8;" class="icon ion-md-person"></i>
  <input type="text" id="name" name="name" class="form-control textbox" placeholder="Enter Your Name">
      </div>
      <div class="inner-addon left-addon">
      <i style="color:#841DA8;" class="icon ion-md-phone-portrait"></i>
        <input type="tel" id="mobile" name="mobile" class="form-control textbox" placeholder="Enter Mobile Number"  value="<?php echo user($con,'mobile',$userid);?>" onKeyPress="return isNumber(event)">
      </div>
      <div class="inner-addon left-addon">
      <i style="color:#841DA8;" class="icon ion-ios-mail"></i>
   <input type="text" id="email" name="email" class="form-control textbox" placeholder="Enter Email id"  value="<?php echo user($con,'email',$userid);?>">
      </div>
      <input type="hidden" name="finalamount" id="finalamount" value="">
      <input type="hidden" name="action" id="action" value="paydetail">
      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary" style="width:264px;"> Recharge </button>
        </div>
        </form>          
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
<script src="assets/js/payment.js.php"></script>

</body>

</html>