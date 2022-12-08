<?php
session_start();
include('includes/config.php');
$error = "";
$msg = "";

if (isset($_POST['LoginBTN'])) {
    $error = "Invalid user credintials , Please try again later!!";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $select = mysqli_query($con, "SELECT * FROM tbl_client WHERE email='$email' AND status='1'") or die(mysqli_error($con));

        if (mysqli_num_rows($select) ==1) {
            $row = mysqli_fetch_array($select);
            $db_password = $row['password'];
        if (password_verify(mysqli_real_escape_string($con, trim($_POST['password'])), $db_password)) {
            $_SESSION['cID'] = $row['cli_id'];
            $_SESSION['cfirstname'] = $row['fname'];
            $_SESSION['clastname'] = $row['lname'];
            $_SESSION['cphone'] = $row['phone'];
            $_SESSION['card'] = $row['ID_CardNumber'];
            $_SESSION['cemail'] = $row['email'];

            header("location: tenant/index.php");
        }else {
            $error = "Password does not match with any of account , Please try again later!!";
        }
        
        }else {
            $error = "Invalid user credintials , Please try again later!!";
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
    <link rel="shortcut icon" href="static/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>Sign In | AdminKit Demo</title>

    <link href="static/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back, Tenant</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="static/img/avatars/avatar.jpg" alt="Charles Hall"
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
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
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                placeholder="Enter your email" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                placeholder="Enter your password" />

                                        </div>

                                        <div class="text-center mt-3">
                                        <input type="submit" value="Sign In" name="LoginBTN" class="btn btn-primary">
                                            <!-- <input type="submit" value="login" name="loginBtn" class="btn btn-primary"> -->
                                            <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                        </div>
                                    </form>
                                    <br>
                                    <hr>
                                    <a href="newAccount.php"> Have an Account? if no New Account</a>
                                    <br>
                                    <hr>
                                    <a href="index.php"> Back to Home</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="static/js/app.js"></script>

</body>

</html>