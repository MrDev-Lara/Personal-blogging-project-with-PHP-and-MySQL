<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	session::checkadminlogout();
	$cats = $admin->selectcategoryall();
?>
<?php
	if(!isset($_GET['id']) || $_GET['id'] == NULL || $_GET['id'] == 0){
		header('location:postlist.php');
	}else{
		$id = $_GET['id'];
	}
	$result = $admin->selectallpost($id);
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$title = $_POST['title'];
		$cat = $_POST['cat'];
		$date = $_POST['date'];
		$body = $_POST['body'];
		$author = $_POST['author'];
		$tags = $_POST['tags'];
		
		
		$permit = array('jpg','jpeg','png');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$explode = explode('.',$file_name);
		$lowercase = strtolower(end($explode));
		$uniqe_img = substr(md5(time()),0,10).'.'.$lowercase;
		$upload_img = "upload/".$uniqe_img;
		
		if(empty($title) || empty($cat) || empty($date) || empty($body) || empty($author) ||empty($tags)  ) {
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
					$updated = $admin->updatepostallbyid($id,$cat,$title,$body,$upload_img,$author,$tags,$date);
					}
				}else{
					$updated = $admin->updatepostwithoutimgbyid($id,$cat,$title,$body,$author,$tags,$date);
				}
			}
	}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
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
    <script src="js/setup.js" type="text/javascript"></script>
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
	
    <!-- /TinyMCE -->
    <style type="text/css">
		#tinymce{font-size:15px !important;}
    </style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <div class="block">      
				<?php
					if(isset($updated)){
						echo $updated;
					}
				?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                      <?php if(isset($result)){ ?>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Post Title..." value="<?php echo $result->title; ?>" name="title" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>		
                            <td>
                                <select id="select" name="cat">
									<option>Select category</option>
									<?php 
									if(isset($cats)){
										foreach($cats as $key=>$val){
									?>	
                                    <option 
									<?php
										if(($result->cat) == $val['id']){ ?>
								        selected ='selected';
									<?php	} ?> value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
									<?php 
										} }
									?>
                                </select>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input type="text" name="date" value="<?php echo $result->date; ?>" id="date-picker" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
								<img src="<?php echo $result->image; ?>" height="60px" width="60px" alt="" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
									<?php echo  $result->body; ?>
								</textarea>
                            </td>
                        </tr>
						 <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" class="tinymce" value="<?php echo $result->author; ?>"/>
                            </td>
                        </tr>
						<tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" class="tinymce" value="<?php echo $result->tags; ?>"/>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
						<?php } ?>
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
     <?php include 'inc/footer.php';?> 
	 
	 
	