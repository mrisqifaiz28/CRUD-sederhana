<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login Sistem</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			background: url('foto/udinus1.jpg') no-repeat center center fixed;
			background-size: cover;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			margin: 0;
		}

		.card {
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			background-color: rgba(0, 0, 0, 0.75);
		}

		.card-title {
			font-size: 24px;
			font-weight: bold;
		}

		.form-control {
			border-radius: 5px;
		}

		.btn-info {
			background-color: #17a2b8;
			border: none;
		}

		.btn-info:hover {
			background-color: #138496;
		}

		.alert {
			margin-top: 20px;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="w-50 mx-auto text-center mt-5">
			<?php
			if (isset($_POST['username'])) {
				require "fungsi.php";
				$username = $_POST['username'];
				$passw = $_POST['passw']; // Hashing the password using MD5
				$sql = "SELECT * FROM user WHERE username='$username' AND password='$passw'";
				$hasil = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
				if (mysqli_affected_rows($koneksi) > 0) {
					$_SESSION['username'] = $username;
					header("location:profilehome.php");
				} else {
					echo "<div class='alert alert-danger w-50 mx-auto text-center alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Maaf, login gagal. 
                          </div>";
				}
			}
			?>
			<div class="card text-light">
				<div class="card-body">
					<h2 class="card-title">LOGIN</h2>
					<form method="post" action="">
						<div class="form-group">
							<label for="username">Username</label>
							<input class="form-control" type="text" name="username" id="username" autofocus>
						</div>
						<div class="form-group">
							<label for="passw">Password</label>
							<input class="form-control" type="password" name="passw" id="passw">
						</div>
						<div>
							<button class="btn btn-info btn-block" type="submit">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
