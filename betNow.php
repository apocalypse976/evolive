<?php 
ob_start();
session_start();
include("include/connection.php");

@$orderid = mysqli_insert_id($con);
@$userid=$_POST['userid'];
@$type=$_POST['type'];
@$value=$_POST['value'];
@$counter=$_POST['counter'];
@$inputgameid=$_POST['inputgameid'];
@$finalamount=$_POST['finalamount'];
@$tab=$_POST['tab'];
@$presalerule=$_POST['presalerule'];
@$placedValue=$_POST['placedValue'];
if($userid=="" || $type=="" || $inputgameid=="" || $finalamount==""|| $placedValue=="")
{
	echo"2";
	//check empty
}else{

	if($counter<30)
	{ 
		echo"3";
		//check counter
	}else if($finalamount==0){
		echo"4";
		//check if amount 0	
	}else if($finalamount<10){
		echo"5";
		//check if amount below 10
	}else{
		$chkwallet=mysqli_query($con_evolive,"select `balance` from `users` where balance >= $finalamount and`id`='".$userid."'");
		//$chkwallet=mysqli_query($con,"select `amount` from `tbl_wallet` where amount >= $finalamount and`userid`='".$userid."'");
		$chkwalletRow=mysqli_num_rows($chkwallet);	
		$chkwalletResult=mysqli_fetch_array($chkwallet);
		
						
		//rewamp 
		
		if($chkwalletRow==0){
		//if($chkwalletRow==''){
			echo"6";
		}else{	

			// Check if the user has already placed a bet in the current period
$checkBet = mysqli_query($con, "SELECT * FROM `tbl_betting` WHERE `userid` = '$userid' AND `periodid` = '$inputgameid'");

// Check if the user has already placed a bet in the same period
$query = mysqli_query($con, "SELECT * FROM `tbl_betting` WHERE `userid` = '$userid' AND `periodid` = '$inputgameid'");


$row = mysqli_fetch_assoc($query);




if ($row!=NULL &&((mysqli_num_rows($query) > 0 || ( $row['value'] !== NULL ||  $row['number'] !== NULL||$row['big_small'])))) {

    // Check if value and number are not NULL
	$existingValue=$row['value'];
	$existingNumber=$row['number'];
	$existingbig_small=$row['big_small'];
	if(($value=="Red"|| $value =="Green"|| $value=="Violet")&&($existingValue==NULL)){
		$updateValue = mysqli_query($con, "UPDATE `tbl_betting` SET `value` = '$value', `amount` = '$finalamount' WHERE `periodid` = '$inputgameid'");
				
				$walletbalance = wallet($con_evolive, 'balance', $userid);   
				$finalbalanceDebit = $walletbalance - $finalamount;
				$sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$finalbalanceDebit' WHERE `id`= '$userid'");
				$gameId = "EVO-colourprediction";
				$bytes = random_bytes(8);
				$transactionId = strtoupper(bin2hex($bytes));
				$sqlTransaction= mysqli_query($con_evolive,"INSERT INTO `transactions`(`user_id`,`round_id`,`game_id`,`amount`,`charge`,`final_balance`,`trx_type`,`remarks`,`trx_id`,`qt_trx_id`) VALUES ('".$userid."','".$inputgameid."','0','".$finalamount."','0.00','".$finalamount."','-','DEDUCTED BALANCE (Colour Prediction)','".$transactionId."','".$orderid."')");
					
				$sqlBetHistory= mysqli_query($con_evolive,"INSERT INTO `user_qt_exposures`(`txnid`,`txnType`,`user_id`,`roundId`,`amount`,`currency`,`gameId`,`category`,`clientRoundId`,`betId`,`profit_loss`) VALUES ('".$transactionId."','DEBIT','".$userid."','".$inputgameid."','".$finalamount."','INR','".$gameId."','COLOUR_PREDICTION','','','0')");
				echo "1";
			exit;
			}
			elseif(($existingNumber==NULL)&&($value=="0"|| $value =="1"|| $value=="2"|| $value=="3"|| $value=="4"|| $value=="5"|| $value=="6"|| $value=="7"|| $value=="8"|| $value=="9")){

				$updateValue = mysqli_query($con, "UPDATE `tbl_betting` SET `number` = '$value', `numberammount` = '$finalamount' WHERE `periodid` = '$inputgameid'");
			
				$walletbalance = wallet($con_evolive, 'balance', $userid);   
				
				$finalbalanceDebit = $walletbalance - $finalamount;
				$sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$finalbalanceDebit' WHERE `id`= '$userid'");
				$gameId = "EVO-colourprediction";
				$bytes = random_bytes(8);
				$transactionId = strtoupper(bin2hex($bytes));
				$sqlTransaction= mysqli_query($con_evolive,"INSERT INTO `transactions`(`user_id`,`round_id`,`game_id`,`amount`,`charge`,`final_balance`,`trx_type`,`remarks`,`trx_id`,`qt_trx_id`) VALUES ('".$userid."','".$inputgameid."','0','".$finalamount."','0.00','".$finalamount."','-','DEDUCTED BALANCE (Colour Prediction)','".$transactionId."','".$orderid."')");
					
				$sqlBetHistory= mysqli_query($con_evolive,"INSERT INTO `user_qt_exposures`(`txnid`,`txnType`,`user_id`,`roundId`,`amount`,`currency`,`gameId`,`category`,`clientRoundId`,`betId`,`profit_loss`) VALUES ('".$transactionId."','DEBIT','".$userid."','".$inputgameid."','".$finalamount."','INR','".$gameId."','COLOUR_PREDICTION','','','0')");
				echo "1";
			exit;
			}
			elseif(($existingbig_small==NULL)&&($value=="Big"|| $value =="Small")){

				$updateValue = mysqli_query($con, "UPDATE `tbl_betting` SET `big_small` = '$value', `bigsmall_ammount` = '$finalamount' WHERE `periodid` = '$inputgameid'");
			
				$walletbalance = wallet($con_evolive, 'balance', $userid);   
				
				$finalbalanceDebit = $walletbalance - $finalamount;
				$sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$finalbalanceDebit' WHERE `id`= '$userid'");
				$gameId = "EVO-colourprediction";
				$bytes = random_bytes(8);
				$transactionId = strtoupper(bin2hex($bytes));
				$sqlTransaction= mysqli_query($con_evolive,"INSERT INTO `transactions`(`user_id`,`round_id`,`game_id`,`amount`,`charge`,`final_balance`,`trx_type`,`remarks`,`trx_id`,`qt_trx_id`) VALUES ('".$userid."','".$inputgameid."','0','".$finalamount."','0.00','".$finalamount."','-','DEDUCTED BALANCE (Colour Prediction)','".$transactionId."','".$orderid."')");
					
				$sqlBetHistory= mysqli_query($con_evolive,"INSERT INTO `user_qt_exposures`(`txnid`,`txnType`,`user_id`,`roundId`,`amount`,`currency`,`gameId`,`category`,`clientRoundId`,`betId`,`profit_loss`) VALUES ('".$transactionId."','DEBIT','".$userid."','".$inputgameid."','".$finalamount."','INR','".$gameId."','COLOUR_PREDICTION','','','0')");
				echo "1";
			exit;
			}
			
			echo "7";
	exit;
}else{
		$sql1 = mysqli_query($con, "INSERT INTO `tbl_betting` (`userid`, `periodid`, `type`, `value`, `number`, `amount`,`numberammount`, `tab`, `acceptrule`)  
		VALUES ('$userid', '$inputgameid', '$type', NULL, NULL, 0, 0,'$tab', '$presalerule')");
		
		// Transaction insertion into tbl_order
		$sql2 = mysqli_query($con, "INSERT INTO `tbl_order`(`userid`, `transactionid`, `amount`, `status`) 
		VALUES ('$userid', '$inputgameid', '$finalamount', '1')");

		
		// Wallet summary insertion into tbl_walletsummery
		$sql3 = mysqli_query($con, "INSERT INTO `tbl_walletsummery`(`userid`, `orderid`, `amount`, `type`, `actiontype`) 
		 VALUES ('$userid', '$orderid', '$finalamount', 'debit', 'join')");
		
		// Calculate the new wallet balance
		$walletbalance = wallet($con_evolive, 'balance', $userid);   

		$finalbalanceDebit = $walletbalance - $finalamount;
		
		// Update the user's balance in users table
		$sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$finalbalanceDebit' WHERE `id`= '$userid'");
		
		// Generate a unique transaction ID
		$gameId = "EVO-colourprediction";
		$bytes = random_bytes(8);
		$transactionId = strtoupper(bin2hex($bytes));
		$sqlTransaction= mysqli_query($con_evolive,"INSERT INTO `transactions`(`user_id`,`round_id`,`game_id`,`amount`,`charge`,`final_balance`,`trx_type`,`remarks`,`trx_id`,`qt_trx_id`) VALUES ('".$userid."','".$inputgameid."','0','".$finalamount."','0.00','".$finalamount."','-','DEDUCTED BALANCE (Colour Prediction)','".$transactionId."','".$orderid."')");
			
		$sqlBetHistory= mysqli_query($con_evolive,"INSERT INTO `user_qt_exposures`(`txnid`,`txnType`,`user_id`,`roundId`,`amount`,`currency`,`gameId`,`category`,`clientRoundId`,`betId`,`profit_loss`) VALUES ('".$transactionId."','DEBIT','".$userid."','".$inputgameid."','".$finalamount."','INR','".$gameId."','COLOUR_PREDICTION','','','0')");

		// Output or further processing with $transactionId if needed
			if($value=="Red"|| $value =="Green"|| $value=="Violet"){
				$updateValue = mysqli_query($con, "UPDATE `tbl_betting` SET `value` = '$value', `amount` = '$finalamount' WHERE `periodid` = '$inputgameid'");
				echo "1";
				exit;
		
			}elseif($value=="0"|| $value =="1"|| $value=="2"|| $value=="3"|| $value=="4"|| $value=="5"|| $value=="6"|| $value=="7"|| $value=="8"|| $value=="9"){
				$updateValue = mysqli_query($con, "UPDATE `tbl_betting` SET `number` = '$value', `numberammount` = '$finalamount' WHERE `periodid` = '$inputgameid'");
				echo "1";
				exit;
			}
			elseif($value=="Small"||$value=="Big"){
					$updateValue = mysqli_query($con, "UPDATE `tbl_betting` SET `big_small` = '$value', `bigsmall_ammount` = '$finalamount' WHERE `periodid` = '$inputgameid'");
					echo "1";
					exit;
			}
	}
	
}



			
			
			

			//=====================transaction end==============================================
			//revamp comment
			//userpromocode($con,$userid,user($con,'code',$userid),$finalamount,$inputgameid);//===bonus calculation

			// echo"1~".wallet($con_evolive,'balance',$userid);

			echo"1~".wallet($con_evolive,'balance',$userid);
		}

	}

?>