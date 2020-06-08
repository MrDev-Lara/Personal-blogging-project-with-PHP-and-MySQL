<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	session::checkadminlogout();
?>
<?php
	if(!isset($_GET['id']) || $_GET['id'] == NULL || $_GET['id'] == 0){
		header('location:userlist.php');
	}else{
		$id = $_GET['id'];
	}
	$result = $admin->selectalluser($id);
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = $_POST['role'];
		
		$updateuser = $admin->updateuserbyid($name,$username,$email,$password,$role,$id);
	}
			
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <link href="css/fancy-button/fancy-button.css" rel="stylesheet" type="text/css" />
    <!--Jquery UI CSS-->
    <link href="css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
    <!--jQuery Date Picker-->
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>
    <!-- jQuery dialog related-->
    <script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>
    <!-- jQuery dialog end here-->
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <!--Fancy Button-->
    <script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
	
    <!-- /TinyMCE -->
    <style type="text/css">
		#tinymce{font-size:15px !important;}
    </style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <div class="block">      
				<?php
					if(isset($updateuser)){
						echo $updateuser;
					}
				?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                      <?php if(isset($result)){ ?>
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text"  value="<?php echo $result->name; ?>" name="name" class="medium" />
                            </td>
                        </tr>
    
						 <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" class="tinymce" value="<?php echo $result->username; ?>"/>
                            </td>
                        </tr>
						<tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="mail" name="email" class="tinymce" value="<?php echo $result->email; ?>"/>
                            </td>
                        </tr>
						
						<tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" class="tinymce" value="<?php echo $result->email; ?>"/>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label>Role</label>
                            </td>
							<td>
							   <select name="role" id="">
								   <option <?php if ($result->role == 0){?>
										selected = 'selected';
									<?php	} ?>
								   value="0">Admin</option>
								   <option <?php if ($result->role == 1){?>
										selected = 'selected';
									<?php	} ?>
								   value="1">Author</option>
								   <option <?php if ($result->role == 2){?>
										selected = 'selected';
									<?php	} ?> value="2">Editor</option>
							   </select>
							 </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
						<?php } ?>
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
     <?php include 'inc/footer.php';?> 
	 
	 
	