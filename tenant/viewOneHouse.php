<?php
session_start();
$error = "";
$msg = "";
include('../includes/config.php');

error_reporting(0);
if (strlen($_SESSION['cID']) == 0) {
    header('location:../tenantLogin.php');
} else {


    if ($_GET['Request']) {
        $ref = $_GET['Request'];
        $checkIDQuery = mysqli_query($con,"SELECT * FROM `requesttable` WHERE clientID='".$_SESSION['cID']."' AND status='1'");
        $checkID = mysqli_num_rows($checkIDQuery);

        $checkHouseReferenceQuery = mysqli_query($con,"SELECT * FROM `requesttable` WHERE houseReference='$ref'");
        $checkHouseReference = mysqli_num_rows($checkHouseReferenceQuery);
        if ($checkID > 0) {
            $error = "You have already made a request";
        }elseif($checkHouseReference > 0){
            $error ="House already Taken by others, try Otherone !";
        }
         else {
            $sql = mysqli_query($con,"INSERT INTO `requesttable`(`clientID`, `houseReference`) VALUES ('".$_SESSION['cID']."','$ref')");

            if ($sql) {
                mysqli_query($con,"UPDATE `tbl_house` SET `status`='2' WHERE reference='$ref'"); // 2 means that it was reseved by others
                header('location: MyhousesList.php');
            } else {
                $error = "Something went wrong. Please try again";
            }
        }
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

    <title>tenant</title>

    <link href="../static/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <div class="main">
            <?php include 'includes/topbar.php'; ?>
            <main class="content">
                <!-- message -->
                <div class="col-sm-12">
                    <!---Success Message--->
                    <?php if ($msg) { ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                    </div>
                    <?php } ?>

                    <!---Error Message--->
                    <?php if ($error) { ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                    </div>
                    <?php } ?>
                </div>
                <!-- end of message -->
                <div class="container-fluid p-0">
                    <?php
                            $houseRef = $_GET['houseRef'];
                            $sql = "SELECT * FROM tbl_house WHERE reference = '$houseRef'";
                            $result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_array($result);
                        ?>
                    <h1 class="h3 mb-3"><?php echo $row['houseNumber'];?></h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0"><?php echo $row['houseNumber'];?></h5>
                                    <div class="d-flex align-items-start">
                                        <img src="../landlord/<?php echo $row['thumbnailPath'];?>" width="36"
                                            height="36" class="rounded-circle me-2" alt="William Harris">
                                        <div class="flex-grow-1">
                                            <small class="text-muted"><?php echo $row['date'];?></small>

                                            <div class="row g-0 mt-1">
                                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                                    <img src="../landlord/<?php echo $row['thumbnailPath'];?>"
                                                        class="img-fluid pe-2" alt="Unsplash">
                                                </div>
                                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                                    <small class="text-muted">Price:
                                                        <?php echo $row['price'];?></small><br>
                                                    <small class="text-muted">District:
                                                        <?php echo $row['district'];?></small><br>
                                                    <small class="text-muted">Sector:
                                                        <?php echo $row['sector'];?></small><br>
                                                    <small
                                                        class="text-muted">Village<?php echo $row['village'];?></small><br>
                                                    <small class="text-muted">Cell<?php echo $row['cell'];?></small><br>
                                                    <small class="text-muted">Date<?php echo $row['date'];?></small><br>
                                                    <div class="border text-sm text-muted p-2 mt-1">
                                                        <?php echo $row['details'];?>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="viewOneHouse.php?Request=<?php echo $row['reference'];?>"
                                                class="btn btn-sm btn-success mt-1"><i class="feather-sm"
                                                    data-feather="send"></i> Send Request</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
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
<?php } ?>