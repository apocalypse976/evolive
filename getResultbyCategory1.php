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
$userid=$_SESSION['frontuserid'];
$today=date('Y-m-d');
if($category=='parity')
{?>
      
       
       
      
        <div class="table-container" id="paritycontainer">
        <table class="table table-borderless table-hover text-center" id="parityt">
        <thead>
        <tr>
        <th>Period</th>
        <th>Price</th>
        <th>Number</th>
        <th>Result</th>
        </tr>
        </thead>
        <tbody>
        <?php
 $parityrecordQuery=mysqli_query($con,"select * from `tbl_result` where `tabtype`='parity' order by id desc limit 3360");
 $parityrecordRow=mysqli_num_rows($parityrecordQuery);
 if($parityrecordRow==''){?>
 <tr>
        <td colspan="4">
        <div style="display: flex;">
        <div class="spacer"></div>
        <div>No data available !</div>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php 
		}else{
		while($parityResult=mysqli_fetch_array($parityrecordQuery)){
			if($parityResult['resulttype']=='real'){
			?>
        <tr>
        <td><?php echo $parityResult['periodid'];?></td>
        <td><?php if($parityResult["result"]=='1'){echo"31981";}elseif($parityResult["result"]=='2'){echo"30892";}elseif($parityResult["result"]=='3'){echo"31563";}elseif($parityResult["result"]=='4'){echo"31244";}elseif($parityResult["result"]=='5'){echo"31565";}elseif($parityResult["result"]=='6'){echo"31766";}elseif($parityResult["result"]=='7'){echo"30257";}elseif($parityResult["result"]=='8'){echo"30898";}elseif($parityResult["result"]=='9'){echo"31569";}elseif($parityResult["result"]=='0'){echo"31760";}?></td>
        <td><span style="color:<?php if($parityResult['color']=='green'){echo"#1DCC70";}else if($parityResult['color']=='red'){echo"#ff2d55";}else if($parityResult['color']=='red+violet'){echo"#ff2d55";}else if($parityResult['color']=='green+violet'){echo"#1DCC70";}?>;"><?php echo $parityResult['result'];?></span></td>
        <td>
        <div style="display: flex;">
       
        <?php if($parityResult['color']=='green'){ ?>
        <div class="point green" style="background:#1DCC70;"></div>
        <?php }else if($parityResult['color']=='red'){?>
        <div class="point red" style="background:#ff2d55;"></div>
        <?php }else if($parityResult['color']=='red+violet'){?>
         <div class="point" style="background:#ff2d55;"></div>&nbsp;
        <div class="point" style="background:#9c27b0;"></div>
 <?php }else if($parityResult['color']=='green+violet'){?>
 <div class="point" style="background:#1DCC70;"></div>&nbsp;
         <div class="point" style="background:#9c27b0;"></div>
        <?php }?>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php }else if($parityResult['resulttype']=='random'){?>
        <tr>
        <td><?php echo $parityResult['periodid'];?></td>
        <td><?php echo $parityResult['randomprice'];?></td>
        <td><span style="color:<?php if($parityResult['randomcolor']=='green'){echo"#1DCC70";}else if($parityResult['randomcolor']=='red'){echo"#ff2d55";}else if($parityResult['randomcolor']=='red++violet'){echo"#ff2d55";}else if($parityResult['randomcolor']=='green++violet'){echo"#1DCC70";}?>;"><?php echo $parityResult['randomresult'];?></span></td>
        <td>
        <div style="display: flex;">
        
        <?php if($parityResult['randomcolor']=='green'){ ?>
        <div class="point green" style="background:#1DCC70;"></div>
        <?php }else if($parityResult['randomcolor']=='red'){?>
        <div class="point red" style="background:#ff2d55;"></div>
        <?php }else if($parityResult['randomcolor']=='red++violet'){?>
         <div class="point" style="background:#ff2d55;"></div>&nbsp;
        <div class="point" style="background:#9c27b0;"></div>
 <?php }else if($parityResult['randomcolor']=='green++violet'){?>
 <div class="point" style="background:#1DCC70;"></div>&nbsp;
         <div class="point" style="background:#9c27b0;"></div>
        <?php }?>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php }?>
        <?php }}?>
         </tbody>
          </table>
        </div>
       
	
<?php }
else if($category=='sapre')
{?>
	    <div class="containerrecord text-center">
        <a href="gamedashboard.php" class="recordlink">
   
    </a>
        </div>
        <div class="table-container">
        <table class="table table-borderless table-hover text-center" id="sapret">
        <thead>
        <tr>
        <th>Period</th>
        <th>Price</th>
        <th>Number</th>
        <th>Result</th>
        </tr>
        </thead>
        <tbody>
        <?php
 $saprerecordQuery=mysqli_query($con,"select * from `tbl_result` where `tabtype`='sapre' order by id desc limit 3360");
 $saprerecordRow=mysqli_num_rows($saprerecordQuery);
 if($saprerecordRow==''){?>
 <tr>
        <td colspan="4">
        <div style="display: flex;">
        <div class="spacer"></div>
        <div>No data available !</div>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php 
		}else{
		while($sapreResult=mysqli_fetch_array($saprerecordQuery)){
			if($sapreResult['resulttype']=='real'){
			?>
        <tr>
        <td><?php echo $sapreResult['periodid'];?></td>
      <td><?php if($parityResult["result"]=='1'){echo"31981";}elseif($parityResult["result"]=='2'){echo"30892";}elseif($parityResult["result"]=='3'){echo"31563";}elseif($parityResult["result"]=='4'){echo"31244";}elseif($parityResult["result"]=='5'){echo"31565";}elseif($parityResult["result"]=='6'){echo"31766";}elseif($parityResult["result"]=='7'){echo"30257";}elseif($parityResult["result"]=='8'){echo"30898";}elseif($parityResult["result"]=='9'){echo"31569";}elseif($parityResult["result"]=='0'){echo"31760";}?></td>
        <td><span style="color:<?php if($sapreResult['color']=='green'){echo"#1DCC70";}else if($sapreResult['color']=='red'){echo"#ff2d55";}else if($sapreResult['color']=='red+violet'){echo"#ff2d55";}else if($sapreResult['color']=='green+violet'){echo"#1DCC70";}?>;"><?php echo $sapreResult['result'];?></span></td>
        <td>
        <div style="display: flex;">
     
        <?php if($sapreResult['color']=='green'){ ?>
        <div class="point green" style="background:#1DCC70;"></div>
        <?php }else if($sapreResult['color']=='red'){?>
        <div class="point red" style="background:#ff2d55;"></div>
        <?php }else if($sapreResult['color']=='red+violet'){?>
         <div class="point" style="background:#ff2d55;"></div>&nbsp;
        <div class="point" style="background:#9c27b0;"></div>
 <?php }else if($sapreResult['color']=='green+violet'){?>
 <div class="point" style="background:#1DCC70;"></div>&nbsp;
         <div class="point" style="background:#9c27b0;"></div>
        <?php }?>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php }else if($sapreResult['resulttype']=='random'){?>
        <tr>
        <td><?php echo $sapreResult['periodid'];?></td>
        <td><?php echo $sapreResult['randomprice'];?></td>
        <td><span style="color:<?php if($sapreResult['randomcolor']=='green'){echo"#1DCC70";}else if($sapreResult['randomcolor']=='red'){echo"#ff2d55";}else if($sapreResult['randomcolor']=='red++violet'){echo"#ff2d55";}else if($sapreResult['randomcolor']=='green++violet'){echo"#1DCC70";}?>;"><?php echo $sapreResult['randomresult'];?></span></td>
        <td>
        <div style="display: flex;">
        
        <?php if($sapreResult['randomcolor']=='green'){ ?>
        <div class="point green" style="background:#1DCC70;"></div>
        <?php }else if($sapreResult['randomcolor']=='red'){?>
        <div class="point red" style="background:#ff2d55;"></div>
        <?php }else if($sapreResult['randomcolor']=='red++violet'){?>
         <div class="point" style="background:#ff2d55;"></div>&nbsp;
        <div class="point" style="background:#9c27b0;"></div>
 <?php }else if($sapreResult['randomcolor']=='green++violet'){?>
 <div class="point" style="background:#1DCC70;"></div>&nbsp;
         <div class="point" style="background:#9c27b0;"></div>
        <?php }?>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php }?>
        <?php }}?>
         </tbody>
          </table>
        </div>
       
<?php	
}else if($category=='bcone')
{
?>
<div class="containerrecord text-center">
        <a href="gamedashboard.php" class="recordlink">
   
    </a>
        </div>        
        <div class="table-container">
        <table class="table table-borderless table-hover text-center" id="bconet">
        <thead>
        <tr>
        <th>Period</th>
        <th>Price</th>
        <th>Number</th>
        <th>Result</th>
        </tr>
        </thead>
        <tbody>
        <?php
 $bconerecordQuery=mysqli_query($con,"select * from `tbl_result` where `tabtype`='bcone' order by id desc limit 3360");
 $bconerecordRow=mysqli_num_rows($bconerecordQuery);
 if($bconerecordRow==''){?>
 <tr>
        <td colspan="4">
        <div style="display: flex;">
        <div class="spacer"></div>
        <div>No data available !</div>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php 
		}else{
		while($bconeResult=mysqli_fetch_array($bconerecordQuery)){
			if($bconeResult['resulttype']=='real'){
			?>
        <tr>
        <td><?php echo $bconeResult['periodid'];?></td>
        <td><?php if($parityResult["result"]=='1'){echo"31981";}elseif($parityResult["result"]=='2'){echo"30892";}elseif($parityResult["result"]=='3'){echo"31563";}elseif($parityResult["result"]=='4'){echo"31244";}elseif($parityResult["result"]=='5'){echo"31565";}elseif($parityResult["result"]=='6'){echo"31766";}elseif($parityResult["result"]=='7'){echo"30257";}elseif($parityResult["result"]=='8'){echo"30898";}elseif($parityResult["result"]=='9'){echo"31569";}elseif($parityResult["result"]=='0'){echo"31760";}?></td>
        <td><span style="color:<?php if($bconeResult['color']=='green'){echo"#1DCC70";}else if($bconeResult['color']=='red'){echo"#ff2d55";}else if($bconeResult['color']=='red+violet'){echo"#ff2d55";}else if($bconeResult['color']=='green+violet'){echo"#1DCC70";}?>;"><?php echo $bconeResult['result'];?></span></td>
        <td>
        <div style="display: flex;">
        
        <?php if($bconeResult['color']=='green'){ ?>
        <div class="point green" style="background:#1DCC70;"></div>
        <?php }else if($bconeResult['color']=='red'){?>
        <div class="point red" style="background:#ff2d55;"></div>
        <?php }else if($bconeResult['color']=='red+violet'){?>
         <div class="point" style="background:#ff2d55;"></div>&nbsp;
        <div class="point" style="background:#9c27b0;"></div>
 <?php }else if($bconeResult['color']=='green+violet'){?>
 <div class="point" style="background:#1DCC70;"></div>&nbsp;
         <div class="point" style="background:#9c27b0;"></div>
        <?php }?>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php }else if($bconeResult['resulttype']=='random'){?>
        <tr>
        <td><?php echo $bconeResult['periodid'];?></td>
        <td><?php echo $bconeResult['randomprice'];?></td>
        <td><span style="color:<?php if($bconeResult['randomcolor']=='green'){echo"#1DCC70";}else if($bconeResult['randomcolor']=='red'){echo"#ff2d55";}else if($bconeResult['randomcolor']=='red++violet'){echo"#ff2d55";}else if($bconeResult['randomcolor']=='green++violet'){echo"#1DCC70";}?>;"><?php echo $bconeResult['randomresult'];?></span></td>
        <td>
        <div style="display: flex;">
      
        <?php if($bconeResult['randomcolor']=='green'){ ?>
        <div class="point green" style="background:#1DCC70;"></div>
        <?php }else if($bconeResult['randomcolor']=='red'){?>
        <div class="point red" style="background:#ff2d55;"></div>
        <?php }else if($bconeResult['randomcolor']=='red++violet'){?>
         <div class="point" style="background:#ff2d55;"></div>&nbsp;
        <div class="point" style="background:#9c27b0;"></div>
 <?php }else if($bconeResult['randomcolor']=='green++violet'){?>
 <div class="point" style="background:#1DCC70;"></div>&nbsp;
         <div class="point" style="background:#9c27b0;"></div>
        <?php }?>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php }?>
        <?php }}?>
         </tbody>
          </table>
        </div>
       

<?php
 }else if($category=='emerd')
 {
 ?>
         <div class="containerrecord text-center">
        <a href="gamedashboard.php" class="recordlink">
  
    </a>
        </div>
        <div class="table-container">
        <table class="table table-borderless table-hover text-center" id="emerdt">
        <thead>
        <tr>
        <th>Period</th>
        <th>Price</th>
        <th>Number</th>
        <th>Result</th>
        </tr>
        </thead>
        <tbody>
        <?php
 $emerdrecordQuery=mysqli_query($con,"select * from `tbl_result` where `tabtype`='emerd' order by id desc limit 3360");
 $emerdrecordRow=mysqli_num_rows($emerdrecordQuery);
 if($emerdrecordRow==''){?>
 <tr>
        <td colspan="4">
        <div style="display: flex;">
        <div class="spacer"></div>
        <div>No data available !</div>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php 
		}else{
		while($emerdResult=mysqli_fetch_array($emerdrecordQuery)){
			if($emerdResult['resulttype']=='real'){
			?>
        <tr>
        <td><?php echo $emerdResult['periodid'];?></td>
        <td><?php if($parityResult["result"]=='1'){echo"31981";}elseif($parityResult["result"]=='2'){echo"30892";}elseif($parityResult["result"]=='3'){echo"31563";}elseif($parityResult["result"]=='4'){echo"31244";}elseif($parityResult["result"]=='5'){echo"31565";}elseif($parityResult["result"]=='6'){echo"31766";}elseif($parityResult["result"]=='7'){echo"30257";}elseif($parityResult["result"]=='8'){echo"30898";}elseif($parityResult["result"]=='9'){echo"31569";}elseif($parityResult["result"]=='0'){echo"31760";}?></td>
        <td><span style="color:<?php if($emerdResult['color']=='green'){echo"#1DCC70";}else if($emerdResult['color']=='red'){echo"#ff2d55";}else if($emerdResult['color']=='red+violet'){echo"#ff2d55";}else if($emerdResult['color']=='green+violet'){echo"#1DCC70";}?>;"><?php echo $emerdResult['result'];?></span></td>
        <td>
        <div style="display: flex;">
       
        <?php if($emerdResult['color']=='green'){ ?>
        <div class="point green" style="background:#1DCC70;"></div>
        <?php }else if($emerdResult['color']=='red'){?>
        <div class="point red" style="background:#ff2d55;"></div>
        <?php }else if($emerdResult['color']=='red+violet'){?>
         <div class="point" style="background:#ff2d55;"></div>&nbsp;
        <div class="point" style="background:#9c27b0;"></div>
 <?php }else if($emerdResult['color']=='green+violet'){?>
 <div class="point" style="background:#1DCC70;"></div>&nbsp;
         <div class="point" style="background:#9c27b0;"></div>
        <?php }?>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php }else if($emerdResult['resulttype']=='random'){?>
        <tr>
        <td><?php echo $emerdResult['periodid'];?></td>
        <td><?php echo $emerdResult['randomprice'];?></td>
        <td><span style="color:<?php if($emerdResult['randomcolor']=='green'){echo"#1DCC70";}else if($emerdResult['randomcolor']=='red'){echo"#ff2d55";}else if($emerdResult['randomcolor']=='red++violet'){echo"#ff2d55";}else if($emerdResult['randomcolor']=='green++violet'){echo"#1DCC70";}?>;"><?php echo $emerdResult['randomresult'];?></span></td>
        <td>
        <div style="display: flex;">
    
        <?php if($emerdResult['randomcolor']=='green'){ ?>
        <div class="point green" style="background:#1DCC70;"></div>
        <?php }else if($emerdResult['randomcolor']=='red'){?>
        <div class="point red" style="background:#ff2d55;"></div>
        <?php }else if($emerdResult['randomcolor']=='red++violet'){?>
         <div class="point" style="background:#ff2d55;"></div>&nbsp;
        <div class="point" style="background:#9c27b0;"></div>
 <?php }else if($emerdResult['randomcolor']=='green++violet'){?>
 <div class="point" style="background:#1DCC70;"></div>&nbsp;
         <div class="point" style="background:#9c27b0;"></div>
        <?php }?>
        <div class="spacer"></div>
        </div>
        </td>
        </tr>
        <?php }?>
        <?php }}?>
         </tbody>
          </table>
        </div>
        <div class="containerrecord text-center mt-1">
        <a href="#" class="recordlink">
    <p> <div class="title">My Bcone Record</div> </p>
    </a>
        </div>


 <?php }?>