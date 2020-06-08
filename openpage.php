<?php include 'inc/header.php'; ?>
<?php
	if(!isset($_GET['id']) || $_GET['id'] == NULL || $_GET['id'] == '0'){
		header('location:404.php');
	}else{
		$id = $_GET['id'];
		$openpage = $admin->openpage($id);
	}
?>

<div class="container">
		<div class="row">
			<div class="col-md-12 fullcontainer">
				<div class="col-md-8 post">
				<?php
					if(isset($openpage)){
				?>
					<div class="col-md-12">
						<h2 class="postheader"><?php echo $openpage->title; ?></h2>
					</div>
					<div class="col-md-7 text-justify">
						<h4 class="postbody"><?php echo  $openpage->body; ?></h4>
					</div>
					<?php }else{ 
						header('location :404.php');
					}?>
				</div>
				<?php include 'inc/sidebar1.php'; ?>
			</div>
		</div>
	</div>
<?php include 'inc/footer.php'; ?>