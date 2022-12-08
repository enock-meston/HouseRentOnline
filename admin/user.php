<?php
session_start();
$error = "";
$msg = "";
include('../includes/config.php');

error_reporting(0);
if (strlen($_SESSION['aID']) == 0) {
    header('location:index.php');
} else {

    // add user
    if (isset($_POST['addMeBtn'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $userType = $_POST['userType'];
        $password = $_POST['password'];
    
        // check if is in
        $checkEmail = mysqli_query($con,"SELECT * FROM `users_table` WHERE email='$email'");
    
        $countEmail = mysqli_num_rows($checkEmail);
    if($countEmail >=1) {
            $error = "The Email you are try to Use id aready Used!!";
        }else {
            $hashPassword = password_hash($password,PASSWORD_DEFAULT);
            $status =1;
            $sql = mysqli_query($con,"INSERT INTO `users_table`(`fname`, `lname`, `phone`, `email`, `userType`, `password`,`status`) 
            VALUES ('$fname','$lname','$phone','$email','$userType','$hashPassword','$status')");
            if ($sql) {
                $subject = "Account Created Successfully";
                $content = "Hello $fname $lname, Your Account has been Created Successfully<br>
                Your Email is $email and Password is $password";
                $to = $email;
                send_mail($subject,$content,$to);
                $msg = "Account Created Successfully";
            } else {
                $error = "Something Went Wrong";
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

    <title>Admin</title>

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

                    <h1 class="h3 mb-3">Users</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Add User</h5>
                                </div>
                                <div class="card-body">
                                    <!-- add system Users -->
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
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label class="form-label">First Name</label>
                                            <input required class="form-control form-control-lg" type="text"
                                                name="fname" placeholder="Enter your First name" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Last Name</label>
                                            <input required class="form-control form-control-lg" type="text"
                                                name="lname" placeholder="Enter your Last name" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input required class="form-control form-control-lg" type="email"
                                                name="email" placeholder="Enter your email" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input required class="form-control form-control-lg" type="number"
                                                name="phone" placeholder="Enter your Number" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Select User Type</label>
                                            <select name="userType" id="" class="form-select mb-3">
                                                <option selected>Select User Type</option>
                                                <option value="landlord">Landlord</option>
                                                <option value="authority">Authority</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input required class="form-control form-control-lg" type="password"
                                                name="password" placeholder="Enter password" />
                                        </div>
                                        <div class="text-center mt-3">
                                            <input type="submit" value="Save" name="addMeBtn" class="btn btn-primary">
                                            <!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
                                        </div>
                                    </form>
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


<?php
}
?>