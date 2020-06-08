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
	$result = $admin->alluser();
?>
<?php
	if(!session::get('role') == 0){
		echo "<script>window.location = 'index.php';</script>";
	}
?>
<?php
	if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		$id = $_GET['id'];
		$delete = $admin->deleteuser($id);
	}
	
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width='10%'>No of User</th>
							<th width='10%'>Name</th>
							<th width='15%'>Username</th>
							<th width='20%'>Email</th>
							<th width='15%'>Password</th>
							<th width='10%'>Role</th>
							<th width='20%'>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if(isset($result)){
							$i=0;
							foreach($result as $key=>$val){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $val['name']; ?></td>
							<td><?php echo $val['username']; ?></td>
							<td><?php echo $val['email']; ?></td>
							<td><?php echo $val['password']; ?></td>
							<td><?php echo $val['role']; ?></td>
							<td><a href="edituser.php?action=edit&id=<?php echo $val['id']; ?>">Edit</a> || <a href="?action=delete&id=<?php echo $val['id']; ?>" onclick='return confirm("are you sure you want to delete?")';>Delete</a></td>
						</tr>
					<?php } } ?>
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
 <?php include 'inc/footer.php';?>  