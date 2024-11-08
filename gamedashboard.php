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
<?php include 'head.php';?>
<link rel="stylesheet" href="assets/css/style.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<style>



div1 {
    overflow: hidden;
    position: relative;
    display: flex;
    height: 65px;
    margin-top: 25px;
    margin-bottom: -25px;
}

li1 {
    color: #000000;
    font-weight: 700;
   margin-left: -35px;
   
    height: 45px;
    margin-bottom: 45px;
    display: block;
}

.words { 
    font-size: 14px;
    
    animation: words 10s cubic-bezier(0.23, 1, 0.32, 1.2) infinite; 
}

@keyframes words {
    0% {
         margin-top: -360px; 
        }
    5% {
         margin-top: -270px; 
        }
    25% {
         margin-top: -270px; 
        }
    30% {
         margin-top: -180px; 
        }
    50% {
         margin-top: -180px; 
        }
    55% {
         margin-top: -90px; 
        }
    75% {
         margin-top: -90px; 
        }
    80% {
         margin-top: 0px; 
        }
    99.99% {
         margin-top: 0px; 
        }
    100% {
         margin-top: -270px; 
        }
}


.btn6 {
    border-radius: 20px 20px 20px 20px;
    border: 0px solid white;
padding: 100px 100px;
    transition: 0.5s;
    
}
.btn7 {

 background-color: #FFD700;
   padding-bottom: 4px;
  padding-top: 4px;
  padding-left: 15px;
  padding-right: 15px;
    transition: 0.5s;
    
}
.btn5 {
    border-radius: 30px 30px 30px 30px;
    border: 0px solid white;

    transition: 0.5s;
    
}
.btn3 {
    border-radius: 30px 30px 30px 30px;
    border: 0px solid white;

    transition: 0.5s;
    background-image: linear-gradient(#FF3324, #9c27b0);
}
.btn4 {
    border-radius: 30px 30px 30px 30px;
    border: 0px solid white;

    transition: 0.5s;
    background-image: linear-gradient(#1DCC70, #9c27b0);
}
.text1 {
  padding-top: 10px;
}
.btn1 {
   background-color: #FFD700;
    border-radius: 15px 15px 15px 15px;
    border: 1px solid white;
  padding-bottom: 4px;
  padding-top: 4px;
  padding-left: 25px;
  padding-right: 25px;
    transition: 0.5s;
    
}
.vcard1 {
    border: 0px solid white;
transition: 0.5s;
  padding-bottom: 0px;
  padding-top: 0px;
  padding-left: 5px;
  padding-right: 5px;
  box-shadow:2px;
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

.appHeader1 {
	background-color: #fff !important;
	border-color: #fff !important;
}
.modal-header1  {
	background-image: url("bg.jpg");
	border-color: #2196f3 !important;
	padding:18px;

	font-size:16px;
}
.appContent3 {
	background-image: url("bg.jpg");
	border-color: #2196f3 !important;
	padding:18px;

	font-size:16px;
}
.user-block img {
	width: 40px;
	height: 40px;
	float: left;
	margin-right:10px;
	background:#333;
}

.gap {
  
  column-gap: 1px;
}

.img-circle {
	border-radius: 50%;
}
.reaload {
	box-shadow:none;
}
.ion-md-refresh {
	font-size:26px !important;
}
.responsive {
	height:300px;
	overflow-x: auto;
}
.bottom-three {
     margin-bottom: 3cm;
  }
.vcard {
	box-shadow:none;
}
h5{ color:#888; font-size:20px; font-weight:normal;}
h5 span{ color:#333; font-size:22px;}
.divsize4 .btn{padding: 0 10px; width:100px;}
.left-addon input {
    padding-left: 20px;
}
.right{
    float:right;
}

.left{
    float:left;
}

.error {
    top: 45px;
}
.containerrecord{border-bottom: solid 2px #565EFF;}
.recordlink{
    font-size: 26px;
    color: #333;
	border-bottom: solid 2px #565EFF ;
}
.recordlink .title{font-size: 14px;
font-weight: 500;}
#alert h4{font-size: 1rem;}
#alert p{font-size: 13px; margin-top:25px;}
#alert .modal-content{border-radius:3px}
#alert .modal-dialog{padding:30px; margin-top:200px;}
#payment .modal-dialog{padding:10px;margin-top:60px;}
#loader .modal-dialog{padding:30px; margin-top:200px;}

</style>
</head>

<body>
<?php
include("include/connection.php");
$userid=$_SESSION['AuthUser']['userid'];
//$userid=$_SESSION['frontuserid'];
$selectruser=mysqli_query($con_evolive,"select * from `users` where `id`='".$userid."'");
$userresult=mysqli_fetch_array($selectruser);
//$selectruser=mysqli_query($con,"select * from `tbl_user` where `id`='".$userid."'");
//$userresult=mysqli_fetch_array($selectruser);
$selectwallet=mysqli_query($con_evolive,"select * from `users` where `id`='".$userid."'");
$walletResult=mysqli_fetch_array($selectwallet);
//$selectwallet=mysqli_query($con,"select * from `tbl_wallet` where `userid`='".$userid."'");
//$walletResult=mysqli_fetch_array($selectwallet);
?>
<!-- Page loading -->


<!-- App Header -->
<div class="">
    
  <div class="appContent3 text-white">
      <div class="row">
        <div class="column text1">
      <center></div>
     <div class="column">
        
     <center>   <b><a style="color:white;" data-toggle="modal" href="#rule" data-backdrop="static" data-keyboard="false"> &emsp;&emsp;<i class="icon ion-md-paper"></i> Read Rule</a></b></div>
      
     
    </div>
    <div class="row">
        <div class="column text1">
      <center><b><div  style="font-size:18px;">Available Balance:
      <br>₹ <span id="balance"><?php 
	  //echo number_format(wallet($con,'amount',$userid), 2); 
	  echo number_format(wallet($con_evolive,'balance',$userid), 2);
	  ?></span></div></div>
     <div class="column">
        
     <center> 
		<br>  
		<!--<a style="color:black;" href="recharge.php" class="btn1 btn-sm btn-success m-0">Recharge</a> -->
		</div>
      
     
    </div>
  </div>
</div>
<!-- searchBox --> 

<!-- * searchBox --> 
<!-- * App Header --> 

<!-- App Capsule -->
<div class="mb-5">
  <div class="long mb-3">      
      <!-- listview -->
      <ul class="nav nav-tabs size4" id="myTab3" role="tablist">
        <li class="nav-item"> 
<a class="nav-link active" id="home-tab3" data-toggle="tab" href="#parity" role="tab" onClick="tabname('parity');getResultbyCategory('parity','parity');">Star</a> 
        </li>
        <li class="nav-item"> 
<a class="nav-link" id="profile-tab3" data-toggle="tab" href="#sapre" role="tab" onClick="tabname('sapre');getResultbyCategory('sapre','sapre');">Parity</a>
         </li>
        <li class="nav-item"> 
<a class="nav-link" id="contact-tab3" data-toggle="tab" href="#bcone" role="tab" onClick="tabname('bcone');getResultbyCategory('bcone','bcone');">Sapre</a> 
        </li>
        <li class="nav-item"> 
<a class="nav-link" id="contact-tab3" data-toggle="tab" href="#emerd" role="tab" onClick="tabname('emerd');getResultbyCategory('emerd','emerd');">Bcone</a> 
        </li>
      </ul>
      <!--=====================game area============================-->
      <div class="appContent1 bg-light mt-n1">
      <div class="layout">
        <div class="gameidtimer"> 
      <h4 class="mb-2"><i class="icon ion-md-trophy"></i> Period ID</h4>
      <h5>
      <span class="showload">
      <div class="spinnner-border text-danger" role="status">
                    </div></span>
             <span id="gameid" class="none"><?php echo sprintf("%03d",gameid($con));?></span>
             <input type="hidden" id="futureid" name="futureid" value="<?php echo sprintf("%03d",gameid($con));?>">
             </h5>
      </div>
      <div class="gameidtimer text-right"> 
      <h6 class="mb-2">Count Down</h6>
       <h5 class="gbutton2" id="demo"></h5> <button type="button"  style="color:black;" href="javascript:void(0);" onClick="reloadbtn(<?php echo $userid;?>);" onclick="getResultbyCategory(parity,parity)" class="gbutton1 btn7"><i class="fa fa-spinner fa-spin"></i> loading</button>
      
     
      </div>
      </div>
       <div1 >
         
       <ul class="words">
              
                <li1>Congratulations to number ******8180<span  style="color: rgb(248, 67, 80);"> Winning 150.4K</span></li1>
                
                <li1>Congratulations to number ******2012
                <span  style="color: rgb(248, 67, 80);"> Winning 189.1K</span></li1>
                <li1>Congratulations to number ******4775
                <span  style="color: rgb(248, 67, 80);"> Winning 125.5K</span></li1>
                <li1>Congratulations to number ******3659
                <span  style="color: rgb(248, 67, 80);"> Winning 154.8K</span></li1>
                 <li1>Congratulations to number ******1676
                <span  style="color: rgb(248, 67, 80);"> Winning 26.7K</span></li1>
                  <li1>Congratulations to number ******9926
                <span  style="color: rgb(248, 67, 80);"> Winning 189.8K</span></li1>
                   <li1>Congratulations to number ******1415
                <span  style="color: rgb(248, 67, 80);"> Winning 151.6K</span></li1>
                    <li1>Congratulations to number ******5997
                <span  style="color: rgb(248, 67, 80);"> Winning 12.8K</span></li1>
                     <li1>Congratulations to number ******8637
                <span  style="color: rgb(248, 67, 80);"> Winning 105.6K</span></li1>
                      <li1>Congratulations to number ******6916
                <span  style="color: rgb(248, 67, 80);"> Winning 16.5K</span></li1>
                 
            </ul>
       </div1>
    
      <div class="bg-light  layout text-center mt-2">
      <div class="divsize4">
      <button type="button" class="btn btn-sm btn-success gbutton none btn6" onClick="betbutton('#1DCC70','button','Green');">Join Green</button>
      </div>
      <div class="divsize4">
      <button type="button" class="btn btn-sm btn-danger gbutton none btn6" onClick="betbutton('#FF0000','button','Red');">Join Red</button>
      </div>
      <div class="divsize4">
      <button type="button" class="btn btn-sm btn-violet gbutton none btn6" onClick="betbutton('#9c27b0','button','Violet');">Join Violet</button>
      </div>
      </div>
      
      
     <div class="container-fluid">
        <div class="layout text-center bg-light  d-flex justify-content-center">
      
      
      <div class="divsize2">
      <button type="button" class="btn btn-sm btn-danger gbutton none btn3" onClick="betbutton('#FF0000','button','0');">0</button>
      </div>&emsp;
      <div class="divsize2">
      <button type="numbutton" class="btn btn-sm btn-success gbutton none btn5" onClick="betbutton('#008000','button','1');">1</button>
      </div>&emsp;
      
      <div class="divsize2">
      <button type="button" class="btn btn-sm btn-danger gbutton none btn5" onClick="betbutton('#FF0000','button','2');">2</button>
      </div>&emsp;
      
      <div class="divsize2">
      <button type="button" class="btn btn-sm btn-success gbutton none btn5" onClick="betbutton('#008000','button','3');">3</button>
      </div>&emsp;
      
      <div class="divsize2">
      <button type="button" class="btn btn-sm btn-danger gbutton none btn5" onClick="betbutton('#FF0000','button','4');">4</button>
      </div>
      
      </div>
        <div class="layout text-center bg-light d-flex justify-content-center">
      
      <div class="divsize2">
      <button type="button" class="btn btn-sm btn-success gbutton none btn4" onClick="betbutton('#008000','button','5');">5 </button>
      </div>&emsp;
      
      <div class="divsize2">
      <button type="button" class="btn btn-sm btn-danger gbutton none btn5" onClick="betbutton('#FF0000','button','6');"> 6</button>
      </div>&emsp;
      
      <div class="divsize2">
      <button type="button" class="btn btn-sm btn-success gbutton none btn5" onClick="betbutton('#008000','button','7');">7 </button>
      </div>&emsp;
      <div class="divsize2">
      <button type="button" class="btn btn-sm btn-danger gbutton none btn5" onClick="betbutton('#FF0000','button','8');"> 8</button>
      </div>&emsp;
      <div class="divsize2">
      <button type="button" class="btn btn-sm btn-success gbutton none btn5" onClick="betbutton('#008000','button','9');"> 9</button>
      </div>
      </div>
      </div>
      
      </div>
      </div>
      <!--=====================game area end============================-->
      
      <div class="mt-1 pb-5">
      <div class="tab-content" id="myTabContent">
      <!--=========================tab-1========================================-->
        <div class="tab-pane fade active show" id="parity" role="tabpanel"></div>
       <!--=========================tab-1 end========================================-->
       <!--=========================tab-2========================================-->
        <div class="tab-pane fade" id="sapre" role="tabpanel"></div>
        <!--=========================tab-2 end========================================-->
        <!--=========================tab-3========================================-->
        <div class="tab-pane fade" id="bcone" role="tabpanel"></div>
        <!--=========================tab-3 end========================================-->
        <!--=========================tab-4========================================-->
        <div class="tab-pane fade" id="emerd" role="tabpanel"></div>
        <!--=========================tab-4 end========================================-->
      </div>
      </div>
  </div>
</div>
<!-- appCapsule -->
<?php include("include/footer.php");?>
<div class="box" id="demo">

</div>
<div id="rule" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <h2 style="color:White" class="modal-header1"> Read Carefully</h2>
      <div class="modal-body responsive"> <?php echo content($con,"rule");?> </div>
      <div class="modal-footer"> 
      <a type="button" class="pull-left" data-dismiss="modal"><strong>CLOSE</strong></a> 
      </div>
    </div>
  </div>
</div>

<div id="payment" class="modal fade paymentform" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="modal-header paymentheader" id="paymenttitle"> 
      <h4 class="modal-title" id="chn"></h4>
       </div>
 <form action="#" method="post" id="bettingForm" autocomplete="off">
      <div class="modal-body mt-1" id="loadform">
     <div class="row">
                    <div class="col-12">
                    <center><h3 class="mb-1">Contract Money</h3>
                    
                        <label class="btn btn-secondary active" onClick="contract(10);">
                          <input class="contract" type="radio" name="contract" id="hoursofoperation" value="10" checked >
                           10 </label>
                        <label class="btn btn-secondary" onClick="contract(100);">
                          <input type="radio" class="contract" name="contract" id="hoursofoperation" value="100">
                           100 </label>
                          <label class="btn btn-secondary" onClick="contract(1000);">
                          <input type="radio" class="contract" name="contract" id="hoursofoperation" value="1000">
                           1000 </label>
                         
                      
                      </center>
                      
                   <input type="hidden" id="contractmoney" name="contractmoney" value="10">   
                      
                   <br>
      <div class="def-number-input number-input safari_only">
  <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); addvalue();" class="minus"></button>
  <input class="quantity" min="1" name="amount" id="amount" value="1" type="number" onKeyUp="addvalue();">
  <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); addvalue();" class="plus"></button>
</div>
<input type="hidden" name="userid" id="userid" class="form-control" value="<?php echo $userid;?>">
      <input type="hidden" name="type" id="type" class="form-control" value="<?php echo $type;?>">
    <input type="hidden" name="value" id="value" class="form-control" value="<?php echo $name;?>">
      <input type="hidden" name="counter" id="counter" class="form-control" >
      <input type="hidden" name="inputgameid" id="inputgameid" class="form-control" value="<?php echo sprintf("%03d",gameid($con));?>"> 
      <br>
    <center>  <h6 class="mt-2">Total contract money is <span id="showamount">10</span></h6>
      <input type="hidden" name="finalamount" id="finalamount" value="10">
      <div class="custom-control custom-checkbox mt-2">
    <input type="checkbox" checked class="custom-control-input" id="presalerule" name="presalerule">
  <label class="custom-control-label text-muted" for="presalerule">I agree <a data-toggle="modal" href="#privacy" data-backdrop="static" data-keyboard="false">Presale Management Rule</a></label>
                        </div></center>
                    </div>
                    
                </div>
      </div>
      <input type="hidden" name="tab" id="tab" value="parity">
      <div class="modal-footer"> 
   <a type="button" class="pull-left btn btn-sm closebtn" data-dismiss="modal">CANCEL</a>
<button type="submit" class="pull-left btn btn-sm btn-white">CONFIRM</button> 
      </div>
      </form>
    </div>
  </div>
</div>
<div id="alert" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body" id="alertmessage"> </div>
      <div class="text-right pb-1 pr-2">
    <a type="button" class="text-info" data-dismiss="modal">OK</a>
    </div> 
    </div>
  </div>
</div>
  <div id="loader" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content" style="background:transparent; border:none;">
    <div class="text-center pb-1">
  <a type="button" id="closbtnloader" data-dismiss="modal"> <div class="spinner-grow text-success"></div></a></div>
  
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
<script src="assets/js/betting.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>

 <script>
let btnSend = document.querySelector('button');
let message = document.querySelector('h1');
btnSend.addEventListener('click', () =>{
    btnSend.innerText = 'Please Wait';
    setTimeout(()=>{
        btnSend.style.display = "none";
    },3000);
});
</script>
 
<script>
$(document).ready(function () {
   
var x = setInterval(function() { 
start_count_down(); 
  $('#closbtnloader').click(); 
}, 1e3);
getResultbyCategory('parity','parity');

$('#example').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
});
function start_count_down() { 
$(".showload").hide();
$(".none").show();
var countDownDate = Date.parse(new Date) / 1e3;
  var now = new Date().getTime();
  var distance = 180 - countDownDate % 180;
  //alert(distance);
  var i = distance / 60,
   n = distance % 60,
   o = n / 10,
   s = n % 10;
  var minutes = Math.floor(i);
  var seconds = ('0'+Math.floor(n)).slice(-2);
  document.getElementById("demo").innerHTML = "<span class='timer'>0"+Math.floor(minutes)+"</span>" + "<span>:</span>" +"<span class='timer'>"+seconds+"</span>";
document.getElementById("counter").value = distance;
if(distance==180 || distance==179 || distance==178 || distance==177 || distance==176){
  winnerResult();
generateGameid();
getResultbyCategory('parity','parity');
getResultbyCategory('sapre','sapre');
getResultbyCategory('bcone','bcone');
getResultbyCategory('emerd','emerd');
}
if(distance<=30)
{
$(".gbutton").prop('disabled', true);
}else{ 
$(".gbutton").prop('disabled', false);
	}
if(distance>=177)
{
$(".gbutton2").prop('hidden', true);
$(".gbutton1").prop('hidden', false);
}else{ 
$(".gbutton2").prop('hidden', false);
$(".gbutton1").prop('hidden', true);
	}
}

function generateGameid()
{
	var futureid=$('#futureid').val();
	$.ajax({
    type: "Post",
    data:"futureid=" + futureid + "& type=" + "generate" ,
    url: "periodid-generation.php",
    success: function (html) {
     //alert(html);  
	 var arr = html.split('~');
	 //alert(arr[1]);
	 document.getElementById("gameid").innerHTML=arr[0];
	 document.getElementById("inputgameid").value=arr[0];
	 document.getElementById("futureid").value=arr[0];
      return false;
      },
      error: function (e) {}
      });
	}
	
	function betbutton(color,type,name)
{
	$.ajax({
    type: "Post",
    data:"type=" + type+ "& name=" + name ,
    url: "betform.php",
    success: function (html) {
		
	 document.getElementById("loadform").innerHTML=html;
      return false;
      },
      error: function (e) {}
      });

	if(type=='number'){
	$(".paymentheader").css("background-color", color);
	document.getElementById('chn').innerHTML = 'Select '+name;

		}else{
	$(".paymentheader").css("background-color", color);
	document.getElementById('chn').innerHTML = 'Select '+name;
	}
	$('#payment').modal({backdrop: 'static', keyboard: false})  
     $('#payment').modal('show');
     document.getElementById('type').value = type;
	 document.getElementById('value').value = name;

	}
//=====================amount calculation======================	
function contract(abc){ //alert(abc);
var amount =$("#amount").val();
document.getElementById('contractmoney').value = abc;
var addvalue=abc*amount;
document.getElementById('showamount').innerHTML = addvalue;
document.getElementById('finalamount').value = addvalue;

};	
function addvalue()
{ 
var amount =$("#amount").val();
var contractmoney =$("#contractmoney").val();
var addvalue=contractmoney*amount;
document.getElementById('showamount').innerHTML = addvalue;
document.getElementById('finalamount').value = addvalue;
	}

function tabname(tabname){
document.getElementById('tab').value = tabname;	
	}	

//=====================amount calculation======================
//====================== get Result==============================
function winnerResult() {
  $.ajax({
    type: "Post",
    url: "winnerResult.php",
    success: function() {
     console.log('ok');
    },
    error: function(e) {
      console.log('Error');
    }
  });
}

function getResultbyCategory(category,containerid)
{ 
$.ajax({
    type: "Post",
    data:"category=" + category,
    url: "getResultbyCategory.php",
    success: function (html) {
	 document.getElementById(containerid).innerHTML=html;
	 waitlist('parity',<?php echo $userid;?>,'paritywait');
	 waitlist('sapre',<?php echo $userid;?>,'saprewait');
	 waitlist('bcone',<?php echo $userid;?>,'bconewait');
	 waitlist('emerd',<?php echo $userid;?>,'emerdwait');
	 if(category=='parity'){
	  $('#parityt').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	$('#myrecordparityt').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	 }
	 else if(category=='sapre'){
	  $('#sapret').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	$('#myrecordsapret').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	 }
	 else if(category=='bcone'){
	  $('#bconet').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	$('#myrecordbconet').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	 }
	 else if(category=='emerd'){
	  $('#emerdt').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	$('#myrecordemerdt').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
	 }
      return false;
      },
      error: function (e) {}
      });
	 
	}

$(document).ready(function () {
	waitlist('parity',<?php echo $userid;?>,'paritywait');
});

function reloadbtn(id){
 $('#loader').modal({backdrop: 'static', keyboard: false})  
 $('#loader').modal('show');

$.ajax({
    type: "Post",
    data:"userid=" + id,
    url: "getwalletbalance.php",
    success: function (html) {
        console.log(html);
	 
			document.getElementById('balance').innerHTML =html;
      return false;
      },
      error: function (e) {}
      });
	
	}

</script>


</body>
</html>