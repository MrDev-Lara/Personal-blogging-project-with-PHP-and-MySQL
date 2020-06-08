<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');

	class blogger{
		private $db;
		private $per_page;
		private $start_page;
		public $cat;
		
		public function __construct(){
			$this->db = new database();
		}
		public function setstartpage($start_from){
			$this->start_page = $start_from;
		}
		public function setperpage($per_page){
			$this->per_page = $per_page;
		}
		public function selectpost(){
			$sql = "select * from tbl_post limit $this->start_page, $this->per_page";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		
		public function postselection($id){
			$sql = "select * from tbl_post where id= $id";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		public function rowcount(){
			$sql = "select * from tbl_post";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		}
		public function setcat($cat){
			$this->cat = $cat;
		}
		public function postselect(){
			$sql = "select * from tbl_post where cat= :cat order by rand()";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':cat',$this->cat);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		public function selectcategory(){
			$sql = "select * from  tbl_category";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		public function selectposts(){
			$sql = "select * from  tbl_post limit 3";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		public function selectpostbycat($id){
			$sql = "select * from tbl_post where cat= $id";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		public function selectall($search){
			$sql = "select * from tbl_post where title like '%$search%' or body like '%$search%'";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		
	}

?>