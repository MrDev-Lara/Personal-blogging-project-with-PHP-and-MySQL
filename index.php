<?php
	include "classes/blogger.php";
	include "helpers/format.php";
	$blogger = new blogger();
	$format = new format();
?>	
<?php	
	$per_page=3;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}
	$start_from = ($page-1)*$per_page;
	$totalpost = $blogger->rowcount();
	$total_page = ceil($totalpost/$per_page);
	
    $blogger->setstartpage($start_from);
    $blogger->setperpage($per_page);
	$post = $blogger->selectpost();
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 fullcontainer">
				<div class="col-md-8 post">
				<?php
					if(isset($post)){
						foreach($post as $key=>$values){
				?>
					<div class="col-md-12">
						<h2 class="postheader"><?php echo $values['title']; ?></h2>
						<h4 class="posttime"><?php echo $format->formatDate($values['date']); ?> by <b style="color:blue;"><?php echo $values['author']; ?></b></h4>
					</div>
					<div class="col-md-5">
						<img src="admin/<?php echo $values['image']; ?>" alt="" width="300px" height="150px"/>
					</div>
					<div class="col-md-7 text-justify">
						<h4 class="postbody"><?php echo  $format->textshorten($values['body']); ?></h4>
						<a class="btn btn-primary" href="post.php?id=<?php echo $values['id']; ?>&cat=<?php echo $values['cat']; ?>">Read More</a>
					</div>
					<?php } ?>
					
					<!--pagination-->
					<?php echo "<span class='pagination'><a class='btn btn-primary' href='index.php?page=1'>First Page</a>"; ?>
					<?php
						for($i=1;$i<$total_page;$i++){
							echo "<a class='btn btn-primary' href='index.php?page=$i'>$i</a>";
						}
					?>
					<?php echo "<a class='btn btn-primary' href='index.php?page=$total_page'>Last Page</a></span>"; ?>
					<!--pagination-->
					
					<?php }else{ 
						echo "<h3>No Posts Found</h3>";
					}?>
				</div>
				<?php include 'inc/sidebar.php'; ?>
			</div>
		</div>
	</div>
<?php include 'inc/footer.php'; ?>