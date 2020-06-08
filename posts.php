<?php
	include "classes/blogger.php";
	include "helpers/format.php";
	$blogger = new blogger();
	$format = new format();
?>
<?php
	if((!isset($_GET['id'])) || $_GET['id'] == NULL || $_GET['id'] == 0){
		header('location: 404.php');
	}else{
		$id = $_GET['id'];
	}
	$result = $blogger->selectpostbycat($id);
?>
<?php include 'inc/header.php'; ?>
<div class="container">
		<div class="row">
			<div class="col-md-12 fullcontainer">
				<div class="col-md-8 post">
				<?php
					if(isset($result)){
						foreach($result as $key=>$val){
				?>
					<div class="col-md-12">
						<h2 class="postheader"><?php echo $val['title']; ?></h2>
						<h4 class="posttime"><?php echo $format->formatDate($val['date']); ?> by <b style="color:blue;"><?php echo $val['author']; ?></b></h4>
					</div>
					<div class="col-md-5">
						<img src="admin/<?php echo$val['image']; ?>" alt="" width="300px" height="150px"/>
					</div>
					<div class="col-md-7 text-justify">
						<h4 class="postbody"><?php echo $format->textshorten($val['body']); ?></h4>
						<a class="btn btn-primary" href="post.php?id=<?php echo $val['id']; ?>&cat=<?php echo $val['cat']; ?>">Read More</a>
					</div>
					<?php } }else{ 
						header('location :404.php');
					}?>
				</div>
				<?php include 'inc/sidebar2.php'; ?>
			</div>
		</div>
	</div>
<?php include 'inc/footer.php'; ?>