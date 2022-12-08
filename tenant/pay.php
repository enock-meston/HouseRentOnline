<?php
session_start();
$error = "";
$msg = "";
include('../includes/config.php');
include 'pay_parse.php';
error_reporting(0);
if (strlen($_SESSION['cID']) == 0) {
    header('location:../tenantLogin.php');
} else {

    if (isset($_POST['pay'])) {
        $price= $_POST['price'];
        $phone1= $_POST['phone'];
        $da = date("i");
         $curl = curl_init();
        $transID = uniqid();
        $calback = "";

            //REQUEST PAYMENT 
// var_dump($price);
hdev_payment::api_id("HDEV-48d87cf2-c648-49c1-9c7c-a1a12dbc30eb-ID");
hdev_payment::api_key("HDEV-79d8e552-5bed-4f5a-9551-cd051e32e406-KEY");
$pay = hdev_payment::pay($phone1,$price,$transID,$calback);

//var_dump($pay);//to get payment server response
// $status = $pay->status;
$status = "pending";
$message = $pay->message;


 $sql1= mysqli_query($con, "INSERT INTO `tbl_payrequest`(`phone`, `amount`, `Transactionref`,`status`) 
 VALUES ('$phone1','$price','$transID','$status')");
?>
<script type="text/javascript">
    windol.alert('<?php echo addslashes($message); ?>');
</script>
<?php
    }
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../static/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>AdminKit Demo - Bootstrap 5 Admin Template</title>

    <link href="../static/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <div class="main">
            <?php include 'includes/topbar.php'; ?>
            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Payment Page</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0"> Pay Now</h5>
                                </div>
                                <div class="card-body">
                                    <!-- payment process -->
                                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                                        <div class="d-table-cell align-middle">
                                            <?php 
                                                $ref = $_GET['requesthouseReference'];
                                                $sql = mysqli_query($con,"SELECT * FROM tbl_house WHERE reference = '$ref'");
                                                $row = mysqli_fetch_array($sql);
                                                $price = $row['price'];

                                                ?>

                                            <form method="POST" >
                                                <div class="mb-3">
                                                    <label class="form-label">House Price</label>
                                                    <input class="form-control form-control-lg" value="<?php echo $price;?>" type="email"
                                                        name="price" readonly />
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">My Number change if you want</label>
                                                    <input class="form-control form-control-lg" maxlength='10' value="<?php echo $_SESSION['cphone'];?>" type="number"
                                                        name="phone"/>
                                                </div>
                                                <input type="submit" value="Pay" class="btn btn-primary" name="pay">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <?php include 'includes/footer.php'; ?>
        </div>


    </div>

    <script src="../static/js/app.js"></script>
</body>

</html>

<?php
}
?>