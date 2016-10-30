<?php
class User {
	
	function add($data) {
		global $pdo;
		
		$name 		= $data['name'];
		$surname 	= $data['surname'];
		$email 		= $data['email']; 
		$password 	= $data['password'];
		
		// query
		$sql = "INSERT INTO users (user_name, user_surname, user_email, user_password, user_status) VALUES (:user_name, :user_surname, :user_email, :user_password, :user_status)";
		$q = $pdo->prepare($sql);
		$q->execute(
					array(':user_name'=>$name,
						  ':user_surname'=>$surname,
						  ':user_email'=>$email,
						  ':user_password'=>md5($password),
						  ':user_status'=>3
						)
					);
		return true;
	}
	
	function edit($id, $data) {
		global $pdo;
		
		$user_name 		= $data['user_name'];
		$user_surname 	= $data['user_surname'];
		$user_email		= $data['user_email'];
		$user_status	= $data['user_status'];
		
		// query
		$sql = "UPDATE users SET user_name = :user_name, user_surname = :user_surname, user_email = :user_email, user_status = :user_status WHERE user_id = :id";
	
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':user_name'=>$user_name,
				  ':user_surname'=>$user_surname,
				  ':user_email'=>$user_email,
				  ':user_status'=>$user_status,
				  ':id'=>$id
				)
			);
		return true;
	}
	
	function delete($id) {
		global $pdo;
		
		$sql = "DELETE FROM users WHERE user_id = :id";
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':id'=>$id)
		);
		
		return true;
	}
	
	function get($id) {
		global $pdo;;
		
		$sql = "SELECT * FROM users where user_id = :id";
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':id'=>$id)
		);
		return $q->fetch();
	}
}
	


