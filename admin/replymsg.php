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
	if(!isset($_GET['msgid']) && $_GET['msgid'] == 0){
		echo "<script>window.location = 'inbox.php';</script>";
	}else{
		$msgid = $_GET['msgid'];
	}
	$viewmsgbyid = $admin->selectmsgbyid($msgid);
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$to = $_POST['receiver'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$from = $_POST['yourmail'];
		
		if(empty($from) || empty($subject) || empty($message)){
			$error = 'Fields cannot be empty';
			echo $error;
		}else{
			$headers =  'MIME-Version: 1.0' . "\r\n"; 
			$headers .= 'From: Your name <info@address.com>' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

			$message = mail($to, $subject, $message, $headers);
			
			if($message){
				echo "<span class='success'>Message sent successfully</span>";
			}else{
				echo "<span class='error'>Failed to send messages</span>";
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
                <h2>Reply Message</h2>
                <div class="block">      
                 <form action="" method="post">
                    <table class="form">
                      <?php if(isset($viewmsgbyid)){ ?>
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $viewmsgbyid->email; ?>" name="receiver" class="medium" />
                            </td>
                        </tr>
						<?php } ?>
						
                         <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Subject..."  name="subject" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea name="message" id="" cols="30" rows="10" class="medium" ></textarea>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter your mail..." name="yourmail" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Reply" />
                            </td>
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
     <?php include 'inc/footer.php';?> 
	 
	 
	