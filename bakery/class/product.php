<?php
class Product {
	function add($data, $image2) {
		include "include/database.php"; 
		$name 			= $data['name'];
		$description 	= $data['description'];
		$price 			= $data['price'];
		$stock 			= $data['stock'];
		$category_id 	= $data['category_id'];
		$special		= $data['special'];
		$status			= 1;
		$image			= "uploads/products/". $image2['image']['name'];
		$target_dir		= "uploads/products/";
		$target_file 	= $target_dir . basename($image2['image']["name"]);
		move_uploaded_file($image2['image']["tmp_name"], $target_file);

		$sql = "INSERT INTO products (name, description, price, stock, image, category_id, status, special) VALUES (:name, :description, :price, :stock, :image, :category_id, :status, :special)";
		$q = $pdo->prepare($sql);
		$q->execute(
			array(
				  ':name'=>$name,
				  ':description'=>$description,
				  ':price'=>$price,
				  ':stock'=>$stock,
				  ':image'=>$image,
				  ':category_id'=>$category_id,
				  ':status'=>$status,
				  ':special'=>$special
				)
			);
		return true;
	}
	
	function edit($id, $data, $image2) {
		include "include/database.php";
		echo $id;
		$name 			= $data['name'];
		$description 	= $data['description'];
		$price 			= $data['price'];
		$stock 			= $data['stock'];
		$category_id 	= $data['category_id'];
		$special		= $data['special'];
		$image			= "uploads/products/". $image2['image']['name'];
		
		$target_dir		= "uploads/products/";
		$target_file 	= $target_dir . basename($image2['image']["name"]);
		move_uploaded_file($image2['image']["tmp_name"], $target_file);

		// query
		$sql = "UPDATE products SET name = :name, description = :description, price = :price, stock = :stock, image = :image, category_id = :category_id, special = :special WHERE product_id = :id";
	
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':name'=>$name,
				  ':description'=>$description,
				  ':price'=>$price,
				  ':stock'=>$stock,
				  ':image'=>$image,
				  ':category_id'=>$category_id,
				  ':special'=>$special,
				  ':id'=>$id
				)
			);
		return true;
	}
function delete($id) {
		global $pdo;
		
		$sql = "DELETE FROM products WHERE product_id = :id";
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':id'=>$id)
		);
		
		return true;
	}	

	function get($id) {
		include "include/database.php";
		
		$sql = "SELECT * FROM products where product_id = :id";
		$q = $pdo->prepare($sql);
		$q->execute(
			array(':id'=>$id)
		);
		return $q->fetch();
	}
	
}

