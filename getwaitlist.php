<?php
ob_start();
session_start();
if($_SESSION['AuthUser']['username'] =="")
//if($_SESSION['frontuserid']=="")
{
	header("location:index.php");exit();
}
include("include/connection.php");
$category=$_POST['category'];
$userid=$_SESSION['AuthUser']['username'];
$periodid=$_POST['periodid'];
$today=date('Y-m-d');
if($category=='')
{?>
        
        <div class="table-container">
        <table class="table table-borderless">
        <thead><tr><th></th></tr></thead>    
    <tbody>
     <?php
  $userWaitQuery=mysqli_query($con,"select * from `tbl_betting` where `userid`='".$userid."' and `tab`='".$category."' and `periodid`='".$periodid."' order by id desc limit 480");
  while($userResult=mysqli_fetch_array($userWaitQuery)){
	  $post_date1 = $userResult['createdate'];
 $post_date21 = strtotime($post_date1);
  $convert3=date('h:i A',$post_date21);
 $convert4=date('d-m-Y',$post_date21);

	?><tr>
            <td class="pl-3" style="border:1px;">
       	<div class="vcard1">
	    
	      <div class="row">
        <div class="column"  style="display: flex;">
        <strong class="point2">Contract Money</strong>
        <strong class="point2" style="color:#5C6BF3;"> ₹<?php echo number_format($userResult['amount']);?><br>Wait
        </strong></div>

         <div class="mt-1" style="display: flex;">
        <div class="point2">Create Time</div>
        <div class="point2"><?php echo $convert3;?><br><?php echo $convert4;?></div>
        </div>
      
     <br>
     <br>
    </div>
     <div class="row">
         <div class="column gap">
         <br>
         <div class="mt-1" style="display: flex;">
        <div class="point2">Period ID</div>
        <div class="point2"><?php echo ($userResult['periodid']);?></div>
        </div>
         <div class="mt-1" style="display: flex;">
        <div class="point2">Status</div>
        <div class="point2" style="color:#5C6BF3;">Wait...</div>
        </div>
        <div class="mt-1" style="display: flex;">
        <div class="point2">Result</div>
        <div class="point2" style="color:#5C6BF3;">Wait...</div>
        </div><div class="mt-1" style="display: flex;">
        <div class="point2">Amount</div>
       <div class="point2"><?php echo number_format($userResult['amount'],2);?></div>
         </div>
          </div> 
    
      
       
        
       <!--   --> <div class="column gap">
           <br>
      
    <div class="mt-1" style="display: flex;">
        <div class="point2">Select</div> 
        <div class="point2" style="color:<?php if($userResult['value']=='Green'){echo"#1DCC70";}elseif($userResult['value']=='Red'){echo"#ff2d55";}else{echo"#3D67B3";}?>;"><?php echo $userResult['value'];?></div>
        </div>
         <div class="mt-1" style="display: flex;">
        <div class="point2">Delivery</div>
        <?php $x=$userResult['amount']*2/100;?>
        <div class="point2" ><?php echo number_format($userResult['amount']-$x,2);?></div>
        </div>
        <div class="mt-1" style="display: flex;">
        <div class="point2">Fee</div>
        <div class="point2"><?php echo number_format($x,2);?></div>
        </div>
       
         <div class="mt-1" style="display: flex;">
        <div class="point2">Open Price</div>
               <div class="point2" style="color:#5C6BF3;">Wait...</div>
        </div>
                </div></div>
         </div>  <hr> </td>
        </tr>
        <?php }?>
    
    </tbody>
</table>
        </div>
        
	
<?php }?>