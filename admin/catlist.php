<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	session::checkadminlogout();
?>
<?php
	$result = $admin->selectcategoryall();
?>
<?php
	if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
			header('location: catlist.php');
		}else{
			$delid = $_GET['catid'];
		}
		$del = $admin->delcatbyid($delid);
	}
?>
<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
			<?php if(isset($del)){
				echo $del;
			} ?>
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php if(isset($result)){
						$i=0;
						foreach($result as $key=>$val){
							$i++;
					?>	
					
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $val['name'] ?></td>
							<td><a href="editcat.php?catid=<?php echo $val['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure you want to delete?')" href="?action=delete&catid=<?php echo $val['id']; ?>">Delete</a></td>
						</tr>
						<?php	}
					}?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
	<script type="text/javascript">
	   $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
		</script>
    <?php include'inc/footer.php'; ?>
