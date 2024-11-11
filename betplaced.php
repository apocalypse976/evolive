<?php
ob_start();
session_start();
if($_SESSION['AuthUser']['username'] =="")
//if($_SESSION['frontuserid']=="")
{
	header("location:index.php");exit();
}
$userid= $_SESSION['AuthUser']['userid'];
$walletbalance = wallet($con_evolive, 'balance', $userid);   
print_r( $_SESSION['AuthUser']['userid'].",".$walletbalance) ;
$sql = "
    SELECT tbl_betting.periodid, tbl_betting.value, tbl_betting.number 
    FROM tbl_betting
    INNER JOIN tbl_result
    ON tbl_betting.periodid = $periodid
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

        echo "Period ID: " . $periodid . "<br>";
        echo "Value: " . $value . "<br>";
        echo "Number: " . $number . "<br><br>";

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
if($result!=NULL&&$resultgame!=NULL){
    if($randomcolor!==""&&$number!=""){
        if(($number==$randomresult) &&
        (($randomcolor=="RED & VIOLET" && $value=="Violet")||($randomcolor=="GREEN & VIOLET" && $value=="Violet")||($randomcolor=="GREEN"&&$value=="Green")||($randomcolor=="RED"&&$value=="Red"))){
                echo "Win By Number And colour";
                exit;
        }
    }
    if($randomcolor!==""){
        if($randomcolor=="RED & VIOLET" && $value=="Violet"){
            echo "Win By Red_Violet";
        }
        elseif($randomcolor=="GREEN & VIOLET" && $value=="Violet"){
            echo "Win By Green_Violet";
        }
        elseif($randomcolor=="GREEN"&&$value=="Green"){
            echo "Win By Green";
        }
        elseif($randomcolor=="RED"&&$value=="Red"){
            echo "Win By Red";
        }
    }
    
    if($number!=""){
        if($number==$randomresult){
            echo "Win by Number";
        }
       
        else{
            echo "Lose By Number";
        }
    }
}
?>

