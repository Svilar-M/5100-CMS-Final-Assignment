<?php
session_start();
if(!isset($_SESSION['user_id']) && $_SESSION['user_status'] != 1) {
	header('Location: index.php');
}
include "include/header.php";
include "include/menu.php";
include "include/database.php";

$categories = "SELECT * FROM categories ORDER BY categories.name ASC";

if(isset($_POST['submit'])) {
	include_once("class/product.php");
	$data 		= $_POST;
	$image 		= $_FILES;
	$product_id = $_GET['id'];
	$products 	= new Product();
    if($products->edit($product_id, $data, $image) == true) {
		header('Location: admin_products.php');
	}
}

if(isset($_GET['id'])) {
	include_once("class/product.php");
	$id = $_GET['id'];
	$products = new Product();
    $product = $products->get($id);
} else {
	header('Location: admin_products.php');
}

?>
<div class="row">
    <div class="col-md-9">
		<div class="row">
			<form enctype="multipart/form-data" method="post">
			<table>
				<tr>
					<td>Name</td>
					<td><input type="text" value="<?php echo $product['name']; ?>" name="name"></td>
				</tr>
				<tr>
					<td>Description</td>
					<td><textarea name="description"><?php echo $product['description']; ?></textarea></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><input type="text" value="<?php echo $product['price']; ?>" name="price"></td>
				</tr>
				<tr>
					<td>Stock</td>
					<td><input type="text" value="<?php echo $product['stock']; ?>" name="stock"></td>
				</tr>
				<tr>
					<td>Image</td>
					<td><input type="file" name="image"></td>
				</tr>
				<tr>
					<td>Category</td>
					<td>
						<select name="category_id">
							<?php foreach($pdo->query($categories) as $row): ?>
							<option value="<?php echo $row['category_id']; ?>" <?php if($row['category_id'] == $product['category_id']) { echo "selected"; } ?>><?php echo $row['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Special Product</td>
					<td>
						<select name="special">
							<option value="0" <?php if($product['special'] == 0) { echo "selected"; }?> >No</option>
							<option value="1" <?php if($product['special'] == 1) { echo "selected"; }?> >Yes</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Edit Product" name="submit"></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
<?php
include "include/footer.php";
?>