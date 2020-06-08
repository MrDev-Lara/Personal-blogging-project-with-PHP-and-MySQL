<?php include 'inc/header.php'; ?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		
		if(empty($firstname) || empty($lastname) || empty($email) || empty($message)){
			$error = 'Fields cannot be empty';
			echo $error;
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo 'Invalid email';
		}else{
			$message = $admin->sentmessage($firstname,$lastname,$email,$message);
		}
	}
?>
<div class="container">
		<div class="row">
			<div class="col-md-12 fullcontainer">
				 <form method="post">
				 <?php 
					if(isset($message)){
						echo $message;
					}
				 ?>
                    <table class="form">
                        <div class="form-group">
							<label for="FirstName">First Name:</label>
							<input type="text" class="form-control" name="firstname">
						</div>
						<div class="form-group">
							<label for="LastName">Last Name:</label>
							<input type="text" class="form-control" name="lastname">
						</div>
						  <div class="form-group">
							<label for="email">Email:</label>
							<input type="mail" class="form-control" name="email">
						  </div>
						  <div class="form-group">
							<label for="Message">Message:</label>
							<textarea name="message" class="form-control" cols="30" rows="10"></textarea>
						  </div>
						  <input type="submit" name="submit" Value="Sent Message" />
						</table>
                    </form>
			</div>
		</div>
	</div>
<?php include 'inc/footer.php'; ?>