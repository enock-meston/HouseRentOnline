<?php
include 'includes/config.php';
$msg ="";
$error ="";

if (isset($_POST['addMeBtn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $id_card = $_POST['id_card'];
    $password = $_POST['password'];

    // check if is in
    $checkId = mysqli_query($con,"SELECT * FROM `tbl_client` WHERE ID_CardNumber='$id_card'");
    $checkEmail = mysqli_query($con,"SELECT * FROM `tbl_client` WHERE email='$email'");

    $countID = mysqli_num_rows($checkId);
    $countEmail = mysqli_num_rows($checkEmail);

    if ($countID >=1) {
        $error = "ID Card you are try to Use id aready Used!!";
    } else if($countEmail >=1) {
        $error = "The Email you are try to Use id aready Used!!";
    }else {
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        $status =1;
        $sql = mysqli_query($con,"INSERT INTO `tbl_client`(`fname`, `lname`, `phone`, `email`, `ID_CardNumber`, `password`,`status`) 
        VALUES ('$fname','$lname','$phone','$email','$id_card','$hashPassword','$status')");
        if ($sql) {
            $subject = "Account Created Successfully";
            $content = "Hello $fname $lname, Your Account has been Created Successfully";
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
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>Sign Up | AdminKit Demo</title>

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
							<h1 class="h2">Get started</h1>
							<p class="lead">
								Start creating the best possible user experience for you customers.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
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
											<input required class="form-control form-control-lg" type="text" name="fname" placeholder="Enter your First name" />
										</div>

                                        <div class="mb-3">
											<label class="form-label">Last Name</label>
											<input required class="form-control form-control-lg" type="text" name="lname" placeholder="Enter your Last name" />
										</div>

                                        <div class="mb-3">
											<label class="form-label">Email</label>
											<input required class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
										</div>

                                        <div class="mb-3">
											<label class="form-label">Phone Number</label>
											<input required class="form-control form-control-lg" type="number" name="phone" placeholder="Enter your email" />
										</div>

										<div class="mb-3">
											<label class="form-label">ID Card Number</label>
											<input required class="form-control form-control-lg" min="0" maxlength="16" type="number" name="id_card" placeholder="Enter your ID Card Number" />
										</div>
										
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input required class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" />
										</div>
										<div class="text-center mt-3">
                                        <input type="submit" value="Sign Up" name="addMeBtn" class="btn btn-primary">
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
										</div>
									</form>
                                    <br>
                                    <hr>
                                    <a href="tenantLogin.php" > Back to Login</a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

    <script>
        document.querySelectorAll('input[type="number"]').forEach(input =>{
            input.oninput = () =>{
                if(input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
            }
        });

    </script>
	<script src="static/js/app.js"></script>

</body>

</html>