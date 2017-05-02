<?php
	class Student {

		private $ID;
		private $name;
		private $username;
		private $password;

		public function __getName(){
			return $this->$name;
		}

		public function __getID(){
			return $this->$ID;
		}

		public function __getUsername(){
			return $this->$username;
		}

		public function __getPassword(){
			return $this->$password;
		}

		public function __setName($name){
			$this->$name = $name;
		}

		public function __setID($id){
			$this->$ID = $id;
		}

		public function __setUsername($username){
			$this->$username = $username;
		}

		public function __setPassword($password){
			$this->$password = $password;
		}
	}


?>