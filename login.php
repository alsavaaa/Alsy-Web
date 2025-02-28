<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>SIMFAZA | Login</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="css/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
	<form action="aksi_login.php?op=in" method="post">
		<div class="middle-box text-center loginscreen   animated fadeInDown">
			<div>
				<div>

					<img border="0" src="faza no bg.png" width="100" height="100" />

				</div>
				<h3>Welcome to Fatimah Az-Zahra Dormitory</h3>
				<p>Ma'had Sunan Ampel Al-'Aly</p>
				<p>Login to see it in action.</p>
				<form class="m-t" role="form" action="login.php">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" required="">
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required="">
					</div>
					<div class="form-group">
						<div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
					</div>
					<button type="submit" class="btn btn-primary block full-width m-b">Login</button>

				</form>
				<p class="m-t"> <small>Copyright</strong> Fatimah Az-Zahra Dormitory &copy;</small> </p>
			</div>
		</div>

		<!-- Mainly scripts -->
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="js/plugins/iCheck/icheck.min.js"></script>
		<script>
			$(document).ready(function(){
				$('.i-checks').iCheck({
					checkboxClass: 'icheckbox_square-green',
					radioClass: 'iradio_square-green',
				});
			});
		</script>
	</form>
</body>

</html>
