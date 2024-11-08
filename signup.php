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
<meta name="description" content="">
<meta name="keywords" content="" />
<script type="text/javascript">
let currentUrl = location.href;
history.replaceState('', '', 'index.php');
history.pushState('', '', currentUrl);
</script>

<style>
.otpbtn {background-image: linear-gradient(
#29B6F6, 
#29B6F6);
color: white;
    width: 105px;
    padding: 25px 0px;
    margin-left: -10px;
    margin-top: -1px;
    border-radius: 0px;
}
 .btn1 { 
        color: white;
    height:45px; 
    width:264px;
    border-radius:13px; 
    background-image: linear-gradient(
#ae18e3, 
#5b1474);
    
}
.btn { 
        color: white;
    height:45px; 
    
    border-radius:13px; 
    background-image: linear-gradient(
#ae18e3, 
#5b1474);
    
}

</style>
<style>
    .btn { background-image: linear-gradient(
#291F53, 
#291F53);
    border-radius: 5px 5px 5px 5px;
    border: 0.5px solid white;
    color: white;
    transition: 0.5s;
    
}
.appHeader1 {
	background-image: url("bg.jpg");

}
.textbox {
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
 
    
</style>

</head>

<body>
<?php include("include/connection.php");?>


<!-- App Header -->
<div class="appHeader1">
<div class="left">
           <a href="index.php" class="icon goBack"> <i class="icon ion-md-arrow-back"></i> </a>
            <div class="pageTitle">Register</div>
        </div>
 
 
</div>
<!-- * App Header --> 
<!-- App Capsule -->
<div id="appCapsule">
  <div class="appContent1 mb-2">

    <form action="#" method="post" id="Register" class="card-body" autocomplete="off">
    <div class="row ">
                    <div class="col-8">
      <div class="inner-addon left-addon">
      <i style="color:#841DA8;" class="icon ion-md-phone-portrait"> &emsp;</i>
        <input type="tel" name="mobile" id="mobile" onKeyPress="return isNumber(event)" class="form-control textbox" placeholder="Mobile Number" value="" maxlength="10">
      </div>
      </div>
      <div class="col-4 pl-0"><a href="javascript:void(0);" style="width:100px; height:10px; font-size: 15px;" class="btn btn-primary otpbtn" id="reg_otp" onClick="mobileveryfication();">Send OTP</a></div>
      </div>
      <div class="inner-addon left-addon">
      <i style="color:#841DA8;" class="icon ion-ios-mail">&emsp;&emsp;</i>
        <input type="email" name="email" id="email" class="form-control textbox" placeholder="Email ID">
      </div>
      <div class="inner-addon left-addon">
      <i style="color:#841DA8;" class="icon ion-md-lock">&emsp;&emsp;</i>
        <input type="password" name="password" id="password" class="form-control textbox" placeholder="New Password">
      </div>
      <div class="inner-addon left-addon">
      <i style="color:#841DA8;" class="icon ion-ios-gift">&emsp;&emsp;</i>
        <input type="text" name="rcode" id="rcode" class="form-control textbox" placeholder="Referal Code" value="<?php echo @$_GET['code'];?>">
      </div>
      <input type="hidden" name="action" value="register">
      <div class="form-group row mt-3 mb-3">
                    <div class="col-12">
                        <div class="custom-control custom-checkbox">
    <input type="checkbox" checked class="custom-control-input" id="remember" name="remember">
  <label class="custom-control-label text-muted" for="remember">I agree <a data-toggle="modal" href="#privacy" data-backdrop="static" data-keyboard="false">PRIVACY POLICY</a></label>
                        </div>
                    </div>
                    
                </div>
      <div>
      <div class="text-center mt-3">
        <button type="submit" class="btn1 btn-light" > Register </button>
        </div><br><hr>
 <div class="text-center mt-3">
            <label> If You Already Have an Account Then,<br>Login to Your Account</label>
             <a href="index.php" class="btn btn-primary">Login</a>
             </div>
      </div>
    </form>
  </div>
</div>
<!-- appCapsule -->

<?php include("include/footer.php");?>
<div id="registerthanksPopup" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="modal-body">
        <div class="text-center">
          <h5>Thank you !</h5>
          <h6>Your account Registration Successfully.</h6>
          <div class="text-center">
<button type="button" class="btn btn-sm btn-primary" onClick="window.location='/index.php';">OK</button></div>
        </div>
      </div>
    </div>
  </div>
</div>
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
<div id="privacy" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 style="font-weight:normal;">Privacy Policy</h5>
              </div>
      <div class="modal-body responsive">
      <?php echo content($con,"privacy");?>

      </div>
      <div class="modal-footer">
    <a class="pull-left" data-dismiss="modal"><strong>CLOSE</strong></a>
              </div>
    </div>
  </div>
</div>
<div id="otpform" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content ">
      <div class="modal-body">
    <button type="button" id="otpclose" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">×</span></button>
       <p><strong>Plese Enter OTP</strong></p>
        <div class="pt-2">
   <form action="#" method="post" id="otpsubmitForm">
  <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" onKeyPress="return isNumber(event)">
      <input type="hidden" name="type" id="type" value="otpval">
      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary" style="width:264px;"> Submit OTP </button>
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
<script src="assets/js/account.js"></script>
</body>
</html>