<?php
	$allpage = $admin->selectpage();
?>  
  <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                       <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titleslogan.html">Title & Slogan</a></li>
                                <li><a href="social.html">Social Media</a></li>
                                <li><a href="copyright.html">Copyright</a></li>
                                
                            </ul>
                        </li>
						
                         <li><a class="menuitem">Update Pages</a>
                            <ul class="submenu">
								<li><a href='addpage.php'>Add New page</a></li>
								<li><a>Contact Us</a></li>
							<?php
								if(isset($allpage)){
									foreach($allpage as $key=>$values){
							?>
								<li><a href="page.php?id=<?php echo $values['id']; ?>"><?php echo $values['title']; ?></a></li>
							<?php } } ?>
                            </ul>
                        </li>
                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                                <li><a href="addcat.html">Add Category</a> </li>
                                <li><a href="catlist.html">Category List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">
                                <li><a href="addpost.html">Add Post</a> </li>
                                <li><a href="postlist.html">Post List</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>