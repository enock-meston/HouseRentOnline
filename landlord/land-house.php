<?php
session_start();
$error = "";
$msg = "";
include('../includes/config.php');

error_reporting(0);
if (strlen($_SESSION['landID']) == 0) {
    header('location:../landlord.php');
} else {
$me = $_SESSION['landID'];
    // add house
    if (isset($_POST['savebtn'])) {
        $number = $_POST['houseNumber'];
        $price = $_POST['price'];
        $details = $_POST['details'];
        $district = $_POST['district'];
        $sector = $_POST['sector'];
        $village = $_POST['village'];
        $cell = $_POST['cell'];
        $status = 1;

        $checkNumber = mysqli_query($con,"SELECT * FROM tbl_house WHERE houseNumber='$number'");
        $countHouse = mysqli_num_rows($checkNumber);
        if ($countHouse < 1) {
           // images
            $img_name = $_FILES['my_image']['name'];
            $img_size = $_FILES['my_image']['size'];
            $tmp_name = $_FILES['my_image']['tmp_name'];
            $error = $_FILES['my_image']['error'];

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg","png");
            if (in_array($img_ex_lc,$allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'thurmbnail/'.$new_img_name;
                    
                    if (move_uploaded_file($tmp_name, $img_upload_path)) {
                        $imageSize = getimagesize("$img_upload_path");
                        if ($imageSize[0]!=800 AND $imageSize[1] != 533) {
                            $error = "Image Must Have Width of 800 pixel AND Heigth of 533 pixel";
                        }else{
                            $reference=date("i").rand(9999, 10000000);
                            $query= mysqli_query($con,"INSERT INTO `tbl_house`(`reference`, 
                            `houseNumber`, `price`, `district`, `sector`, `village`, `cell`,
                            `owner`, `details`, `thumbnailPath`,`status`) VALUES ('$reference',
                            '$number','$price','$district','$sector','$village',
                            '$cell','$me','$details','$img_upload_path','$status')");

                            if ($query) {
                                $msg ="House saved";
                                // header("location: house.php");
                            } else {
                                $error ="Not Saved";
                            }
                        }
                    }else {
                        $error ="Not uploaded!";
                    }
                }
        
    }
    else{
        $error ="House Number already exist";
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

    <title>LandLord</title>

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

                                                    <h5 class="card-title mb-0">Add new House</h5>

                                                </div>
                                                <div class="card-body py-3">
                                                    <!-- message block -->
                                                    <div class="col-sm-12">
                                                        <!---Success Message--->
                                                        <?php if ($msg) { ?>
                                                        <div class="alert alert-success" role="alert">
                                                            <strong>Well done!</strong>
                                                            <?php echo htmlentities($msg); ?>
                                                        </div>
                                                        <?php } ?>

                                                        <!---Error Message--->
                                                        <?php if ($error) { ?>
                                                        <div class="alert alert-danger" role="alert">
                                                            <strong>Oh snap!</strong>
                                                            <?php echo htmlentities($error); ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                    <form method="POST" enctype="multipart/form-data">
                                                        <div class="mb-3">
                                                            <label class="form-label">House Number</label>
                                                            <input required="" type="text" name="houseNumber"
                                                                class="form-control" placeholder="example: N001">
                                                        </div>
                                                        <!--  -->
                                                        <div class="mb-3">
                                                            <label class="form-label">House Price</label>
                                                            <input required="" type="number" name="price"
                                                                class="form-control" placeholder="example: 1000">
                                                        </div>
                                                        <!--  -->

                                                        <div class="mb-3">
                                                            <label class="form-label">District</label>
                                                            <input required="" type="text" name="district"
                                                                class="form-control" placeholder="example: Gasabo">
                                                        </div>
                                                        <!--  -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Sector</label>
                                                            <input required="" type="text" name="sector"
                                                                class="form-control" placeholder="example: Rusororo">
                                                        </div>

                                                        <!--  -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Village</label>
                                                            <input required="" type="text" name="village"
                                                                class="form-control" placeholder="example: Kabutare">
                                                        </div>

                                                        <!--  -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Cell</label>
                                                            <input required="" type="text" name="cell"
                                                                class="form-control" placeholder="example: Nyagahinga">
                                                        </div>

                                                        <!--  -->
                                                        <div class="mb-3">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5 class="card-title mb-0">More Details</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <textarea required="" name="details"
                                                                        class="form-control" rows="2"
                                                                        placeholder="More Details"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Thumbanail must have Width of 800
                                                                pixel AND Heigth of 533 pixel</label>
                                                            <input required="" type="file" accept=".png,.jpg"
                                                                name="my_image" class="form-control">
                                                        </div>
                                                        <div class="center-content">
                                                            <input type="submit" value="add" name="savebtn"
                                                                class="btn btn-primary">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-xxl-5 d-flex">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col mt-0">
                                                                        <h5 class="card-title"> HouseList</h5>
                                                                        <table class="table table-hover my-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>N0</th>
                                                                                    <th>House Number</th>
                                                                                    <th class="d-none d-xl-table-cell">
                                                                                        Price</th>
                                                                                    <th>Status</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                    $selectUsers = mysqli_query($con,"SELECT * FROM `tbl_house` WHERE status=1");
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
                                                                                        <?php if ( $row['status'] == 1) {
                                                                                            echo "<span class='badge bg-success'>Active</span>";
                                                                                        }else {
                                                                                            echo "<span class='badge bg-danger'>Inactive</span>";
                                                                                        }
                                                                                        ?></td>
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