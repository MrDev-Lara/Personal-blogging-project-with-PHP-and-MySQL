<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	$admin = new admin();
?>
<?php
	$result = $admin->titleslogan();
	$media = $admin->socialmedia();
?>
<?php
	$allpage = $admin->selectpage();
?>  

<!DOCTYPE HTML>
<html lang="en-US">
	<meta charset="UTF-8">
<head>
 <?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$viewpage = $admin->viewpage($id);
		if($viewpage){ ?>
			<title><?php echo $viewpage->title; ?>-<?php echo TITLE; ?></title>
	<?php } }elseif(isset($_GET['id'])){
			$nid = $_GET['id'];
			$post = $admin->postselection($nid);
			if($post){ ?>
			<title><?php echo $post->title; ?>-<?php echo TITLE; ?></title>
		<?php }
	}
?>
<?php
		if(isset($_GET['id'])){
			$seoid = $_GET['id'];
			$seo = $admin->seo($seoid);
		}
?>
<?php
		if(isset($seo)){
			?>
		<meta name="keywords" content="<?php echo $seo->tags; ?>"/>
	<?php	}else{
?>
		<meta name="keywords" content="blog,cms blog,tutorial site"/>
	<?php } ?>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="inc/bootstrap.min.css" />
	<script type="text/javascript" src="inc/jquery.min.js"></script>
	<script type="text/javascript" src="inc/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css" />
</head>

<body>

	<div class="container upper-part">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
				<?php
					if(isset($result)){
				?>		
					
					<div class="col-md-4">
						<img src="admin/<?php echo $result->logo; ?>" alt="" width="160px" height="100px"/>
					</div>
					<div class="col-md-3">
						<h3><?php echo $result->title; ?></h3></span>
						<h5><?php echo $result->slogan; ?></h5>
					</div>
				<?php } ?>
				</div>
				<div class="col-md-offset-2 col-md-3">
					<div class="smedia">
						<a href="<?php echo $media->fb; ?>"><img src="images/facebook.png" alt="" width="50px" height="50px"/></a>
						<a href="<?php echo $media->ins; ?>"><img src="images/instagram.png" alt="" width="50px" height="50px"/></a>
						<a href="<?php echo $media->twi; ?>"><img src="images/youtube.png" alt="" width="50px" height="50px"/></a>
					</div>
					
					<form action="search.php" method="get">
						<input type="text" class="form-control styleform" name="search"/>
						<input type="submit" name="submit" value="search" style="float:right;margin-top:-32px;" class="btn btn-info btn-sm">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<button class="btn btn-default navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a 
						<?php
							$path = $_SERVER['SCRIPT_FILENAME'];
							$current = basename($path,'.php');
							if($current == 'index'){
								echo 'id="active"';
							}
						?>
						href="index.php">Home</a></li>
						<li><a 
						<?php
							$path = $_SERVER['SCRIPT_FILENAME'];
							$current = basename($path,'.php');
							if($current == 'contact'){
								echo 'id="active"';
							}
						?>
						href="contact.php">Contact</a></li>	
						<?php
								if(isset($allpage)){
									foreach($allpage as $key=>$values){
							?>
								<li><a <?php
									if(isset($_GET['id']) && $_GET['id'] == $values['id']){
										echo "id ='active'";
									}	
								?>
								href="openpage.php?id=<?php echo $values['id']; ?>"><?php echo $values['title']; ?></a></li>
							<?php } } ?>
					</ul>
				</div>
			</nav>
		</div>
	</div>