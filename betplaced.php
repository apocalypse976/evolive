<?php
ob_start();
session_start();
if($_SESSION['AuthUser']['username'] =="")
//if($_SESSION['frontuserid']=="")
{
	header("location:index.php");exit();
}
@$orderid = mysqli_insert_id($con);
function executeBetTransaction($con_evolive, $userid, $inputgameid,$investedammount, $finalamount, $orderid) {
    // Game ID and transaction ID setup
    $gameId = "EVO-colourprediction";
    $bytes = random_bytes(8);
    $transactionId = strtoupper(bin2hex($bytes));

    // Insert into transactions table
    $sqlTransaction = mysqli_query(
        $con_evolive,
        "INSERT INTO `transactions`(`user_id`, `round_id`, `game_id`, `amount`, `charge`, `final_balance`, `trx_type`, `remarks`, `trx_id`, `qt_trx_id`)
         VALUES ('" . $userid . "', '" . $inputgameid . "', '0', '" . $finalamount . "', '0.00', '" . $finalamount . "', '+', 'CREDITED BALANCE (Colour Prediction)', '" . $transactionId . "', '" . $orderid . "')"
    );

    // Insert into user_qt_exposures table
    $sqlBetHistory = mysqli_query(
        $con_evolive,
        "INSERT INTO `user_qt_exposures`(`txnid`, `txnType`, `user_id`, `roundId`, `amount`, `currency`, `gameId`, `category`, `clientRoundId`, `betId`, `profit_loss`)
         VALUES ('" . $transactionId . "', 'CREDIT', '" . $userid . "', '" . $inputgameid . "', '" . $investedammount . "', 'INR', '" . $gameId . "', 'COLOUR_PREDICTION', '', '', $finalamount)"
    );
}


$userid= $_SESSION['AuthUser']['userid'];
$walletbalance = wallet($con_evolive, 'balance', $userid);

$numberWin = "win by number";
$numberLoss="Loss By Number";
$winbyBigsmall=2;
$winbycolour=2;
$winbyNumber=9;
$violetwin=4.5;
$winbycolourandnumber=9;
$sql = "
    SELECT tbl_betting.periodid, tbl_betting.value, tbl_betting.number, tbl_betting.amount, tbl_betting.numberammount,tbl_betting.big_small,tbl_betting.bigsmall_ammount
    FROM tbl_betting
    INNER JOIN tbl_result
    ON tbl_betting.periodid =$periodid
    WHERE tbl_betting.userid = ?
";

// print_r ($sql);
// Prepare and execute the statement
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $userid); // Bind the user ID parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch and display the data
    if ($row = $result->fetch_assoc()) {
        // print_r($row );
        $periodid = $row['periodid'];
        $value = $row['value'];
        $number = $row['number'];
        $bigsmall=$row['big_small'];
        $bigsmallAmmount=$row['bigsmall_ammount'];
        $numberammount = $row['numberammount'];
        $ammount = $row['amount'];
        echo "Period ID: " . $periodid . "<br>";
        echo "Value: " . $value . "<br>";
        echo "Number: " . $number . "<br><br>";
        echo "Ammount: " . $numberammount . "<br><br>";
        echo "Number ammount: " . $ammount . "<br><br>";

    }
} else {
    echo "No matching records found for the authenticated user.";
}

$resultsql = "
    SELECT randomresult, randomcolor 
    FROM tbl_result 
    WHERE periodid = ?
";

// Prepare and execute the statement
$resultstmt = $con->prepare($resultsql);
$resultstmt->bind_param("i", $periodid); // Bind $periodid as an integer
$resultstmt->execute();
$resultgame = $resultstmt->get_result();

if ($resultgame->num_rows > 0) {
    // Fetch and display the data
    if ($rowgame = $resultgame->fetch_assoc()) {
        $randomresult = $rowgame['randomresult'];
        $randomcolor = $rowgame['randomcolor'];

        echo "Random Result: " . $randomresult . "<br>";
        echo "Random Color: " . $randomcolor . "<br>";
    }
} else {
    echo "No matching records found for the given periodid.";
}

if($numberammount!=0){
    $platformcharednumberammount = $numberammount - ($numberammount * 0.02);

}
if($ammount!=0){
    $platformchargedcolourammount=$ammount-($ammount*0.02);
}
if($bigsmallAmmount!=0){
    $platformcharedbigsmallammount=$bigsmallAmmount-($bigsmallAmmount*0.02);
}
if($result!=NULL && $resultgame!=NULL){
 
    if($value!==NULL){
        if($randomcolor=="RED & VIOLET" && $value=="Violet"){
            $updatedbalance= $platformchargedcolourammount*$violetwin;
            $walletbalance+=$updatedbalance;
            $sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$walletbalance' WHERE `id`= '$userid'");

            echo $walletbalance;
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `colour_win` = 'Win By Violet' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$ammount,$updatedbalance,$orderid);
        }
        elseif($randomcolor=="GREEN & VIOLET" && $value=="Violet"){
            $updatedbalance= $platformchargedcolourammount*$violetwin;
            $walletbalance+=$updatedbalance;
            $sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$walletbalance' WHERE `id`= '$userid'");
            echo $walletbalance;
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `colour_win` = 'Win By Violet' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$ammount,$updatedbalance,$orderid);
        }
        elseif(($randomcolor=="GREEN"||$randomcolor=="GREEN & VIOLET")&&$value=="Green"){
            $updatedbalance= $platformchargedcolourammount*$winbycolour;
            $walletbalance+=$updatedbalance;
            $sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$walletbalance' WHERE `id`= '$userid'");
            echo $walletbalance;
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `colour_win` = 'Win By Green' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$ammount,$updatedbalance,$orderid);
        }
        elseif(($randomcolor=="RED"||$randomcolor=="RED & VIOLET")&&$value=="Red"){
            $updatedbalance= $platformchargedcolourammount*$winbycolour;
            $walletbalance+=$updatedbalance;
            $sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$walletbalance' WHERE `id`= '$userid'");
            echo $walletbalance;
        // Update the colour_win column for the authenticated user
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `colour_win` = 'Win By Red' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$ammount,$updatedbalance,$orderid);

        }else{
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `colour_win` = 'Loss By Colour' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$ammount,0,$orderid);
        }
    }else{
        $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `colour_win` = NULL WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
    }
    
    if($number!==NULL){
        if($number==$randomresult){
            $updatedbalance= $platformcharednumberammount*$winbyNumber;
            $walletnewbalance=$walletbalance+$updatedbalance;
            $sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$walletnewbalance' WHERE `id`= '$userid'");
            echo $walletnewbalance;
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `number_win` = '$numberWin' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$numberammount,$updatedbalance,$orderid);
        }
       
        else{
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `number_win` = '$numberLoss' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$numberammount,0,$orderid);
        }
    }else{
        $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `number_win` = NULL WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
    }

    if($bigsmall!==NULL){
        if($bigsmall=="Small"&&($randomresult==0||$randomresult==1||$randomresult==2||$randomresult==3||$randomresult==4)){
            $updatedbalance= $platformcharedbigsmallammount*$winbyBigsmall;
            $walletnewbalance=$walletbalance+$updatedbalance;
            $sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$walletnewbalance' WHERE `id`= '$userid'");
            echo $walletnewbalance;
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `big_smallWin_loss` = 'Win by Small' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$bigsmallAmmount,$updatedbalance,$orderid);
        }
        elseif($bigsmall=="Big"&&($randomresult==5||$randomresult==6||$randomresult==7||$randomresult==8||$randomresult==9)){
            $updatedbalance= $platformcharedbigsmallammount*$winbyBigsmall;
            $walletnewbalance=$walletbalance+$updatedbalance;
            $sqlwallet = mysqli_query($con_evolive, "UPDATE `users` SET `balance` = '$walletnewbalance' WHERE `id`= '$userid'");
            echo $walletnewbalance;
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `big_smallWin_loss` = 'Win by Big' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$bigsmallAmmount,$updatedbalance,$orderid);
        }else{
            $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `big_smallWin_loss` = 'Loss By Big & Small' WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
            executeBetTransaction($con_evolive,$userid,$periodid,$bigsmallAmmount,0,$orderid);
        }
    }else{
        $sqlUpdate = mysqli_query($con, "UPDATE `tbl_betting` SET `big_smallWin_loss` = NULL WHERE `userid` = '$userid'AND `periodid` = '$periodid'");
    }
}
?>

