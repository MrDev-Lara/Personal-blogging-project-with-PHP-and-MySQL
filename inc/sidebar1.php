<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/blogger.php');
	$blogger = new blogger();
?>
<?php
	$result = $blogger->postselect();
?>
<div class="col-md-offset-1 col-md-3">
					<h3 class="header-of-category">Related posts</h3>
					<div class="col-md-12 latestarticle">
						<div class="sidebar">
							<?php
							if (isset($result)){
								foreach($result as $key=>$val){
							?>
							<h4><?php echo $val['title']; ?></h4>	
							<div class="col-md-3">
								<img src="admin/<?php echo $val['image']; ?>" alt="" width="50px" height="40px" style="margin-top:10px;margin-left:-10px;"/>
							</div>
							<div class="col-md-9">
								<h5><?php echo $format->textshorten($val['body'],200); ?></h5>
							</div>
							<?php } } else{
									echo "<h3>No related posts found!</h3>";
							}
							?>
						</div>
					</div>
	</div>