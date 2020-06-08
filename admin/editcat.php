<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	session::checkadminlogout();
?>
<?php
	if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
		header('location: catlist.php');
	}else{
		$catid = $_GET['catid'];
	}
	$result = $admin->selectcatbyid($catid);
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$categoryname = strtoupper($_POST['categoryname']);
		$admin->setcategoryname($categoryname);
		$update = $admin->updatecat($catid);
	}
?>
<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
 <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category Name</h2>
				<div class="block copyblock"> 
                 <form action="" method="post">
				 <?php 
					if(isset($update)){
						echo $update;
					}
				 ?>
				 <?php
					if(isset($result)){
				 ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="categoryname" value="<?php echo $result->name; ?>" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
					<?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>

<?php include'inc/footer.php'; ?>
