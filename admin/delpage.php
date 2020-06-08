<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	session::checkadminlogout();
?>
<?php
	if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL || $_GET['pageid'] == '0'){
		header('location:index.php');
	}else{
		$pageid = $_GET['pageid'];
		$delpage = $admin->delpage($pageid);
		if($delpage){
			echo "<script>alert('Data deleted successfully!');</script>";
			echo "<script>window.location = 'index.php' ;</script>";
		}else{
			echo "<script>alert('Data deleted successfully!');</script>";
			echo "<script>window.location = 'index.php' ;</script>";
		}
	}
?>