<?php 
ob_start();
session_start();
if($_SESSION['AuthUser']['username'] =="")
//if($_SESSION['frontuserid']=="")
{
	header("location:index.php");exit();
}
include("include/connection.php");
$userid=$_SESSION['AuthUser']['userid'];
//$userid=$_SESSION['frontuserid'];
$type=$_POST['type'];
$name=$_POST['name'];
?>
<?php
if($name=="Red")
{
$num= [0,2,4,6,8];
}
elseif($name=="Green"){ 
  $num= [1,3,5,7,9];
}
else{
  $num= [0,5];
}

?>
<div class="row">
                    <div class="col-12">
                    <center><h3 class="mb-1">Contract Money</h3>
                    
                        <label class="btn btn-secondary" onClick="contract(10);">
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
      <input type="hidden" name="placedValue" id="placedValue" class="form-control" value="<?php echo print_r($num);?>"> 
      <br>
    <center>  <h6 class="mt-2">Total contract money is <span id="showamount">10</span></h6>
      <input type="hidden" name="finalamount" id="finalamount" value="10">
      <div class="custom-control custom-checkbox mt-2">
    <input type="checkbox" checked class="custom-control-input" id="presalerule" name="presalerule">
  <label class="custom-control-label text-muted" for="presalerule">I agree <a data-toggle="modal" href="#privacy" data-backdrop="static" data-keyboard="false">Presale Management Rule</a></label>
                        </div></center>
                    </div>
                    
                </div>