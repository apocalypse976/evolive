<?php 
ob_start();
session_start();
include("include/connection.php");

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
if (mysqli_num_rows($query) > 0) {
    echo "7~You have already placed a bet in this period. You cannot place another bet.";
    exit;
}

// Your existing code for inserting the bet...
 else {
    // User has not placed a bet, proceed with the insert
    $sql = mysqli_query($con, "INSERT INTO `tbl_betting` (`userid`, `periodid`, `type`, `value`, `amount`, `tab`, `acceptrule`) 
                               VALUES ('$userid', '$inputgameid', '$type', '$value', '$finalamount', '$tab', '$presalerule')");
    
    // Transaction insertion
    $sql = mysqli_query($con, "INSERT INTO `tbl_order`(`userid`, `transactionid`, `amount`, `status`) 
                               VALUES ('$userid', '$inputgameid', '$finalamount', '1')");
    @$orderid = mysqli_insert_id($con);

    // Wallet summary
    $sql3 = mysqli_query($con, "INSERT INTO `tbl_walletsummery`(`userid`, `orderid`, `amount`, `type`, `actiontype`) 
                                VALUES ('$userid', '$orderid', '$finalamount', 'debit', 'join')");

    // Calculate the new wallet balance
    $walletbalance = wallet($con_evolive, 'balance', $userid);   
    $finalbalanceDebit = $walletbalance - $finalamount;

    // Update the user's balance
    $sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$finalbalanceDebit' WHERE `id`= '$userid'");

    // Revamp the transaction ID generation
    $gameId = "EVO-colourprediction";
    $bytes = random_bytes(8);
    $transactionId = strtoupper(bin2hex($bytes));

}

			
			
			//$sqlTransaction= mysqli_query($con_evolive,"INSERT INTO `transactions`(`user_id`,`round_id`,`game_id`,`amount`,`charge`,`final_balance`,`trx_type`,`remarks`,`trx_id`,`qt_trx_id`) VALUES ('".$userid."','".$inputgameid."','0','".$finalamount."','0.00','".$finalamount."','-','DEDUCTED BALANCE (Colour Prediction)','".$transactionId."','".$orderid."')");
			
			//$sqlBetHistory= mysqli_query($con_evolive,"INSERT INTO `user_qt_exposures`(`txnid`,`txnType`,`user_id`,`roundId`,`amount`,`currency`,`gameId`,`category`,`clientRoundId`,`betId`,`profit_loss`) VALUES ('".$transactionId."','DEBIT','".$userid."','".$inputgameid."','".$finalamount."','INR','".$gameId."','COLOUR_PREDICTION','','','0')");

			//=====================transaction end==============================================
			//revamp comment
			//userpromocode($con,$userid,user($con,'code',$userid),$finalamount,$inputgameid);//===bonus calculation

			echo"1~".wallet($con_evolive,'balance',$userid);
			//echo"1~".wallet($con,'amount',$userid);
		}

	}
}
?>