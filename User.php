<?php

class User {

		private $username;
		private $password;

		public function __getUsername(){
			return $this->$username;
		}

		public function __getPassword(){
			return $this->$password;
		}

		public function __setUsername($username){
			$this->$username = $username;
		}

		public function __setPassword($password){
			$this->$password = $password;
		}
	}


?>