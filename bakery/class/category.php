<?php
class Category {

	function add($data, $image2) {
		include "include/database.php";
		
		$name 			= $data['name'];
		$description 	= $data['description'];
		$image			= "uploads/categories/". $image2['image']['name'];
		
		$target_dir		= "uploads/categories/";
		$target_file 	= $target_dir . basename($image2['image']["name"]);
		move_uploaded_file($image2['image']["tmp_name"], $target_file);

		$sql = "INSERT INTO categories (name, description, image) VALUES (:name, :description, :image)";
		
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':name'=>$name,
				  ':description'=>$description,
				  ':image'=>$image 
				)
			);
		return true;
	}

	function edit($id, $data, $image2) {
		include "include/database.php";
		echo $id;
		$name 			= $data['name'];
		$description 	= $data['description'];
		$image			= "uploads/categories/". $image2['image']['name'];
		
		$target_dir		= "uploads/categories/";
		$target_file 	= $target_dir . basename($image2['image']["name"]);
		move_uploaded_file($image2['image']["tmp_name"], $target_file);

		$sql = "UPDATE categories SET name = :name, description = :description, image = :image WHERE category_id=:id";
	
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':name'=>$name,
				  ':description'=>$description,
				  ':image'=>$image,
				  ':id'=>$id
				)
			);
		return true;
	}
	function delete($id) {
		include "include/database.php";
		
		$sql = "DELETE FROM categories WHERE category_id = :id";
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':id'=>$id)
		);
		
		return true;
	}
	
	function get($id) {
		include "include/database.php";
		
		$sql = "SELECT * FROM categories where category_id = :id";
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':id'=>$id)
		);
		return $q->fetch();
	}
}

