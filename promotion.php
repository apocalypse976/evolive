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
<title>Metally Mall</title>
<link rel="stylesheet" href="assets/css/style.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<style>
.btn3 {
   background-color: #FFD700;
    border-radius: 15px 15px 15px 15px;
    border: 1px solid white;
  padding-bottom: 4px;
  padding-top: 4px;
  padding-left: 25px;
  padding-right: 25px;
    transition: 0.5s;
    
}

.appContent3 {
    background-image: url("bg.jpg");
	background-color: #2196f3 !important;
	border-color: #2196f3 !important;
	padding:20px;
	font-size:16px;
}
  body {
	-ms-user-select:text;
	user-select:text;
	-moz-user-select:text;
	-webkit-user-select:text
}
.appHeader1 {
    	background-image: url("bg.jpg");
}
.card {
    border: 1px solid #E5E9F2;
    border-radius: 3px;
    padding: 0px;
}
.card .card-title {
    margin-bottom: 7px;
}
h3{ font-weight:normal; font-size:20px;}
h4{ font-weight:normal; font-size:18px; color:#858585;}
.card-body{ padding:.6rem;}
td{ padding:3px;}
.btn-sm {
    height: 26px;
    padding: 0px 12px;
}
.form-control{box-shadow:none; border-bottom:#ccc solid 1px; margin-bottom:3px;}
#alert h4{font-size: 1rem; font-weight:bold; color:#333;}
#alert p{font-size: 13px; margin-top:20px;}
#alert .modal-content{border-radius:3px}
#alert .modal-dialog{padding:20px; margin-top:130px;}

label{ display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0 10px;
  color: #291F53;
  margin-bottom: 0px;
  font-size: 20px;
}
#bonus .modal-dialog{margin-top:100px;}
#bonus .modal-footer{ border:none;}
.dropdown-menu{ background:#fff;top: -15px;
left: -145px; border:none;
border-radius:0px;
-webkit-box-shadow: 0 3px 1px -2px rgba(0, 0, 0, .2), 0 2px 2px 0 rgba(0, 0, 0, .14), 0 1px 5px 0 rgba(0, 0, 0, .12);
box-shadow: 0 3px 1px -2px rgba(0, 0, 0, .2), 0 2px 2px 0 rgba(0, 0, 0, .14), 0 1px 5px 0 rgba(0, 0, 0, .12);}
.appHeader1 .right{right:20px;
    	
}
.dropdown-item {
    padding: .75rem 1.5rem;
}
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: right;
  width: 50%;
  padding: 0px;
   /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
</head>

<body>
<?php
include("include/connection.php");
$userid=$_SESSION['frontuserid'];
?>

<!-- App Header -->
<div class="appHeader1">
  <div class="left"> <a href="#" onClick="goBack();" class="icon goBack"> <i class="icon ion-md-arrow-back"></i> </a>
    <div class="pageTitle"> My Promotion</div>
  </div>
  
  <div class="right"> 
  <div class="dropdown">
  <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:20px;">
    <i class="icon ion-md-list"></i></a>
  

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="promotionrecord.php">Promotion Record</a>
    <a class="dropdown-item" href="bonusrecord.php">Bonus Record</a>
    <a class="dropdown-item" href="promotionApplyrecord.php">Apply Record</a>
  </div>
</div>
  </div>
</div>
<!-- searchBox --> 

<!-- * searchBox --> 
<!-- * App Header --> 

<!-- App Capsule -->
  <div class="appContent3 text-white">
    <div class="row">
         <div class="column"><br>
      <center><b><span style="font-size:18px;">₹ <span id="bms"><?php echo (bonus($con,'amount',$userid));?></span><br>My Bonus<span></center></div>
     <div class="column"><br>
     <center><a data-toggle="modal" href="#bonus" data-backdrop="static" data-keyboard="false" style="color:black; font-size:15px;"  class="btn3 btn-sm btn-success m-0">Apply to Balance</a><br></center></b></div>
     
 
  </div></div>
   <!--   <ul class="nav nav-tabs size2" id="myTab3" role="tablist">
        <li class="nav-item"> 
<a class="nav-link active" id="home-tab3" data-toggle="tab" href="#level1" role="tab">Level 1</a> 
        </li>
        <li class="nav-item"> 
<a class="nav-link" id="profile-tab3" data-toggle="tab" href="#level2" role="tab">Level 2</a>
         </li>
        
      </ul> -->
   <br>
   
      <div class="mt-1">
      <div class="tab-content" id="myTabContent">
      
        <div class="tab-pane fade active show" id="level1" role="tabpanel">
        <div class="row">
        <div class="col-6">
        <div class="mb-3">
                <div class="text-center">
                    <h4>Total People </h4>
                    <h5>
                    <?php
	  @$userid=$_SESSION['frontuserid'];
      $user=mysqli_query($con,"select * from `tbl_user` where `id`='".$userid."'");
	  $userRows=mysqli_num_rows($user);
	  $userResult=mysqli_fetch_array($user);
	  $owncode=$userResult['owncode'];
	  $userlevel1=mysqli_query($con,"select * from `tbl_user` where `code`='".$owncode."' order by id asc");
	  $userlevel1Rows=mysqli_num_rows($userlevel1);
	  
	  echo $userlevel1Rows;
	  ?>
</h5>
                </div>
            </div>
        </div> 
        <div class="col-6">
        <div class="mb-3">
                <div class="text-center">
                    <h4>Bonus </h4>
                    <h5>₹ <?php echo (bonus($con,'level1',$userid));?></h5>
                </div>
            </div>
        </div>   
        </div>
        </div>
       <!--=========================tab-1 end========================================-->
       <!--=========================tab-2========================================-->
        <div class="tab-pane fade" id="level2" role="tabpanel">
<div class="row">
        <div class="col-6">
        <div class="mb-3">
                <div class="text-center">
                    <h4>Total People </h4>
                    <h5>
                                   <?php
 $level1peoplecount=mysqli_query($con,"select * from `tbl_bonussummery` where `level1id`='".$userid."'");
 $level1numrows=mysqli_num_rows($level1peoplecount);
 echo $level1numrows;
?>
                    
                    </h5>
                </div>
            </div>
        </div> 
        <div class="col-6">
        <div class="mb-3">
                <div class="text-center">
                    <h4>Contribution </h4>
                    <h5>₹ <?php echo (bonus($con,'level2',$userid));?></h5>
                </div>
            </div>
        </div>   
        </div>
        </div>

        </div>
      </div>
      <div class="">
    <div class=""><b>  
           
      <div class="card"><center><br>  <label>My Invite QR Code</label>   <img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=https://evoliveonline.com/signup.php?code=<?php echo user($con,'owncode',$userid);?>"> </center>  <br>
<b><label>My Invite Code</label> </b><center><h5><?php echo user($con,'owncode',$userid);?></h5></center><br>
</b></div>
<div class="text-boxes">
    <div class="text-box HTMLBox">
     
      <textarea id="HTMLBox" readonly >https://evoliveonline.com/signup.php?code=<?php echo user($con,'owncode',$userid);?>
      </textarea>
      <button id="HTMLButton">Copy Invite Link</button>
    </div></div>
<!--<div class="mt-3">
<label>My Promotion Link</label>
<p>Test</p>
</div>-->
      </div>
  </div>
</div>
<!-- appCapsule -->

<?php include("include/footer.php");?>
<div id="bonus" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header paymentheader" id="paymenttitle"> 
      <h4 class="modal-title text-dark">Apply to Balance</h4>
       </div>
 <form action="#" method="post" id="bonusForm" autocomplete="off">
      <div class="modal-body mt-1" id="loadform">
      <div class="row">
                    <div class="col-12">
<div class="inner-addon left-addon mt-3">
      <i class="icon"><i class="fa fa-rupee"></i></i>
        <input type="number" id="bonusammount" name="bonusammount" class="form-control" placeholder="Bonus" onKeyPress="return isNumber(event)" >
      </div>                   
<input type="hidden" name="userid" id="userid" class="form-control" value="<?php echo $userid;?>">
<input type="hidden" name="action" id="action" class="form-control" value="bonus">
      
                    </div>
                </div>
      </div>
      <input type="hidden" name="tab" id="tab" value="parity">
      <div class="modal-footer"> 
   <a type="button" class="pull-left btn btn-sm closebtn" data-dismiss="modal">CANCEL</a>
<button type="submit" class="pull-left btn btn-sm btn-white text-info">CONFIRM</button> 
      </div>
      </form>
    </div>
  </div>
</div>

<div id="alert" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body" id="alertmessage"> </div>
      <div class="text-center pb-1">
    <a type="button" class="text-info" data-dismiss="modal">OK</a>
    </div> 
    </div>
  </div>
</div>
<!-- Jquery --> 
<script src="assets/js/lib/jquery-3.4.1.min.js"></script> 
<!-- Bootstrap--> 
<script src="assets/js/lib/popper.min.js"></script> 
<script src="assets/js/lib/bootstrap.min.js"></script> 
<!-- Owl Carousel --> 
<script src="assets/js/plugins/owl.carousel.min.js"></script> 
<!-- Main Js File --> 
<script src="assets/js/app.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/bonus.js"></script>
  <script>
  // HTML BOx JS Code
    let HTMLBox = document.getElementById("HTMLBox");
    let HTMLButton = document.getElementById("HTMLButton");

    HTMLButton.onclick = function() {
      HTMLBox.select();
      document.execCommand("copy");
      HTMLButton.innerText = "Codes Copied"
    }

    // CSS Box Js Code
      let CSSBox = document.getElementById("CSSBox");
      let CSSButton = document.getElementById("CSSButton");

      CSSButton.onclick = function() {
        CSSBox.select();
        document.execCommand("copy");
        CSSButton.innerText = "Codes Copied"
      }
    // JavaScript BOx JS Code
      let JSBox = document.getElementById("JSBox");
      let JSButton = document.getElementById("JSButton");

      JSButton.onclick = function() {
        JSBox.select();
        document.execCommand("copy");
        JSButton.innerText = "Codes Copied"
      }
  </script>
</body>
</html>