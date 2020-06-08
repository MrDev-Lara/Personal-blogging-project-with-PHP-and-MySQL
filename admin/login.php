<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	session::checkadminlogin();
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$admin->setusername($username);
		$admin->setpassword($password);
		
		$result = $admin->loginsuccess();
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
			<?php
				if(isset($result)){
					echo $result;
				}
			?>
			<div>
				<input type="text" placeholder="Username" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="password"/>
			</div>
			
			<div>
				<input type="submit" value="Log in" />
			</div>
			<div>
				<a href="forgetpass.php">Forget Password?</a>
			</div>
		</form><!-- form -->
		<div class="button">
			<p>Project by Moni Uddin<p/>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>