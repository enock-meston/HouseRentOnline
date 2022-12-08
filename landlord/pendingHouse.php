<?php
session_start();
$error = "";
$msg = "";
include('../includes/config.php');

error_reporting(0);
if (strlen($_SESSION['landID']) == 0) {
    header('location:../landlord.php');
} else {

    // check if auth Was Appro
    if (isset($_GET['appro'])) {
        $requestID1 = $_GET['appro'];
    $query = mysqli_query($con, "SELECT * FROM requesttable WHERE statusAuthority IS NULL AND reqID='$requestID1'");
            $count = mysqli_num_rows($query);
            if ($count == false) {
                // 
                if ($_GET['appro']) {
                    $requestID = $_GET['appro'];
                    $query = mysqli_query($con, "UPDATE requesttable SET statusLandlord='success',status='1' WHERE reqID='$requestID'");
                    
                    if ($query) {
                        $msg = "Request Approved";
                        
                        header('location: pendingHouse.php');
                    } else {
                        $error = "Something went wrong . Please try again.";
                    }
                }
            
            
                if ($_GET['reject']) {
                    $requestID = $_GET['reject'];
                    $query = mysqli_query($con, "UPDATE requesttable SET statusLandlord='rejected' WHERE reqID='$requestID'");
                    if ($query) {
                        $msg = "Request rejected";
                        header('location: pendingHouse.php');
                    } else {
                        $error = "Something went wrong . Please try again.";
                    }
                }
            } else {
                $error = "Wait for Authority To Approve this Request";
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

    <title>Authority</title>

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

                    <h1 class="h3 mb-3">My Request</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Request</h5>
                                </div>

                                <div class="card-body">

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
                                    <!-- tables -->

                                    <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th>N0</th>
                                                <th>House Number</th>
                                                <th class="d-none d-xl-table-cell">
                                                    Price</th>
                                                <th>Date</th>
                                                <th>district</th>
                                                <th>sector</th>
                                                <th>Village</th>
                                                <th>cell</th>
                                                <th>Landlord's response</th>
                                                <th>Authority's response</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $selectUsers = mysqli_query($con,"SELECT *,requesttable.status as staReq FROM requesttable LEFT JOIN tbl_house ON 
                                                tbl_house.reference = requesttable.houseReference");
                                                $number=1;
                                               while ($row = mysqli_fetch_array($selectUsers)) {

                                                ?>
                                            <tr>
                                                <td><?php echo $number;?></td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $row['houseNumber'];?>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $row['price'];?></td>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $row['date'];?></td>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $row['district'];?></td>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $row['sector'];?></td>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $row['village'];?></td>
                                                </td>

                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $row['cell'];?></td>
                                                </td>

                                                <td class="d-none d-xl-table-cell">
                                                    <?php 
                                                         if ($row['statusLandlord'] == "success") {
                                                             echo "<span class='badge bg-success'>Accepted</span>";
                                                         }elseif($row['statusLandlord'] == "rejected"){
                                                            echo "<span class='badge bg-danger'>Rejected</span>";
                                                         }else {
                                                             echo "<span class='badge bg-warning'>Pending</span>";
                                                         }
                                                         ?>
                                                </td>

                                                <td class="d-none d-xl-table-cell">
                                                    <?php 
                                                         if ($row['statusAuthority'] == "success") {
                                                             echo "<span class='badge bg-success'>Accepted</span>";
                                                         }elseif($row['statusAuthority'] == "rejected"){
                                                            echo "<span class='badge bg-danger'>Rejected</span>";
                                                         }else {
                                                             echo "<span class='badge bg-warning'>Pending</span>";
                                                         }
                                                         ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                         if ($row['statusLandlord'] == "success") {
                                                             echo "<span class='badge bg-success'>Accepted</span>";
                                                         }
                                                         else {
                                                             echo "<a href='pendingHouse.php?appro=".$row['reqID']."'><span class='badge bg-primary'>
                                                             Approve
                                                             </span></a>";

                                                                echo "<a href='pendingHouse.php?reject=".$row['reqID']."'><span class='badge bg-danger'>
                                                                Reject
                                                                </span></a>";

                                                         }
                                                         ?>
                                                </td>
                                            </tr>
                                            <?php
                                                $number+=1;
                                               }
                                          ?>
                                        </tbody>
                                    </table>
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