<?php
include 'includes/config.php';
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
    <link rel="shortcut icon" href="static/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>Home</title>

    <link href="static/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- heading -->

        <div class="main">
            <?php include 'includes/topbar.php';?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Wel come to Rent House Web Application</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Houses</h5>
                                </div>
                                <div class="card-body">
                                <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Make your Choise!</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php 
                                            $sql = mysqli_query($con,"SELECT * FROM `tbl_house` WHERE status=1 LIMIT 4");
                                            while($row = mysqli_fetch_array($sql)){
                                        ?>
                                        <div class="col-12 col-md-6">
                                            <div class="card">
                                                <img class="card-img-top" src="landlord/<?php echo $row['thumbnailPath'];?>"
                                                    alt="Unsplash">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">House Number: <?php echo $row['houseNumber'];?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">Price:  <?php echo $row['price'];?></p>
                                                    <a href="tenant/house.php" class="card-link">View</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <?php } ?>
                                    </div>
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

            <?php include 'includes/footer.php';?>
        </div>
    </div>

    <script src="static/js/app.js"></script>

</body>

</html>