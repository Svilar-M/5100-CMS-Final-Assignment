<?php
session_start();
  if(!isset($_SESSION['user_id']) && $_SESSION['user_status'] != 1) {
	 header('Location: index.php');
 }
include "include/header.php";
include "include/menu.php";
include "include/database.php";

if(isset($_GET['edit'])) {
	include_once("class/product.php");
	$product_id = $_GET['id'];
	$products = new Product();
	if($products->delete($product_id) == true) {
		header('Location: admin_products.php');
	}
}

?>
<div class="row">
    <div class="col-md-9">
		<div class="row">
			<a href="add_product.php">Add Product</a><br /><br />
			<table border="1" width="100%">
			<tr>
				<th>Name</th>
				<th>Category</th>
				<th>Special</th>
				<th colspan="2">Actions</th>
			</tr>
			<?php 
				$has_products = false;
				$products = "SELECT products.*, categories.name as category_name
						FROM products 
						JOIN categories ON categories.category_id = products.category_id
						WHERE products.status = 1
						ORDER BY products.product_id ASC";
				foreach($pdo->query($products) as $row):
				$has_products = true;
			?>
			<tr>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['category_name']; ?></td>
				<td><?php if($row['special'] == 1) { echo "Yes"; } else { echo "No"; } ?></td>
				<td><a href="edit_product.php?id=<?php echo $row['product_id']; ?>">Edit</a></td>
				<td><a href="admin_products.php?edit=true&id=<?php echo $row['product_id']; ?>">Remove</a></td>
			</tr>
			<?php endforeach; ?>
			<?php if($has_products == false): ?>
				<p>No products in this category</p>
			<?php endif; ?>
			</table>
		</div>
	</div>

<?php
include "include/footer.php";
?>
</div>