<?php include 'inc/header.php'; ?>
<?php
	include "classes/blogger.php";
	include "helpers/format.php";
	$blogger = new blogger();
	$format = new format();
?>
<?php
	if(!isset($_GET['id']) || $_GET['id'] == NULL || $_GET['id'] == 0 ||  $_GET['cat'] == 0 || $_GET['cat'] == NULL){
		header('location:404.php');
	}else{
		$id = $_GET['id'];
		$cat = $_GET['cat'];
	}
	$id = $blogger->postselection($id);
	$blogger->setcat($cat);
	
?>
<div class="container">
		<div class="row">
			<div class="col-md-12 fullcontainer">
				<div class="col-md-8 post">
				<?php
					if(isset($id)){
				?>
					<div class="col-md-12">
						<h2 class="postheader"><?php echo $id->title; ?></h2>
						<h4 class="posttime"><?php echo $format->formatDate($id->date); ?> by <b style="color:blue;"><?php echo $id->author; ?></b></h4>
					</div>
					<div class="col-md-5">
						<img src="admin/<?php echo $id->image; ?>" alt="" width="300px" height="150px"/>
					</div>
					<div class="col-md-7 text-justify">
						<h4 class="postbody"><?php echo  $id->body; ?></h4>
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