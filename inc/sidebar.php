<?php
	$result = $blogger->selectcategory();
	$posts = $blogger->selectposts();
?>
<div class="col-md-offset-1 col-md-3">
					<h3 class="header-of-category">Categories</h3>
					<ul class="category">
					<?php
					if(isset($result)){
						foreach($result as $key=>$val){
					?>
						<li><a href="posts.php?id=<?php echo $val['id']; ?>"><?php echo $val['name']; ?></a></li>
					<?php } } else{
						echo "<li>No categories found!</li>";
					}?>
					</ul>
					<h3 class="header-of-category">Latest articles</h3>
						
					<div class="col-md-12 latestarticle">
						<div class="sidebar">
						<?php
							if(isset($posts)){
								foreach($posts as $key=>$values){
						?>
							<h4><?php echo $values['title']; ?></h4>	
							<div class="col-md-3">
								<img src="admin/<?php echo $values['image']; ?>" alt="" width="50px" height="40px" style="margin-top:10px;margin-left:-10px;"/>
							</div>
							<div class="col-md-9">
								<h5><?php echo $format->textshorten($values['body'],200) ?></h5>
							</div>
						<?php } }else{
							echo "<h3>No recent articles!</h3>";
						}?>
						</div>
					</div>
					
				</div>