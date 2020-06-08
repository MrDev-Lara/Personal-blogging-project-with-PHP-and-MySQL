<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	include_once ($filepath.'/../helpers/format.php');
	session::init();
	$admin = new admin();
	$format = new format();
	session::checkadminlogout();
?>
<?php
	if(!isset($_GET['msgid']) && $_GET['msgid'] == 0){
		echo "<script>window.location = 'inbox.php';</script>";
	}else{
		$msgid = $_GET['msgid'];
	}
	$viewmsgbyid = $admin->selectmsgbyid($msgid);
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		echo  "<script>window.location = 'inbox.php';</script>";
	}
?>



<div class="grid_10">
		
            <div class="box round first grid">
                <h2>Messages</h2>
				<div class="block copyblock"> 
                 <form action="" method="post">		
					<?php if(isset($viewmsgbyid)){
					?>
                        <tr>
                            <td>
                                <label>First Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $viewmsgbyid->firstname ; ?>" class="medium" />
                            </td>
                        </tr>
						</br></br>
						 <tr>
                            <td>
                                <label>Last Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $viewmsgbyid->lastname; ?>" class="medium" />
                            </td>
                        </tr>
						</br></br>
						 <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $viewmsgbyid->email; ?>" class="medium" />
                            </td>
                        </tr>
						</br></br>
						 <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
								<textarea name="" id="" readonly cols="30" rows="10" class="medium"><?php echo $viewmsgbyid->message; ?></textarea>
                            </td>
                        </tr>
						</br></br>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
					<?php } ?>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>