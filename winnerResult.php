<?php 
ob_start();
session_start();
include("userResult.php");
// $id= $_POST['gameid'];
// echo $id;
// $getperiod_Query=mysqli_query($con,"select * from `tbl_gameid` order by id desc limit 1");
// $getperiodRow=mysqli_num_rows($getperiod_Query);
// $getperiodidRow=mysqli_fetch_array($getperiod_Query);

$periodid= $_POST['gameid'];
$finalammount= $_POST['finalamount'];
$type1='parity';
// $type2='sapre';
// $type3='bcone';
// $type4='emerd';
$today=date('Y-m-d H:i:s');
//======================manual result==========================================================
$chkmanualswitchQuery=mysqli_query($con,"select * from `tbl_manualresultswitch` where `id`='1'");
$switchResult=mysqli_fetch_array($chkmanualswitchQuery);
$switchstatus=$switchResult['switch'];
$switchtab=$switchResult['tab'];

$manualresultQuery=mysqli_query($con,"select `id`,(`value`)as color,`number` from `tbl_manualresult` where `status`='1'");
$manualResult=mysqli_fetch_array($manualresultQuery);
$manualid=$manualResult['id'];
$manualcolor=$manualResult['color'];
$manualnumber=$manualResult['number'];
//=======================manual result end=====================================================
//----------------------------------------High Low Start----------------------------------------
$settingQuery=mysqli_query($con,"select * from `tbl_gamesettings` where `id`='1'");
$settingResult=mysqli_fetch_array($settingQuery);
$settingstatus=$settingResult['settingtype'];

//------------------------------------High low End----------------------------------------------


$chkResult=mysqli_query($con,"select * from `tbl_result` where `periodid`='".$periodid."'");
$chkResultRow=mysqli_num_rows($chkResult);
if($chkResultRow!=''){


$selectData=mysqli_query($con,"select * from `tbl_betting` where `periodid`='".$periodid."' and `acceptrule`='on'");
$selectdataRow=mysqli_num_rows($selectData);
if($selectdataRow!='')
{
if($type1=='parity')
{
$chkparityQuery=mysqli_query($con,"select * from `tbl_betting` where `periodid`='".$periodid."' and `tab`='parity'");
$chkparityRow=mysqli_num_rows($chkparityQuery);
if($chkparityRow!=''){
//=========possibility for green type parity

for ($x = 0; $x <= 9; $x++) {
	
if($x==1||$x==3||$x==7||$x==9)	
{//======for green
$color='green';
$greentotal=winner($con,$periodid,$type1,'greenwinamount');
if($settingResult['settingtype']=='high'){
$total=$greentotal+winner($con,$periodid,$type1,$numbermappings[$x].'winamount');
}else if($settingResult['settingtype']=='low'){
$tradeamount=winner($con,$periodid,$type1,'tradeamount');
$att=$greentotal+winner($con,$periodid,$type1,$numbermappings[$x].'winamount');
$total=$tradeamount-$att;
}
}else if($x==2||$x==4||$x==6||$x==8)	
{
$color='red';
$redtotal=winner($con,$periodid,$type1,'redwinamount');
if($settingResult['settingtype']=='high'){
$total=$redtotal+winner($con,$periodid,$type1,$numbermappings[$x].'winamount');
}else if($settingResult['settingtype']=='low'){
$tradeamount=winner($con,$periodid,$type1,'tradeamount');
$att=$redtotal+winner($con,$periodid,$type1,$numbermappings[$x].'winamount');
$total=$tradeamount-$att;
}
	}	
else if($x==0)

{
$color='red+violet';
$redtotal=winner($con,$periodid,$type1,'redwinamountwithviolet');
$vtotal=winner($con,$periodid,$type1,'violetwinamount');
if($settingResult['settingtype']=='high'){
$total=$redtotal+$vtotal+winner($con,$periodid,$type1,$numbermappings[$x].'winamount');
}else if($settingResult['settingtype']=='low'){
$tradeamount=winner($con,$periodid,$type1,'tradeamount');
$att=$redtotal+$vtotal+winner($con,$periodid,$type1,$numbermappings[$x].'winamount');
$total=$tradeamount-$att;
}
	}	
	
else if($x==5)

{
$color='green+violet';
$redtotal=winner($con,$periodid,$type1,'greenwinamountwithviolet');
$vtotal=winner($con,$periodid,$type1,'violetwinamount');
if($settingResult['settingtype']=='high'){
$total=$redtotal+$vtotal+winner($con,$periodid,$type1,$numbermappings[$x].'winamount');
}else if($settingResult['settingtype']=='low'){
$tradeamount=winner($con,$periodid,$type1,'tradeamount');
$att=$redtotal+$vtotal+winner($con,$periodid,$type1,$numbermappings[$x].'winamount');
$total=$tradeamount-$att;
}
	
	}	
$sql= mysqli_query($con,"INSERT INTO `tbl_tempwinner`(`periodid`,`number`,`color`,`total`, `type`) VALUES ('".$periodid."','".$x."','".$color."','".$total."','".$type1."')");	
}

//========final Result===================================================
if($switchstatus=='yes' && $switchtab=='parity')
{
$tempwinQuery=mysqli_query($con,"select `number`,`color`,`total` from `tbl_tempwinner` where `periodid`='".$periodid."' and `number`='".$manualnumber."' and `color`='".$manualcolor."' and `type`='parity'");
	}

else{
$tempwinQuery=mysqli_query($con,"SELECT `number`,`color`,`total` from `tbl_tempwinner` where `total` = (
select min(`total`)from `tbl_tempwinner` where `total`>=0)and `periodid`='".$periodid."' and `type`='parity' limit 1");
}
$tempwinResult=mysqli_fetch_array($tempwinQuery);
$tempNumber=$tempwinResult['number'];
$tempColor=$tempwinResult['color'];
$tempTotal=$tempwinResult['total'];
//=================random data=======================================
$randomwinQuery=mysqli_query($con,"select * from `tbl_randomdata` order by RAND() LIMIT 1;");
$randomwinResult=mysqli_fetch_array($randomwinQuery);
$randomPrice=$randomwinResult['price'];
$randomNumber=$randomwinResult['result'];
$randomColor=$randomwinResult['color'];
//=================random data end====================================
// $ResultQuery= mysqli_query($con,"INSERT INTO `tbl_result`(`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`,`createdate`) VALUES ('".$periodid."','".$tempTotal."','".$randomPrice."','".$tempNumber."','".$randomNumber."','".$tempColor."','".$randomColor."','real','".$type1."','".$today."')");	
// Assuming $con is your MySQLi connection
// Check if $periodid already exists in the table
$checkQuery = "SELECT COUNT(*) FROM `tbl_result` WHERE `periodid` = ?";
$checkStmt = $con->prepare($checkQuery);
$checkStmt->bind_param("s", $periodid);
$checkStmt->execute();
$checkStmt->bind_result($count);
$checkStmt->fetch();
$checkStmt->close();

if ($count == 0) { // If $periodid does not exist, proceed with insertion
    // Prepare the INSERT statement
    $stmt = $con->prepare("INSERT INTO `tbl_result` (`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`, `createdate`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters to the statement
    $stmt->bind_param("ssssssssss", $periodid, $tempTotal, $randomPrice, $tempNumber, $randomNumber, $tempColor, $randomColor, $resultType, $type1, $today);

    // Assign the values
    $resultType = 'real';

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Record inserted successfully";
        echo "<br>";
        echo($periodid);
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the insert statement
    $stmt->close();
} else {
    echo "Record with periodid $periodid already exists. Insertion skipped.";
}

// Close the statement


//========final Result end===============================================
//============user Result===========================================================
resultbyUser($con,$periodid,$tempNumber,$tempColor,$randomPrice,$type1);

}//==========chk parity===================
else{
//=================random data=======================================
$randomwinQuery=mysqli_query($con,"select * from `tbl_randomdata` order by RAND() LIMIT 1;");
$randomwinResult=mysqli_fetch_array($randomwinQuery);
$randomPrice=$randomwinResult['price'];
$randomNumber=$randomwinResult['result'];
$randomColor=strtolower($randomwinResult['color']);
$heading_new=str_replace("&","",$randomColor);
$newcolor=str_replace(" ","+",$heading_new);
//=================random data end====================================

$ResultQuery= mysqli_query($con,"INSERT INTO `tbl_result`(`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`,`createdate`) VALUES ('".$periodid."','0','".$randomPrice."','0','".$randomNumber."','','".$newcolor."','random','".$type1."','".$today."')");	
//========final Result end===============================================	
	}
}//====parity end

// if($type2=='sapre')
// {
// $chkparityQuery=mysqli_query($con,"select * from `tbl_betting` where `periodid`='".$periodid."' and `tab`='sapre'");
// $chkparityRow=mysqli_num_rows($chkparityQuery);
// if($chkparityRow!=''){
// //=========possibility for green type parity
// for ($x = 0; $x <= 9; $x++) {
	
// if($x==1||$x==3||$x==7||$x==9)	
// {//======for green
// $color='green';
// $greentotal=winner($con,$periodid,$type2,'greenwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$greentotal+winner($con,$periodid,$type2,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type2,'tradeamount');
// $att=$greentotal+winner($con,$periodid,$type2,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// }else if($x==2||$x==4||$x==6||$x==8)	
// {
// $color='red';
// $redtotal=winner($con,$periodid,$type2,'redwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$redtotal+winner($con,$periodid,$type2,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type2,'tradeamount');
// $att=$redtotal+winner($con,$periodid,$type2,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// 	}	
// else if($x==0)

// {
// $color='red+violet';
// $redtotal=winner($con,$periodid,$type2,'redwinamountwithviolet');
// $vtotal=winner($con,$periodid,$type2,'violetwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$redtotal+$vtotal+winner($con,$periodid,$type2,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type2,'tradeamount');
// $att=$redtotal+$vtotal+winner($con,$periodid,$type2,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// 	}	
	
// else if($x==5)

// {
// $color='green+violet';
// $redtotal=winner($con,$periodid,$type2,'greenwinamountwithviolet');
// $vtotal=winner($con,$periodid,$type2,'violetwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$redtotal+$vtotal+winner($con,$periodid,$type2,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type2,'tradeamount');
// $att=$redtotal+$vtotal+winner($con,$periodid,$type2,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
	
// 	}	
// $sql= mysqli_query($con,"INSERT INTO `tbl_tempwinner`(`periodid`,`number`,`color`,`total`, `type`) VALUES ('".$periodid."','".$x."','".$color."','".$total."','".$type2."')");	
// }
// //========final Result===================================================
// if($switchstatus=='yes' && $switchtab=='sapre')
// {
// $tempwinQuery=mysqli_query($con,"select `number`,`color`,`total` from `tbl_tempwinner` where `periodid`='".$periodid."' and `number`='".$manualnumber."' and `color`='".$manualcolor."' and `type`='sapre'");
// 	}
// else{
// $tempwinQuery=mysqli_query($con,"SELECT `number`,`color`,`total` from `tbl_tempwinner` where `total` = (
// select min(`total`)from `tbl_tempwinner` where `total`>=0)and `periodid`='".$periodid."' and `type`='sapre' limit 1");
// }
// $tempwinResult=mysqli_fetch_array($tempwinQuery);
// $tempNumber=$tempwinResult['number'];
// $tempColor=$tempwinResult['color'];
// $tempTotal=$tempwinResult['total'];
// //=================random data=======================================
// $randomwinQuery=mysqli_query($con,"select * from `tbl_randomdata` order by RAND() LIMIT 1;");
// $randomwinResult=mysqli_fetch_array($randomwinQuery);
// $randomPrice=$randomwinResult['price'];
// $randomNumber=$randomwinResult['result'];
// $randomColor=$randomwinResult['color'];
// //=================random data end====================================

// $ResultQuery= mysqli_query($con,"INSERT INTO `tbl_result`(`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`,`createdate`) VALUES ('".$periodid."','".$tempTotal."','".$randomPrice."','".$tempNumber."','".$randomNumber."','".$tempColor."','".$randomColor."','real','".$type2."','".$today."')");	

// //========final Result end===============================================	
// //============user Result===========================================================
// resultbyUser($con,$periodid,$tempNumber,$tempColor,$randomPrice,$type2);


// }//==========chk sapre===================
// else{
// //=================random data=======================================
// $randomwinQuery=mysqli_query($con,"select * from `tbl_randomdata` order by RAND() LIMIT 1;");
// $randomwinResult=mysqli_fetch_array($randomwinQuery);
// $randomPrice=$randomwinResult['price'];
// $randomNumber=$randomwinResult['result'];
// $randomColor=strtolower($randomwinResult['color']);
// $heading_new=str_replace("&","",$randomColor);
// $newcolor=str_replace(" ","+",$heading_new);
// //=================random data end====================================

// $ResultQuery= mysqli_query($con,"INSERT INTO `tbl_result`(`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`,`createdate`) VALUES ('".$periodid."','0','".$randomPrice."','0','".$randomNumber."','','".$newcolor."','random','".$type2."','".$today."')");	

// //========final Result end===============================================	
// 	}
// }//=====================================sapre end======================================	

// if($type3=='bcone')
// {
// $chkparityQuery=mysqli_query($con,"select * from `tbl_betting` where `periodid`='".$periodid."' and `tab`='bcone'");
// $chkparityRow=mysqli_num_rows($chkparityQuery);
// if($chkparityRow!=''){
// //=========possibility for green type parity
// for ($x = 0; $x <= 9; $x++) {
	
// if($x==1||$x==3||$x==7||$x==9)	
// {//======for green
// $color='green';
// $greentotal=winner($con,$periodid,$type3,'greenwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$greentotal+winner($con,$periodid,$type3,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type3,'tradeamount');
// $att=$greentotal+winner($con,$periodid,$type3,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// }else if($x==2||$x==4||$x==6||$x==8)	
// {
// $color='red';
// $redtotal=winner($con,$periodid,$type3,'redwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$redtotal+winner($con,$periodid,$type3,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type3,'tradeamount');
// $att=$redtotal+winner($con,$periodid,$type3,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// 	}	
// else if($x==0)

// {
// $color='red+violet';
// $redtotal=winner($con,$periodid,$type3,'redwinamountwithviolet');
// $vtotal=winner($con,$periodid,$type3,'violetwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$redtotal+$vtotal+winner($con,$periodid,$type3,$numbermappings[$x].'winamount');	
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type3,'tradeamount');
// $att=$redtotal+$vtotal+winner($con,$periodid,$type3,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// 	}	
	
// else if($x==5)

// {
// $color='green+violet';
// $redtotal=winner($con,$periodid,$type3,'greenwinamountwithviolet');
// $vtotal=winner($con,$periodid,$type3,'violetwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$redtotal+$vtotal+winner($con,$periodid,$type3,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type3,'tradeamount');
// $att=$redtotal+$vtotal+winner($con,$periodid,$type3,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
	
// 	}	
// $sql= mysqli_query($con,"INSERT INTO `tbl_tempwinner`(`periodid`,`number`,`color`,`total`, `type`) VALUES ('".$periodid."','".$x."','".$color."','".$total."','".$type3."')");	
// }
// //========final Result===================================================
// if($switchstatus=='yes' && $switchtab=='bcone')
// {
// $tempwinQuery=mysqli_query($con,"select `number`,`color`,`total` from `tbl_tempwinner` where `periodid`='".$periodid."' and `number`='".$manualnumber."' and `color`='".$manualcolor."' and `type`='bcone'");
// 	}
// else{
// $tempwinQuery=mysqli_query($con,"SELECT `number`,`color`,`total` from `tbl_tempwinner` where `total` = (
// select min(`total`)from `tbl_tempwinner` where `total`>=0)and `periodid`='".$periodid."' and `type`='bcone' limit 1");
// }
// $tempwinResult=mysqli_fetch_array($tempwinQuery);
// $tempNumber=$tempwinResult['number'];
// $tempColor=$tempwinResult['color'];
// $tempTotal=$tempwinResult['total'];
// //=================random data=======================================
// $randomwinQuery=mysqli_query($con,"select * from `tbl_randomdata` order by RAND() LIMIT 1;");
// $randomwinResult=mysqli_fetch_array($randomwinQuery);
// $randomPrice=$randomwinResult['price'];
// $randomNumber=$randomwinResult['result'];
// $randomColor=$randomwinResult['color'];
// //=================random data end====================================

// $ResultQuery= mysqli_query($con,"INSERT INTO `tbl_result`(`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`,`createdate`) VALUES ('".$periodid."','".$tempTotal."','".$randomPrice."','".$tempNumber."','".$randomNumber."','".$tempColor."','".$randomColor."','real','".$type3."','".$today."')");	

// //========final Result end===============================================	
// //============user Result===========================================================
// resultbyUser($con,$periodid,$tempNumber,$tempColor,$randomPrice,$type3);

// }//==========chk bcone===================
// else{
// //=================random data=======================================
// $randomwinQuery=mysqli_query($con,"select * from `tbl_randomdata` order by RAND() LIMIT 1;");
// $randomwinResult=mysqli_fetch_array($randomwinQuery);
// $randomPrice=$randomwinResult['price'];
// $randomNumber=$randomwinResult['result'];
// $randomColor=strtolower($randomwinResult['color']);
// $heading_new=str_replace("&","",$randomColor);
// $newcolor=str_replace(" ","+",$heading_new);
// //=================random data end====================================

// $ResultQuery= mysqli_query($con,"INSERT INTO `tbl_result`(`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`,`createdate`) VALUES ('".$periodid."','0','".$randomPrice."','0','".$randomNumber."','','".$newcolor."','random','".$type3."','".$today."')");	

// //========final Result end===============================================	
// 	}
// }//====bcone end

// if($type4=='emerd')
// {
// $chkparityQuery=mysqli_query($con,"select * from `tbl_betting` where `periodid`='".$periodid."' and `tab`='emerd'");
// $chkparityRow=mysqli_num_rows($chkparityQuery);
// if($chkparityRow!=''){
// //=========possibility for green type parity
// for ($x = 0; $x <= 9; $x++) {
	
// if($x==1||$x==3||$x==7||$x==9)	
// {//======for green
// $color='green';
// $greentotal=winner($con,$periodid,$type4,'greenwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$greentotal+winner($con,$periodid,$type4,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type4,'tradeamount');
// $att=$greentotal+winner($con,$periodid,$type4,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// }else if($x==2||$x==4||$x==6||$x==8)	
// {
// $color='red';
// $redtotal=winner($con,$periodid,$type4,'redwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$redtotal+winner($con,$periodid,$type4,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type4,'tradeamount');
// $att=$redtotal+winner($con,$periodid,$type4,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// 	}	
// else if($x==0)

// {
// $color='red+violet';
// $redtotal=winner($con,$periodid,$type4,'redwinamountwithviolet');
// $vtotal=winner($con,$periodid,$type4,'violetwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$redtotal+$vtotal+winner($con,$periodid,$type4,$numbermappings[$x].'winamount');	
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type4,'tradeamount');
// $att=$redtotal+$vtotal+winner($con,$periodid,$type4,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// 	}	
	
// else if($x==5)

// {
// $color='green+violet';
// $redtotal=winner($con,$periodid,$type4,'greenwinamountwithviolet');
// $vtotal=winner($con,$periodid,$type4,'violetwinamount');
// if($settingResult['settingtype']=='high'){
// $total=$redtotal+$vtotal+winner($con,$periodid,$type4,$numbermappings[$x].'winamount');
// }else if($settingResult['settingtype']=='low'){
// $tradeamount=winner($con,$periodid,$type4,'tradeamount');
// $att=$redtotal+$vtotal+winner($con,$periodid,$type4,$numbermappings[$x].'winamount');
// $total=$tradeamount-$att;
// }
// 	}	
// $sql= mysqli_query($con,"INSERT INTO `tbl_tempwinner`(`periodid`,`number`,`color`,`total`, `type`) VALUES ('".$periodid."','".$x."','".$color."','".$total."','".$type4."')");	
// }
// //========final Result===================================================
// if($switchstatus=='yes' && $switchtab=='emerd')
// {
// $tempwinQuery=mysqli_query($con,"select `number`,`color`,`total` from `tbl_tempwinner` where `periodid`='".$periodid."' and `number`='".$manualnumber."' and `color`='".$manualcolor."' and `type`='emerd'");
// 	}
// else{
// $tempwinQuery=mysqli_query($con,"SELECT `number`,`color`,`total` from `tbl_tempwinner` where `total` = (
// select min(`total`)from `tbl_tempwinner` where `total`>=0)and `periodid`='".$periodid."' and `type`='emerd' limit 1");
// }
// $tempwinResult=mysqli_fetch_array($tempwinQuery);
// $tempNumber=$tempwinResult['number'];
// $tempColor=$tempwinResult['color'];
// $tempTotal=$tempwinResult['total'];
// //=================random data=======================================
// $randomwinQuery=mysqli_query($con,"select * from `tbl_randomdata` order by RAND() LIMIT 1;");
// $randomwinResult=mysqli_fetch_array($randomwinQuery);
// $randomPrice=$randomwinResult['price'];
// $randomNumber=$randomwinResult['result'];
// $randomColor=$randomwinResult['color'];
// //=================random data end====================================

// $ResultQuery= mysqli_query($con,"INSERT INTO `tbl_result`(`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`,`createdate`) VALUES ('".$periodid."','".$tempTotal."','".$randomPrice."','".$tempNumber."','".$randomNumber."','".$tempColor."','".$randomColor."','real','".$type4."','".$today."')");	

// //========final Result end===============================================
// //============user Result===========================================================
// resultbyUser($con,$periodid,$tempNumber,$tempColor,$randomPrice,$type4);
	
// }//==========chk sapre===================
// else{
// //=================random data=======================================
// $randomwinQuery=mysqli_query($con,"select * from `tbl_randomdata` order by RAND() LIMIT 1;");
// $randomwinResult=mysqli_fetch_array($randomwinQuery);
// $randomPrice=$randomwinResult['price'];
// $randomNumber=$randomwinResult['result'];
// $randomColor=strtolower($randomwinResult['color']);
// $heading_new=str_replace("&","",$randomColor);
// $newcolor=str_replace(" ","+",$heading_new);
// //=================random data end====================================

// $ResultQuery= mysqli_query($con,"INSERT INTO `tbl_result`(`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`,`createdate`) VALUES ('".$periodid."','0','".$randomPrice."','0','".$randomNumber."','','".$newcolor."','random','".$type4."','".$today."')");	

// //========final Result end===============================================		
// 	}
// }//====emerd end



}
	else
	{ 
//=====================if betting empty random data===============================
//=================random data=======================================
// $tabtypearray=array('parity',
// 'sapre',
// 'bcone',
// 'emerd');
// for ($i = 0; $i <= 3; $i++) {
// $randomwinQuery=mysqli_query($con,"select * from `tbl_randomdata` order by RAND() LIMIT 1;");
// $randomwinResult=mysqli_fetch_array($randomwinQuery);
// $randomPrice=$randomwinResult['price'];
// $randomNumber=$randomwinResult['result'];
// $randomColor=strtolower($randomwinResult['color']);
// $heading_new=str_replace("&","",$randomColor);
// $newcolor=str_replace(" ","+",$heading_new);
//=================random data end====================================

$ResultQuery= mysqli_query($con,"INSERT INTO `tbl_result`(`periodid`, `price`, `randomprice`, `result`, `randomresult`, `color`, `randomcolor`, `resulttype`, `tabtype`,`createdate`) VALUES ('".$periodid."','0','".$randomPrice."','0','".$randomNumber."','','".$newcolor."','random','".$tabtypearray[$i]."','".$today."')");	

//========final Result end===============================================	


//=====================if betting empty random data===============================
}//=====for end
		}
$truncateQuery=mysqli_query($con,"TRUNCATE TABLE `tbl_tempwinner`");

// Assuming you already have the authenticated user's ID in the session
 // Get the user ID from session

// // Fetch the periodid of the authenticated user
// $periodid = $_POST['periodid'];  // You can also get the periodid from the session or form input

// // SQL query to fetch the 'value' from 'tbl_betting' and 'randomcolor', 'randomresult' from 'tbl_result'
// // where the periodid is the same in both tables
// $sql = "
//     SELECT 
//         b.value AS betting_value, 
//         r.randomcolor, 
//         r.randomresult
//     FROM 
//         tbl_betting b
//     JOIN 
//         tbl_result r ON b.userid = r.userid AND b.periodid = r.periodid  // Join based on both userid and periodid
//     WHERE 
//         b.userid = '$userid' AND b.periodid = '$periodid'
//     ORDER BY 
//         r.createdate DESC LIMIT 1
// ";

// // Execute the query
// $result = mysqli_query($con, $sql);

// // Check if the query was successful
// if ($result && mysqli_num_rows($result) > 0) {
//     // Fetch the data
//     $row = mysqli_fetch_assoc($result);
//     $bettingValue = $row['betting_value'];
//     $randomColor = $row['randomcolor'];
//     $randomResult = $row['randomresult'];

//     // Output the data (for testing)
//     echo "Betting Value: $bettingValue<br>";
//     echo "Random Color: $randomColor<br>";
//     echo "Random Result: $randomResult<br>";
// }


//check if result done
echo("done");
include("betplaced.php");
?>