<?php
session_start();
$error = "";
$msg = "";
include('../includes/config.php');

error_reporting(0);
if (strlen($_SESSION['cID']) == 0) {
    header('location:../tenantLogin.php');
} else {
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

    <title>home</title>

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

                    <h1 class="h3 mb-3">Home Page</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Activities</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-xxl-7">
                                            <div class="card flex-fill w-100">
                                                <div class="card-header">

                                                    <h5 class="card-title mb-0">Greattings</h5>
                                                </div>
                                                <div class="card-body py-3">
                                                    <div class="chart chart-sm">
                                                        <h1>Mr/Mrs
                                                            <?php echo $_SESSION['cfirstname']." ".$_SESSION['clastname'];?>,
                                                            Welcome to House Renting Web Application</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-xxl-5 d-flex">
                                            <div class="w-100">
                                                <div class="row">
                                                    <!-- <div class="col-sm-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col mt-0">
                                                                        <h5 class="card-title">Houses</h5>
                                                                    </div>

                                                                    <div class="col-auto">
                                                                        <div class="stat text-primary">
                                                                            <i class="align-middle"
                                                                                data-feather="truck"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h1 class="mt-1 mb-3">2</h1>
                                                                <div class="mb-0">
                                                                    <span class="text-danger"> <i
                                                                            class="mdi mdi-arrow-bottom-right"></i>
                                                                        . </span>
                                                                    <span class="text-muted">Since last week</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="col-sm-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col mt-0">
                                                                        <h5 class="card-title">Earnings</h5>
                                                                    </div>

                                                                    <div class="col-auto">
                                                                        <div class="stat text-primary">
                                                                            <i class="align-middle"
                                                                                data-feather="dollar-sign"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h1 class="mt-1 mb-3">$21.300</h1>
                                                                <div class="mb-0">
                                                                    <span class="text-success"> <i
                                                                            class="mdi mdi-arrow-bottom-right"></i>
                                                                        6.65% </span>
                                                                    <span class="text-muted">Since last week</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
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