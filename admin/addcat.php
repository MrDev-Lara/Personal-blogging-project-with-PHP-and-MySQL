<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	session::checkadminlogout();
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$categoryname = strtoupper($_POST['categoryname']);
		
		$admin->setcategoryname($categoryname);
		$result = $admin->addcat();
	}
?>
<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                 <form action="" method="post">
				 <?php
					if(isset($result)){
						echo $result;
					}
				 ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="categoryname" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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
<?php include'inc/footer.php'; ?>