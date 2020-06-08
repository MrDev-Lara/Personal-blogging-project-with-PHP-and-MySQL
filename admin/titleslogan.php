<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	session::checkadminlogout();
?>
<?php
	$titleslogan = $admin->selecttitleslogan();
?>
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$web_title = $_POST['title'];
		$web_slogan = $_POST['slogan'];
		
		$permit = array('jpg','jpeg','png');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$explode = explode('.',$file_name);
		$lowercase = strtolower(end($explode));
		$uniqe_img = substr(md5(time()),0,10).'.'.$lowercase;
		$upload_img = "upload/".$uniqe_img;
		
		
		if(empty($web_title) || empty($web_slogan)) {
			echo "fields cannot be empty!";
		}else{
			if(!empty($file_name)){
				  if($file_size>1000000){
					echo "file size cannot be greater than 1kb";
					}
				  elseif(in_array($lowercase,$permit) === false){
					echo "only ".implode(', ',$permit). " are supported";
				  }else{
					move_uploaded_file($file_tmp,$upload_img);
					$updated = $admin->updatewebsite($web_title,$web_slogan,$upload_img);
					}
				}else{
					$updated = $admin->updatewebsitewithoutlogo($web_title,$web_slogan);
				}
			}
	}
	?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

    <link href="css/fancy-button/fancy-button.css" rel="stylesheet" type="text/css" />
    <!--Jquery UI CSS-->
    <link href="css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
  
    <!--jQuery Date Picker-->
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>
    <!-- jQuery dialog related-->
    <script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>
    <!-- jQuery dialog end here-->
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <!--Fancy Button-->
    <script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock">               
                 <form method="post"  enctype="multipart/form-data">
                    <table class="form">
						<?php
							if(isset($titleslogan)){
								foreach($titleslogan as $key=>$val){
						?>	
						<?php
							if(isset($updated)){
								echo $updated;
							}
						?>		
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Website Title..." value='<?php echo $val['title']; ?>' name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Website Slogan..." value='<?php echo $val['slogan']; ?>' name="slogan" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
						<tr>
						<h4>Website Logo</h4>
							<img src="<?php echo $val['logo']; ?>" alt="" height="150px" width="180px"/>
								<?php } } ?>
						</tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
       <p>
         &copy; Copyright <a href="http://trainingwithliveproject.com">Training with live project</a>. All Rights Reserved.
        </p>
    </div>
</body>
</html>
