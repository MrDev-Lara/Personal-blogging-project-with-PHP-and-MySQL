<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/admin.php');
	include_once ($filepath.'/../lib/session.php');
	session::init();
	$admin = new admin();
	$loginmsg = session::get('loginmsg');
	session::checkadminlogout();
	
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Dashbord</h2>
                <div class="block">          
					<?php if(isset($loginmsg)){
						echo $loginmsg;
						session::set('loginmsg',NULL);
					} ?>
                  Welcome <?php echo session::get('name'); ?>       
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
 <?php include 'inc/footer.php';?>   
