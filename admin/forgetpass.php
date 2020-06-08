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
		$mail = $_POST['mail'];
		if(empty($mail)){
			echo "Mail cannnot be empty";
		}else{
			$exist = $admin->mailexist($mail);
			if($exist){
				$selected = $admin->selectbymail($mail);
				if($selected){
					$userid = $selected->id;
					$user = $selected->username;
					$mail = $selected->email;
				}
				$text = substr($mail,0,4);
				$rand = rand(1000, 9000);
				$newpass = "$text$rand";
				$setnewpass = $admin->updatepass($newpass,$userid);
				if(isset($setnewpass)){
					echo $setnewpass;
				}
				$to = '$mail';
				$subject = 'About password recovery';
				$txt = 'Your new password is' .$newpass;
				$headers =  'MIME-Version: 1.0' . "\r\n"; 
				$headers .= 'From: Your name---------i87y <moniuddin045@gmail.com.com>' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$sentmail = mail($to,$subject,$txt,$headers);
				if($sentmail){
					echo "Password sent to mail";
				}else{
					echo "Failed to sent mail.";
				}
			}else{
				echo "Mail do not Exist";
			}
		}
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Password recovery</h1>
			<div>
				<input type="text" placeholder="your mail" name="mail"/>
			</div>
			<div>
				<input type="submit" value="Reset Pass" />
			</div>
			
		</form><!-- form -->
		<div class="button">
			<p>Project by Moni Uddin<p/>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>