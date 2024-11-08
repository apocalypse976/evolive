<?php
ob_start();

session_start();

$key = "Tr1fPF";
$salt = "8B0DAo9VfU9wCdDTp48b0Tp7Vk34vcdj";

$action = 'https://secure.payu.in/_payment';

$html = '';

if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {

    $hash = hash('sha512', $key . '|' . $_POST['txnid'] . '|' . $_POST['amount'] . '|' . $_POST['productinfo'] . '|' . $_POST['firstname'] . '|' . $_POST['email'] . '|||||' . $_POST['udf5'] . '||||||' . $salt);

    $_SESSION['salt'] = $salt;

    $html = '<form action="' . $action . '" id="payment_form_submit" method="post">
			<input type="hidden" id="udf5" name="udf5" value="' . $_POST['udf5'] . '" />
			<input type="hidden" id="surl" name="surl" value="' . getCallbackUrl() . '" />
			<input type="hidden" id="furl" name="furl" value="' . getCallbackUrl() . '" />
			<input type="hidden" id="curl" name="curl" value="' . getCallbackUrl() . '" />
			<input type="hidden" id="key" name="key" value="' . $key . '" />
			<input type="hidden" id="txnid" name="txnid" value="' . $_POST['txnid'] . '" />
			<input type="hidden" id="amount" name="amount" value="' . $_POST['amount'] . '" />
			<input type="hidden" id="productinfo" name="productinfo" value="' . $_POST['productinfo'] . '" />
			<input type="hidden" id="firstname" name="firstname" value="' . $_POST['firstname'] . '" />
			<input type="hidden" id="Lastname" name="Lastname" value="' . $_POST['Lastname'] . '" />
			<input type="hidden" id="Zipcode" name="Zipcode" value="' . $_POST['Zipcode'] . '" />
			<input type="hidden" id="email" name="email" value="' . $_POST['email'] . '" />
			<input type="hidden" id="phone" name="phone" value="' . $_POST['phone'] . '" />
			<input type="hidden" id="address1" name="address1" value="' . $_POST['address1'] . '" />
			<input type="hidden" id="address2" name="address2" value="' . (isset($_POST['address2']) ? $_POST['address2'] : '') . '" />
			<input type="hidden" id="city" name="city" value="' . $_POST['city'] . '" />
			<input type="hidden" id="state" name="state" value="' . $_POST['state'] . '" />
			<input type="hidden" id="country" name="country" value="' . $_POST['country'] . '" />
			<input type="hidden" id="Pg" name="Pg" value="' . $_POST['Pg'] . '" />
			<input type="hidden" id="hash" name="hash" value="' . $hash . '" />
			</form>
			<script type="text/javascript"><!--
				document.getElementById("payment_form_submit").submit();	
			//-->
			</script>';

}


function getCallbackUrl()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $uri = str_replace('/index.php', '/', $_SERVER['REQUEST_URI']);
    return $protocol . $_SERVER['HTTP_HOST'] . '/response.php';
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Starwingo</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Bitter Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, bootstrap 4, mobile, html, responsive"/>
    <style>
        .appHeader1 {
            background-color: #f44336 !important;
            border-color: #f44336 !important;
        }

        .card {
            border-radius: 0px;
            padding: 10px !important;
        }

        h3 {
            font-weight: normal;
            font-size: 18px;
        }

        .razorpay-payment-button {
            padding: 10px 50px;
            color: #fff;
            background: #ff2e17;
            font-weight: 600;
            font-size: 14px;
            border: 1px solid #ff2e17;
            text-transform: uppercase;
        }

        .razorpay-payment-button:hover {
            color: #fff;
            background-color: #f33076;
            border-color: #f2246e;
            cursor: pointer;
        }

        .btn {
            background-color: blue;
        }
    </style>

</head>

<body>
<?php include("include/connection.php"); ?>


<!-- App Header -->
<div class="appHeader1">
    <div class="left"><a href="recharge.php" onClick="goBack()" class="icon goBack"> <i
                    class="icon ion-md-arrow-back"></i> </a>
        <div class="pageTitle">Pay Now</div>
    </div>
</div>

<?php include 'head.php' ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<br>
<div class="conntainer-fluid col-md-12 d-flex justify-content-center">
    <div class="card col-md-9 shadow">
        <div id="appCapsule">
            <div class="appContent">
                <div class="sectionTitle3">

                    <!-- post list -->
                    <div class="">
                        <div class="row">
                            <!-- item -->
                            <div class="col-12 pright">
                                <div class="vcard card mt-5">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th colspan="2" style="text-align:center; font-size:18px; border-top:none;">
                                                Payment Detail
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td><?php echo $_SESSION['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td><?php echo $_SESSION['mobile']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email Id</td>
                                            <td><?php echo $_SESSION['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Payable Amount</td>
                                            <td>₹ <?php echo number_format($_SESSION['finalamount'], 2); ?></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="vcard card mt-5">

                                <form action="" id="payment_form" method="post">


                                    <input type="hidden" class="form-control" id="udf5" name="udf5"
                                           value="PayUBiz_PHP7_Kit"/>


                                    <input type="hidden" class="form-control" id="ORDER_ID" name="txnid"
                                           placeholder="Transaction ID"
                                           value="<?php echo "Txn" . rand(10000, 99999999) ?>"/>

                                    <input type="hidden" class="form-control" id="amount" name="amount"
                                           placeholder="Amount"
                                           value="<?php echo number_format($_SESSION['finalamount'], 2, '.', ''); ?>"
                                           readonly/>

                                    <input type="hidden" class="form-control" id="productinfo" name="productinfo"
                                           placeholder="Product Info" value="<?php echo $_SESSION['frontuserid']; ?>"/>

                                    <input type="hidden" class="form-control" id="firstname" name="firstname"
                                           placeholder="First Name" value=""/>
                                    <input type="hidden" class="form-control" id="Lastname" name="Lastname"
                                           placeholder="Last Name" value=""/>

                                    <input type="hidden" class="form-control" id="Zipcode" name="Zipcode"
                                           placeholder="Zip Code" value=""/>


                                    <input type="hidden" name="surl"
                                           value="https://meeshoclub.com/payment-success.php"/>

                                    <input type="hidden" class="form-control" id="email" name="email"
                                           placeholder="Email ID" value="<?php echo $_SESSION['email']; ?>" readonly/>


                                    <input type="hidden" class="form-control" id="phone" name="phone"
                                           placeholder="Mobile/Cell Number" value="<?php echo $_SESSION['mobile']; ?>"
                                           readonly/>

                                    <input type="hidden" class="form-control" id="address1" name="address1"
                                           placeholder="Address1" value=""/>

                                    <input class="form-control" type="hidden" id="address2" name="address2"
                                           placeholder="Address2" value=""/>
                                    <input class="form-control" type="hidden" id="city" name="city" placeholder="City"
                                           value=""/>
                                    <input type="hidden" class="form-control" id="state" name="state"
                                           placeholder="State" value=""/>
                                    <input type="hidden" class="form-control" id="country" name="country"
                                           placeholder="Country" value=""/>
                                    <input type="hidden" class="form-control" id="Pg" name="Pg" placeholder="PG"
                                           value="upi"/>

                                    <div class="form-group">

                                        <input class="form-control bg-danger text-light"
                                               tyle="text-align: center; font-size: 70px;" type="button" id="btnsubmit"
                                               name="btnsubmit"
                                               value="Pay with Payu Now ₹ <?php echo number_format($_SESSION['finalamount'], 2); ?>"
                                               onclick="frmsubmit(); return true;"/>
                                    </div>
                                </form>
                                <input class="buy_now form-control bg-primary text-light" style="padding: 10px 16px;"
                                       type="button" id="btnsubmit" name="btnsubmit"
                                       value="Pay With Razorpay Now ₹ <?php echo number_format($_SESSION['finalamount'], 2); ?>"/> 
<br>
<a href="/checkout1.php"><input class="form-control bg-secondary text-dark" style="padding: 10px 16px;"
                                       type="button"
                                       value="Pay Manual Now ₹ <?php echo number_format($_SESSION['finalamount'], 2); ?>"/></a>
                                <?php if ($html) echo $html; //submit request to PayUBiz  ?>
                            </div>
                        </div>
                    </div>


                </div>
                <script type="text/javascript">
                    <!--
		function frmsubmit() {
            document.getElementById("payment_form").submit();
            return true;
        }

                </script>
                <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                <script>
                    $('body').on('click', '.buy_now', function (e) {
                        var totalAmount = $(this).attr("data-amount");
                        var product_id = $(this).attr("data-id");
                        var options = {
                            "key": "rzp_live_MMo0XLOe7RJQZI", // secret key id
                            "prefill": {
                                "name": "<?php echo $_SESSION['name']; ?>",
                                "email": "<?php echo $_SESSION['email']; ?>",
                                "contact": "<?php echo $_SESSION['mobile']; ?>"
                            },
                            "amount": (<?php echo $_SESSION['finalamount'] ?>* 100
                    ), // 2000 paise = INR 20
                        "name"
                    :
                        "Starwingo",
                            "description"
                    :
                        "Recharge Wallet",
                            // "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                            "handler"
                    :

                        function (response) {
                            console.log(response);
                            window.location.href = '/payment-proccess.php?razorpay_payment_id=' + response.razorpay_payment_id;
                            // $.ajax({
                            //     url: '/payment-proccess.php',
                            //     type: 'post',
                            //     dataType: 'json',
                            //     data: {
                            //         razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
                            //     },
                            //     success: function (msg) {
                            //         window.location.href = 'https://www.tutsmake.com/Demos/php/razorpay/success.php';
                            //     }
                            // });
                        }

                    ,
                        "theme"
                    :
                        {
                            "color"
                        :
                            "#528FF0"
                        }
                    }
                        ;
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                        e.preventDefault();
                    });
                </script>

</body>
</html>