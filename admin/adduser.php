<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	session::checkadminlogout();
?>
<?php
	if(!session::get('role') == 0){
		echo "<script>window.location = 'index.php';</script>";
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = $_POST['role'];
	
	$adduser = $admin->adduser($name,$username,$email,$password,$role);
	}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add User</h2>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
				 <?php
					if(isset($adduser)){
						echo $adduser;
					}
				 ?>
                    <table class="form">
                      <?php if(isset($result)){
						   echo $result;
					   } ?>
                        <tr>
                            <td>
                                <label>name</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter name..." name="name" class="medium" />
                            </td>
                        </tr>
                     
						<tr>
                            <td>
                                <label>username</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter username..." name="username" class="medium" />
                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>email</label>
                            </td>
                            <td>
                                <input type="mail" placeholder="Enter mail..." name="email" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>password</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Enter password..." name="password" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label>Role</label>
                            </td>
							<td>
							   <select name="role" id="">
								   <option value="0">Admin</option>
								   <option value="1">Author</option>
								   <option value="2">Editor</option>
							   </select>
							 </td>
							</tr>
							<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="ADD USER" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
<?php include 'inc/footer.php'; ?>