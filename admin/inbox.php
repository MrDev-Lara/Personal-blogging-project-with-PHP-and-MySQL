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
	if(isset($_GET['seenid'])){
		$seenid = $_GET['seenid'];
		$upmsg = $admin->upmsg($seenid);
	}
?>
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$delmsg = $admin->delmsg($delid);
		if(isset($delmsg)){
			echo "Message deleted successfuly";
		}else{
			echo "Message not deleted";
		}
	}
?>
<?php
	$message = $admin->allmessage();
	$viewmessage = $admin->viewmessage();
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(isset($message)){
								$i=0;
								foreach($message as $msg){
								$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $msg['firstname']; ?></td>
							<td><?php echo $msg['lastname']; ?></td>
							<td><?php echo $msg['email']; ?></td>
							<td><?php echo $format->textshorten($msg['message']); ?></td>
							<td><a href="viewmsg.php?msgid=<?php echo $msg['id'];?>">View</a> ||
								<a href="replymsg.php?msgid=<?php echo $msg['id'];?>">Reply</a> ||
								<a href="?seenid=<?php echo $msg['id'];?>">Seen</a>
							</td>
						</tr>
						<?php
						}
							}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
		
		
		<div class="grid_10">
            <div class="box round first grid">
                <h2>Seen Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(isset($viewmessage)){
								$i=0;
								foreach($viewmessage as $msg){
								$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $msg['firstname']; ?></td>
							<td><?php echo $msg['lastname']; ?></td>
							<td><?php echo $msg['email']; ?></td>
							<td><?php echo $format->textshorten($msg['message']); ?></td>
							<td><a href="?delid=<?php echo $msg['id'];?>">Delete</a>
							</td>
						</tr>
						<?php
						}
							}
						?>
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
    <?php include 'inc/footer.php';?> 