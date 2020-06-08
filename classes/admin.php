<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../lib/session.php');

	class admin{
		private $db;
		private $user;
		private $pass;
		private $catname;
		
		public function __construct(){
			$this->db = new database();
		}
		
		public function setusername($username){
			$this->user = $username;
		}
		
		public function setpassword($password){
			$this->pass = $password;
		}
		
		private function checklogin(){
			$sql = "select * from tbl_user where username= :username and password= :password";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':username',$this->user);
			$stmt->bindParam(':password',$this->pass);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		
		public function loginsuccess(){
			if(empty($this->user)){
				$errmsg = "<div class='alert alert-danger'>Name cannot be empty</div>";
				return $errmsg;
			}
			if(empty($this->pass)){
				$errmsg = "<div class='alert alert-danger'>Password cannot be empty</div>";
				return $errmsg;
			}
			$result = $this->checklogin();
			if($result){
				session::init();
				session::set('adminlogin',true);
				session::set('username',$result->username);
				session::set('name',$result->name);
				session::set('pass',$result->password);
				session::set('role',$result->role);
				session::set("loginmsg", "<div class='alert alert-success'><strong>Success!</strong> You are logged in.</div>");
				header("Location: index.php");
			}else{
				$nameerr = "<div class='alert alert-danger'>Username and password is not matched.</div>";
				return $nameerr;
			}
		}
		
		public function selectcategoryall(){
			$sql = "select * from  tbl_category";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		public function setcategoryname($categoryname){
			$this->catname = $categoryname;
		}
		private function catrowcount(){
			$sql = "select * from  tbl_category where name= :name";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':name',$this->catname);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		}
		public function addcat(){
			if (empty($this->catname)){
				$errmsg = "<div class='alert alert-danger'>Category name cannot be empty;</div>";
				return $errmsg;
			}
			$result = $this->catrowcount();
			if($result){
				$errmsg = 'Category name already exist.Select a different category name';
				return $errmsg;
			}
			else{
			$sql = "insert into tbl_category(name) values(:name)";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':name',$this->catname);
			$done = $stmt->execute();
			if($done){
				$nameerr = "<div class='alert alert-success'>Category successfully added;</div>";
				return $nameerr;
			}else{
				$nameerr = "<div class='alert alert-danger'>Sorry,category is not added;</div>";
				return $nameerr;
			}
			}
		}
		
		public function selectcatbyid($catid){
			$sql = "select * from  tbl_category where id= $catid";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		public function updatecat($catid){
			if (empty($this->catname)){
				$errmsg = "<div class='alert alert-danger'>Category name cannot be empty;</div>";
				return $errmsg;
			}
			$result = $this->catrowcount();
			if($result){
				$errmsg = 'Category name already exist.Select a different category name';
				return $errmsg;
			}
			else{
			$sql = "update tbl_category set name= :name where id= $catid";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':name',$this->catname);
			$done = $stmt->execute();
			if($done){
				$nameerr = "<div class='alert alert-success'>Category updated successfully;</div>";
				return $nameerr;
			}else{
				$nameerr = "<div class='alert alert-danger'>Sorry,category is not updated;</div>";
				return $nameerr;
			}
			}
		}
		
		public function delcatbyid($delid){
			$sql = "delete from  tbl_category where id= $delid";
			$stmt = $this->db->PDO->prepare($sql);
			$result = $stmt->execute();
			if($result){
				$nameerr = 'Category deleted successfully';
				return $nameerr;
			}else{
				$nameerr = 'Category not deleted';
				return $nameerr;
			}
		}
		public function addpost($cat,$title,$body,$upload_img,$author,$tags,$date){
			if(empty($title)){
				$errmsg = 'Title cannot be empty';
				return $errmsg;
			}
			if(empty($date)){
				$errmsg = 'Please select your date of post';
				return $errmsg;
			}
			if(empty($body)){
				$errmsg = 'Post cannot be empty';
				return $errmsg;
			}
			if(empty($author)){
				$errmsg = 'Select an author of the post';
				return $errmsg;
			}
			if(empty($tags)){
				$errmsg = 'Tags cannot be empty';
				return $errmsg;
			}
			else{
				$sql = "insert into tbl_post(cat,title,body,image,author,tags,date) values(:name,:title,:body,:image,:author,:tags,:date)";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':name',$cat);
				$stmt->bindParam(':title',$title);
				$stmt->bindParam(':body',$body);
				$stmt->bindParam(':image',$upload_img);
				$stmt->bindParam(':author',$author);
				$stmt->bindParam(':tags',$tags);
				$stmt->bindParam(':date',$date);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Post successfully added;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,Post is not added;</div>";
					return $nameerr;
					}
				}
			}
			public function viewpost(){
				$sql = "select tbl_post.*, tbl_category.name from tbl_post inner join tbl_category on tbl_post.cat = tbl_category.id";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				return $result;
			}
			public function selectallpost($id){
				$sql = "select * from  tbl_post where id = $id";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				return $result;
			}
			public function updatepostallbyid($id,$cat,$title,$body,$upload_img,$author,$tags,$date){
				$sql = "update tbl_post set cat= :cat,title= :title,body= :body,image= :image,author= :author,tags= :tags,date= :date where id= $id";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':cat',$cat);
				$stmt->bindParam(':title',$title);
				$stmt->bindParam(':body',$body);
				$stmt->bindParam(':image',$upload_img);
				$stmt->bindParam(':author',$author);
				$stmt->bindParam(':tags',$tags);
				$stmt->bindParam(':date',$date);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Post updated successfully;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,Post is not updated;</div>";
					return $nameerr;
				}
			}
			public function updatepostwithoutimgbyid($id,$cat,$title,$body,$author,$tags,$date){
				$sql = "update tbl_post set cat= :cat,title= :title,body= :body,author= :author,tags= :tags,date= :date where id= $id";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':cat',$cat);
				$stmt->bindParam(':title',$title);
				$stmt->bindParam(':body',$body);
				$stmt->bindParam(':author',$author);
				$stmt->bindParam(':tags',$tags);
				$stmt->bindParam(':date',$date);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Post updated successfully;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,Post is not updated;</div>";
					return $nameerr;
				}
			}
			
			public function updatewebsite($web_title,$web_slogan,$upload_img){
				$sql = "update titleslogan set title= :title,slogan= :slogan,logo= :logo where id='1'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':title',$web_title);
				$stmt->bindParam(':slogan',$web_slogan);
				$stmt->bindParam(':logo',$upload_img);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Website updated successfully;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,Website is not updated;</div>";
					return $nameerr;
				}
			}
			public function updatewebsitewithoutlogo($web_title,$web_slogan){
				$sql = "update titleslogan set title= :title,slogan= :slogan where id='1'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':title',$web_title);
				$stmt->bindParam(':slogan',$web_slogan);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Website updated successfully;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,Website is not updated;</div>";
					return $nameerr;
				}
			}
			public function deletepost($id){
			$sql = "delete from  tbl_post where id= $id";
			$stmt = $this->db->PDO->prepare($sql);
			$result = $stmt->execute();
			if($result){
				$nameerr = 'Post deleted successfully';
				return $nameerr;
			}else{
				$nameerr = 'Post not deleted';
				return $nameerr;
			}
			}
			public function selecttitleslogan(){
			$sql = "select * from  titleslogan where id= '1'";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
			}
			
			public function titleslogan(){
			$sql = "select * from  titleslogan where id= '1'";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
			}
			
			public function socialmedia(){
			$sql = "select * from  tbl_social where id= '1'";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
			}
			
			public function updatesocial($fb,$ins,$twi){
				$sql = "update tbl_social set fb= :fb,ins= :ins,twi= :twi where id='1'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':fb',$fb);
				$stmt->bindParam(':ins',$ins);
				$stmt->bindParam(':twi',$twi);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Social media updated successfully;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,social media is not updated;</div>";
					return $nameerr;
				}
			}
			
			public function copyrights(){
			$sql = "select * from  tbl_footer where id= '1'";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
			}
			public function updatecopyright($copyright){
				$sql = "update tbl_footer set copyright= :copyright where id='1'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':copyright',$copyright);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Copyright updated successfully;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,Copyright is not updated;</div>";
					return $nameerr;
				}
			}
			public function addpage($title,$body){
				$sql = "insert into tbl_page(title, body) values(:name, :body)";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':name',$title);
				$stmt->bindParam(':body',$body);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Page Added successfully;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,Page is not Added;</div>";
					return $nameerr;
				}
			}
			public function selectpage(){
			$sql = "select * from  tbl_page";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
			}
			public function viewpage($id){
			$sql = "select * from  tbl_page where id= $id";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
			}
			public function updatepage($title,$body,$id){
				$sql = "update tbl_page set title= :title,body= :body where id=$id";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':title',$title);
				$stmt->bindParam(':body',$body);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Page updated successfully;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,Page is not updated;</div>";
					return $nameerr;
				}
			}
			public function delpage($pageid){
			$sql = "delete from  tbl_page where id= $pageid";
			$stmt = $this->db->PDO->prepare($sql);
			$result = $stmt->execute();
			}
			public function openpage($id){
			$sql = "select * from  tbl_page where id= $id";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
			}
			public function postselection($nid){
			$sql = "select * from tbl_post where id= $nid";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
			}
			public function sentmessage($firstname,$lastname,$email,$message){
			$sql = "insert into tbl_msg(firstname, lastname, email, message) values(:firstname, :lastname, :email, :message)";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':firstname',$firstname);
			$stmt->bindParam(':lastname',$lastname);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':message',$message);
			$done = $stmt->execute();
			if($done){
				$nameerr = "<div class='alert alert-success'>Message sent successfully;</div>";
				return $nameerr;
			}else{
				$nameerr = "<div class='alert alert-danger'>Sorry,Message is not sent;</div>";
				return $nameerr;
			}
			}
			public function allmessage(){
				$sql = "select * from tbl_msg where status='0'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				return $result;
			}
			public function viewmessage(){
				$sql = "select * from tbl_msg where status='1'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				return $result;
			}
			
			public function selectmsgbyid($msgid){
				$sql = "select * from tbl_msg where id='$msgid'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				return $result;
			}
			public function upmsg($seenid){
				$sql = "update tbl_msg set status='1' where id='$seenid'";
				$stmt = $this->db->PDO->prepare($sql);
				$done = $stmt->execute();
			}
			public function delmsg($delid){
			$sql = "delete from  tbl_msg where id= $delid";
			$stmt = $this->db->PDO->prepare($sql);
			$result = $stmt->execute();
			}
			public function msgcount(){
				$sql = "select * from  tbl_msg where status='0'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->rowCount();
				return $result;
			}
			public function seo($seoid){
				$sql = "select * from  tbl_post where id='$seoid'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				return $result;
			}
			public function adduser($name,$username,$email,$password,$role){
				$sql = "insert into tbl_user(name,username,email,password,role) values(:name,:username,:email,:password,:role)";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':name',$name);
				$stmt->bindParam(':username',$username);
				$stmt->bindParam(':email',$email);
				$stmt->bindParam(':password',$password);
				$stmt->bindParam(':role',$role);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>User successfully added;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,User is not added;</div>";
					return $nameerr;
					}
				}
				public function alluser(){
				$sql = "select * from  tbl_user";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				return $result;
				}
				public function deleteuser($id){
					$sql = "delete from  tbl_user where id= $id";
				$stmt = $this->db->PDO->prepare($sql);
				$result = $stmt->execute();
			}
				public function selectalluser($id){
					$sql = "select * from  tbl_user where id= $id";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				return $result;
				}
				public function updateuserbyid($name,$username,$email,$password,$role,$id){
					$sql = "update tbl_user set name= :name,username= :username,email= :email,password= :password,role= :role where id=$id";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':name',$name);
				$stmt->bindParam(':username',$username);
				$stmt->bindParam(':email',$email);
				$stmt->bindParam(':password',$password);
				$stmt->bindParam(':role',$role);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>User updated successfully;</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,User is not updated;</div>";
					return $nameerr;
				}
				}
				public function mailexist($mail){
				$sql = "select * from  tbl_user where email= '$mail'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->rowCount();
				return $result;
				}
				public function selectbymail($mail){
					$sql = "select * from  tbl_user where email= '$mail'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				return $result;
				}
				public function updatepass($newpass,$userid){
					$sql = "update tbl_user set password= :password where id='$userid'";
				$stmt = $this->db->PDO->prepare($sql);
				$stmt->bindParam(':password',$newpass);
				$done = $stmt->execute();
				if($done){
					$nameerr = "<div class='alert alert-success'>Password Changed successfully</div>";
					return $nameerr;
				}else{
					$nameerr = "<div class='alert alert-danger'>Sorry,Password is not updated;</div>";
					return $nameerr;
				}
				}
			}
?>