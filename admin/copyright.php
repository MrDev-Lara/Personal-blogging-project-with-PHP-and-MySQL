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
	$result = $admin->copyrights();
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$copyright = $_POST['copyright'];
		
		if(empty($copyright)){
			echo "Copyright cannot be empty!";
		}else{
			$copy = $admin->updatecopyright($copyright);
		}
	}
	
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
				<?php 
					if(isset($copy)){
						echo $copy;
					}
				?>
                <div class="block copyblock"> 
                 <form method='post'>
                    <table class="form">
					<?php
						if(isset($result)){
					?>					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Copyright Text..." value="<?php echo $result->copyright; ?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
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
    <div id="site_info">
       <p>
         &copy; Copyright <a href="http://trainingwithliveproject.com">Training with live project</a>. All Rights Reserved.
        </p>
    </div>
</body>
</html>
