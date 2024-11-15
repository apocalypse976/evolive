<?php
ob_start();
session_start();
if($_SESSION['AuthUser']['username'] =="")
if($_SESSION['frontuserid']=="")
{
	header("location:index.php");exit();
}
include("include/connection.php");
$category=$_POST['category'];
$userid=$_SESSION['AuthUser']['userid'];
$today=date('Y-m-d');
if($category=='parity')//1
{?>
        <span   style="font-size:16px;" class="left">&nbsp;&nbsp;&nbsp;<i class="icon ion-md-paper"></i>&nbsp;Star Records</span><a class="right" href="star_history.php">More >>&nbsp;&nbsp;&nbsp;</a>  
          
        <div class="table-container" id="paritycontainer">
        <table class="table table-borderless table-hover text-center" id="parityt">
        <thead>
        <tr>
        <th>Period</th>
        <th>Big Small</th>
        <th>Number</th>
        <th>Result</th>
        </tr>
        </thead>
        <tbody>
        <?php
 $parityrecordQuery=mysqli_query($con,"select * from `tbl_result` where `tabtype`='parity' order by id desc limit 480");
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
        <td>
            <?php
             if($parityResult['randomresult']==0||$parityResult['randomresult']==1||$parityResult['randomresult']==2||$parityResult['randomresult']==3||$parityResult['randomresult']==4){
                echo ("Small");
             }elseif($parityResult['randomresult']==5||$parityResult['randomresult']==6||$parityResult['randomresult']==7||$parityResult['randomresult']==8||$parityResult['randomresult']==9){
                echo ("Big");
             }
             ?>
        </td>
        <td><?php echo $parityResult['randomresult'];?></td>
        <td>
        <div style="display: flex;">
       
        <?php if($parityResult['randomcolor']=='GREEN'){ ?>
        <div class="point green" style="background:#1DCC70;"></div>
        <?php }else if($parityResult['randomcolor']=='RED'){?>
        <div class="point red" style="background:#ff2d55;"></div>
        <?php }else if($parityResult['randomcolor']=='RED & VIOLET'){?>
         <div class="point" style="background:#ff2d55;"></div>&nbsp;
        <div class="point" style="background:#9c27b0;"></div>
 <?php }else if($parityResult['randomcolor']=='GREEN & VIOLET'){?>
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
        <td><span style="color:<?php if($parityResult['randomcolor']=='green'){echo"#1DCC70";}else if($parityResult['randomcolor']=='red'){echo"#ff2d55";}else if($parityResult['randomcolor']=='red++violet'){echo"#ff2d55";}else if($parityResult['randomcolor']=='green+violet'){echo"#1DCC70";}?>;"><?php echo $parityResult['randomresult'];?></span></td>
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
        <div class="containerrecord text-center mt-1">
        <a href="#" class="recordlink">
    <p><div class="title">My Star Record</div> </p>
    </a>
        <!-- </div>
        <div class="table-container">
        <table class="table table-borderless" id="myrecordparityt">
        <thead><tr><th></th></tr></thead>    
    <tbody>
        <div id="paritywait"></div> -->

        <style>
            @media (max-width: 599px) {
                .usertable{
                    width:400px !important;
                }
            }
        </style>
    <?php
$records_per_page = 10;

// Get the current page number from the URL (default is 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting record of the current page
$start_from = ($page - 1) * $records_per_page;

// SQL query to fetch the total number of records for the authenticated user
$sql_total = "SELECT COUNT(*) FROM tbl_betting WHERE userid = '$userid'";
$result_total = mysqli_query($con, $sql_total);
$row_total = mysqli_fetch_array($result_total);
$total_records = $row_total[0]; // Total number of records

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);

// SQL query to fetch the records for the current page
$sql = "SELECT * FROM tbl_betting WHERE userid = '$userid' ORDER BY createdate DESC";
$result = mysqli_query($con, $sql);

// Check if the query was successful
if ($result) {
    // Check if records are found
    if (mysqli_num_rows($result) > 0) {
        // Start the table
        echo "<div class='usertable' style='width: 100vw; height:800px; overflow: auto; margin: auto;'>";
       echo "<table style='width: 1500px; border-collapse: collapse; overflow: auto;margin: auto;'>";
        echo "<tr style='border-bottom: 2px solid #919191;color: black;'>
                  <th>Period ID</th>
                  <th>Value</th>
                  <th>Number</th>
                  <th>Big Small</th>
                  <th>Amount</th>
                  <th>Number Amount</th>
                  <th>Big Small Ammount</th>
                  <th>Win/Loss</th>
                   <th>Time</th>
              </tr>";

        // Fetch and display all records
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr style='border-bottom: 1px solid #919191;color: black;'>";
            echo "<td>" . htmlspecialchars($row['periodid']) . "</td>";
            echo "<td>" . htmlspecialchars($row['value']) . "</td>";
            echo "<td>" . htmlspecialchars($row['number'])??"N/A" . "</td>";
            echo "<td>" . htmlspecialchars($row['big_small'])??"N/A" . "</td>";
            echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
            echo "<td>" . htmlspecialchars($row['numberammount']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bigsmall_ammount']) . "</td>";
            if ($row['number_win'] !== NULL && $row['colour_win'] !== NULL && $row['big_smallWin_loss'] !== NULL) {
                // All three fields are present
                if ($row['number_win'] == 'Loss By Number' && $row['colour_win'] == 'Loss By Colour' && $row['big_smallWin_loss'] == 'Loss By Big & Small') {
                    // All three losses
                    echo "<td style='color:red'>" . htmlspecialchars($row['colour_win']) . "<br>" . htmlspecialchars($row['number_win']) . "<br>" . htmlspecialchars($row['big_smallWin_loss']) . "</td>";
                } else {
                    // Mixed results for all three fields
                    echo "<td>";
                    echo "<span style='color:" . ($row['colour_win'] == 'Loss By Colour' ? 'red' : 'green') . "'>" . htmlspecialchars($row['colour_win']) . "</span><br>";
                    echo "<span style='color:" . ($row['number_win'] == 'Loss By Number' ? 'red' : 'green') . "'>" . htmlspecialchars($row['number_win']) . "</span><br>";
                    echo "<span style='color:" . ($row['big_smallWin_loss'] == 'Loss By Big & Small' ? 'red' : 'green') . "'>" . htmlspecialchars($row['big_smallWin_loss']) . "</span>";
                    echo "</td>";
                }
            } elseif ($row['number_win'] !== NULL && $row['colour_win'] === NULL && $row['big_smallWin_loss'] === NULL) {
                // Only number_win is present
                echo "<td style='color:" . ($row['number_win'] == 'Loss By Number' ? 'red' : 'green') . "'>" . htmlspecialchars($row['number_win']) . "</td>";
            } elseif ($row['colour_win'] !== NULL && $row['number_win'] === NULL && $row['big_smallWin_loss'] === NULL) {
                // Only colour_win is present
                echo "<td style='color:" . ($row['colour_win'] == 'Loss By Colour' ? 'red' : 'green') . "'>" . htmlspecialchars($row['colour_win']) . "</td>";
            } elseif ($row['big_smallWin_loss'] !== NULL && $row['number_win'] === NULL && $row['colour_win'] === NULL) {
                // Only big_smallWin_loss is present
                echo "<td style='color:" . ($row['big_smallWin_loss'] == 'Loss By Big & Small' ? 'red' : 'green') . "'>" . htmlspecialchars($row['big_smallWin_loss']) . "</td>";
            } elseif ($row['colour_win'] !== NULL && $row['big_smallWin_loss'] !== NULL && $row['number_win'] === NULL) {
                // Colour and big_smallWin_loss present, number_win absent
                echo "<td>";
                echo "<span style='color:" . ($row['colour_win'] == 'Loss By Colour' ? 'red' : 'green') . "'>" . htmlspecialchars($row['colour_win']) . "</span><br>";
                echo "<span style='color:" . ($row['big_smallWin_loss'] == 'Loss By Big & Small' ? 'red' : 'green') . "'>" . htmlspecialchars($row['big_smallWin_loss']) . "</span>";
                echo "</td>";
            } elseif ($row['colour_win'] !== NULL && $row['number_win'] !== NULL && $row['big_smallWin_loss'] === NULL) {
                // Colour and number_win present, big_smallWin_loss absent
                echo "<td>";
                echo "<span style='color:" . ($row['colour_win'] == 'Loss By Colour' ? 'red' : 'green') . "'>" . htmlspecialchars($row['colour_win']) . "</span><br>";
                echo "<span style='color:" . ($row['number_win'] == 'Loss By Number' ? 'red' : 'green') . "'>" . htmlspecialchars($row['number_win']) . "</span>";
                echo "</td>";
            } elseif ($row['big_smallWin_loss'] !== NULL && $row['number_win'] !== NULL && $row['colour_win'] === NULL) {
                // Big_smallWin_loss and number_win present, colour_win absent
                echo "<td>";
                echo "<span style='color:" . ($row['big_smallWin_loss'] == 'Loss By Big & Small' ? 'red' : 'green') . "'>" . htmlspecialchars($row['big_smallWin_loss']) . "</span><br>";
                echo "<span style='color:" . ($row['number_win'] == 'Loss By Number' ? 'red' : 'green') . "'>" . htmlspecialchars($row['number_win']) . "</span>";
                echo "</td>";
            } else {
                echo "<td>Waiting...</td>";
            }
            
            echo "<td>" . htmlspecialchars($row['createdate']) . "</td>";
            echo "</tr>";
        }

        // Close the table
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>No data found for the authenticated user.</p>";
    }
} else {
    echo "<p>Error: " . mysqli_error($con) . "</p>";
}

// Pagination: Display the page links in DataTables format
echo "<div class='dataTables_paginate paging_simple_numbers' id='myrecordparityt_paginate'>";

// Previous page link
if ($page > 1) {
    echo "<a class='paginate_button previous' href='?page=" . ($page - 1) . "' id='myrecordparityt_previous'><i class='icon ion-ios-arrow-back'></i></a>";
} else {
    echo "<a class='paginate_button previous disabled' href='#' id='myrecordparityt_previous'><i class='icon ion-ios-arrow-back'></i></a>";
}

// Page links (1, 2, 3, etc.)
// echo "<span>";

// for ($i = 1; $i <= $total_pages; $i++) {
//     if ($i == $page) {
//         // Current page
//         echo "<a class='paginate_button current' href='#'>$i</a>";
//     } else {
//         // Other pages
//         echo "<a class='paginate_button' href='?page=$i'>$i</a>";
//     }
// }

// echo "</span>";

// Next page link
if ($page < $total_pages) {
    echo "<a class='paginate_button next' href='?page=" . ($page + 1) . "' id='myrecordparityt_next'><i class='icon ion-ios-arrow-forward'></i></a>";
} else {
    echo "<a class='paginate_button next disabled' href='#' id='myrecordparityt_next'><i class='icon ion-ios-arrow-forward'></i></a>";
}

echo "</div>";
  // Close the database connection
}
  ?>
	