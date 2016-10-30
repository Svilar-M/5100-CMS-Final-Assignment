<?php
class Cart{
function add($data) {
		global $pdo;
		 
		$ime 			= $data['ime'];
		$prezime 		= $data['prezime'];
		$naziv 			= $data['naziv'];
		$date 			= $data['date'];

		$sql = "INSERT INTO carts (ime,prezime,naziv,date) VALUES (:ime, :prezime, :naziv, :date)";
		
		$q = $pdo->prepare($sql);
		$q->execute(
			array(
					':ime'=>$ime,
				  	':prezime'=>$prezime,
				  	':naziv'=>$naziv,
				  	':date'=>$date,
				  
				)
			);
		return true;
	}