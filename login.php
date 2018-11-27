<!DOCTYPE html>
<html style="height: 100%;">

<?php

require_once 'login_logic.php';

?>
<head>
	<title>Prep4Test login</title>
	<meta charset="utf-8">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./css/style_login.css">
</head>
<body class="h-100">
	<div class="h-100 background_saffron">
		<div class="container h-100">
			<div class="row h-100">
				<div class="col-sm-12 my-auto">
					<div class="card col-lg-3 col-md-4 col-sm-6 col-8 mw-75 p-3 mx-auto form_shadow border_rounded">
						<div class="w-50 mx-auto mb-2"><img src="./images/logo_black.png" alt="prep4test logo" class="img-fluid"></div>
						<form action="login.php" method="post">
							<div>
								<div class="form-group" >
									<label for="username">Username</label>
									<input class="form-control mb-2" id="username" name="username" placeholder="Enter username" type="text" value="<?php if (isset($_POST['username'])) {echo trim($_POST['username']);}?>">

									<label for="password" >Password</label>
									<input class="form-control mb-2" id="password" name="password" placeholder="Enter password" type="password"value="<?php if (isset($_POST['password'])) {echo trim($_POST['password']);}?>">
								</div>

								<p id="loginerr" name="loginerr" class="form-text text-danger text-center"> <?php echo $loginerr; ?> </p>

								<div class="d-flex justify-content-center mt-2">
								<button type="submit" name="submit" value="login" class=" mb-2 btn background_black text-white font-weight-bold btn_blk_saff form_shadow" >Login</button> </div>

								<div class="d-flex justify-content-center"><a href="register.php">Register a new user</a></div>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JQUERY because bootstrap needs companion! -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>