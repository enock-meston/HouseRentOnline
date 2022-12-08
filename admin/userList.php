<?php
session_start();
$error = "";
$msg = "";
include('../includes/config.php');

error_reporting(0);
if (strlen($_SESSION['aID']) == 0) {
    header('location:index.php');
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

                    <h1 class="h3 mb-3">User List</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">List</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th>N0</th>
                                                <th>Name</th>
                                                <th class="d-none d-xl-table-cell">Phone Number</th>
                                                <th class="d-none d-xl-table-cell">Email</th>
                                                <th class="d-none d-xl-table-cell">User Type</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $selectUsers = mysqli_query($con,"SELECT * FROM `users_table` WHERE status=1");
                                        $number=1;
                                        while ($row = mysqli_fetch_array($selectUsers)) {

                                            ?>
                                            <tr>
                                                <td><?php echo $number;?></td>
                                                <td class="d-none d-xl-table-cell"><?php echo $row['lname'] ." ". $row['fname'];?></td>
                                                <td class="d-none d-xl-table-cell"><?php echo $row['phone'];?></td>
                                                <td><?php echo $row['email'];?></td>
                                                <td><?php echo $row['userType'];?></td>
                                                <td>
                                                    <?php
                                                        if ($row['status'] ==1) {
                                                            echo "<span class='badge bg-success'>Active</span>";
                                                        } else {
                                                            echo "<span class='badge bg-danger'>Inactive</span>";
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

            <?php include '../includes/footer.php'; ?>
        </div>


    </div>

    <script src="../static/js/app.js"></script>
</body>

</html>

<?php } ?>