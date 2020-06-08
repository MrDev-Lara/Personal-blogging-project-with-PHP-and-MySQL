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
	$result = $admin->viewpost();
?>
<?php
	if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		$id = $_GET['id'];
		$delete = $admin->deletepost($id);
	}
	
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
	if(isset($delete)){
		echo $delete;
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width='5%'>No of post</th>
							<th width='8%'>Post Title</th>
							<th width='20%'>Description</th>
							<th width='5%'>Category</th>
							<th width='9%'>Image</th>
							<th width='8%'>Author</th>
							<th width='5%'>Tags</th>
							<th width='10%'>Date</th>
							<th width='5%'>Action</th>
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
							<td><?php echo $val['title']; ?></td>
							<td><?php echo $format->textshorten($val['body'],50); ?></td>
							<td><?php echo $val['name']; ?></td>
							<td><img src="<?php echo $val['image']; ?>" alt="" height="40px" width="60px"/></td>
							<td><?php echo $val['author']; ?></td>
							<td><?php echo $val['tags']; ?></td>
							<td><?php echo $format->formatDate($val['date']); ?></td>
							<?php
								$permission = session::get('role');
								if($permission == $val['role'] || $permission == '0'){
							?>
							<td><a href="editpost.php?action=edit&id=<?php echo $val['id']; ?>">Edit</a> || <a href="?action=delete&id=<?php echo $val['id']; ?>" onclick='return confirm("are you sure you want to delete?")';>Delete</a></td>
								<?php }else{ ?>
								<td>No permission</td>
								<?php } ?>
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