<?php
ob_start();
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php include'head.php' ?>
<link rel="stylesheet" href="assets/css/style.css?v=2">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Bitter Mobile Template">
<meta name="keywords" content="bootstrap, mobile template, bootstrap 4, mobile, html, responsive" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<script type="text/javascript">
let currentUrl = location.href;
history.replaceState('', '', 'index.php');
history.pushState('', '', currentUrl);
</script>
<style>
<meta name="theme-color" content="#ff0000"/>
  
.pleft {
	padding-left:3px;
}

.pright {
	padding-right:3px;
}
  .height{ height:40px; line-height:40px;}
.height .pageTitle{ line-height:2em;}

.appContent1 {
    padding-top:8px;
    padding-bottom:8px;
	background-image: url("bg.jpg");
}
</style>  

<link rel="manifest" href="manifest.json">
    <script>
        //if browser support service worker
        if('serviceWorker' in navigator) {
          navigator.serviceWorker.register('sw.js');
        };
      </script>
</head>

<body>
<?php include("include/connection.php");?>
<!-- Page loading -->

<!-- * Page loading 
<a href="http://lottlucy.com/apk/example.apk">
 
<div class="appHeader1 height">
  <div class="text-center"> 
    <div class="pageTitle"><i class="icon ion-md-download"></i> Download App</div>
  </div>
  
  </div>
</a>--> 
<!-- App Header -->

  <div class="appContent1">
    <div class="searchBlock">
      <form id="searchform" method="post" action="#">
        <span class="inputIcon"> <i class="icon ion-ios-search"></i> </span>
        <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Search for goods...">
      </form>
    </div>
  </div>
  

<!-- App Capsule -->
<div id="appCapsule"> 
  <!-- Card Overlay Carousel -->
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="banner/slider/1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src=" ./banner/slider/2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src=" ./banner/slider/3.jpg" alt="Third slide">
    </div>
   
  </div>
   <img src="index1.png" width="100%&quot;" height="100%">
   
</div>
  <!-- * Card Overlay Carousel -->
  
  <div class="appContent">
    <div class="sectionTitle mb-2"> 
      
      <!-- post list -->
       <div class="vcard">
        <div class="row" id="searchResult"> 
          <!-- item -->
          <?php
	$i=0;
  $productQuery=mysqli_query($con,"select * from `tbl_product` where `status`='1'");
  while($productResult=mysqli_fetch_array($productQuery)){$i++;?>
          <div class="col-6 <?php if(($i%2)==0){echo"pleft";}else{echo "pright";}?>">
            <div class="vcard card"> <a href="productdetails.php?pid=<?php echo encryptor('encrypt', $productResult['id']); ?>" class="postItem">
              <div class="imageWrapper"> <img src="<?php echo $productResult['images'];?>" alt="image" class="image"> </div>
              <p class="text-center"><?php echo $productResult['name'];?></p>
              <footer ><b><span class="text-center" style="color:#14DC22;">₹ <?php echo number_format($productResult['price'], 2);?></span></b></footer>
              </a> </div>
          </div>
          <?php }?>
          <!-- * item --> 
          <!-- item --><img class="">
          
        </div>
        
      </div>
      <!-- * post list -->
   
      <div class="p-3">   <p class="text-center">No more data </p></div>
      <hr>
    <center>
<b>Copyright 2022 &#10084;&#65039; <a href="https://evoliveonline.com">Lootle Money</a></b>
</center>
<center><b><a href="about.php" class="" target="_parent" rel="noopener noreferrer" style="color: rgb(192, 192, 192);">About us</a> | <a href="contact_us.php" id="link-66831" class="" target="_parent" rel="noopener noreferrer" style="color: rgb(192, 192, 192);">Contact Us</a> | <a href="privacy.php" class="" target="_parent" rel="noopener noreferrer" style="color: rgb(192, 192, 192);">Privacy Policy </a> | <a href="app_statement.php" class="" target="_parent" rel="noopener noreferrer" style="color: rgb(192, 192, 192);">App Statement </a><br><a href="terms_and_condition.php" id="link-66831" class="" target="_parent" rel="noopener noreferrer" style="color: rgb(192, 192, 192);">Terms & Condition </a> | <a href="riskagreement.php" class="" target="_parent" rel="noopener noreferrer" style="color: rgb(192, 192, 192);">Risk Disclosure Agreement</a><br><a href="refund_policy.php" class="" target="_parent" rel="noopener noreferrer" style="color: rgb(192, 192, 192);">Return and Refund Policy</a></b></center><br>

 <center><a  class="" target="_parent" rel="noopener noreferrer" style="color: rgb(192, 192, 192);">Warning: Forbidding Gambling</a></center>
      <!-- * listview --> 
      <br> <br>
    </div>
    
    <!-- app Footer --> 
        
   <!-- * app Footer --> 
    
  </div>
</div>
<!-- * appCapsule -->

<?php include("include/footer.php");?>

<!-- ///////////// Js Files ////////////////////  --> 
<!-- Jquery --> 
<script src="assets/js/lib/jquery-3.4.1.min.js"></script> 
<!-- Bootstrap--> 
<script src="assets/js/lib/popper.min.js"></script> 
<script src="assets/js/lib/bootstrap.min.js"></script> 
<!-- Owl Carousel --> 
<script src="assets/js/plugins/owl.carousel.min.js"></script> 
<!-- Main Js File --> 
<script src="assets/js/app.js"></script>
</body>
</html>