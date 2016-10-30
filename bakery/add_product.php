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
	$data = $_POST;
	$image = $_FILES;
	$products = new Product();
    if($products->add($data, $image) == true) {
		header('Location: admin_products.php');
	}
}

?>
<div class="row">
    <div class="col-md-9">
		<div class="row">
			<form enctype="multipart/form-data" method="post">
			<table>
				<tr>
					<td>Name</td>
					<td><input type="text" value="" name="name"></td>
				</tr>
				<tr>
					<td>Description</td>
					<td><textarea name="description"></textarea></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><input type="text" value="" name="price"></td>
				</tr>
				<tr>
					<td>Stock</td>
					<td><input type="text" value="" name="stock"></td>
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
							<option value="<?php echo $row['category_id']; ?>"><?php echo $row['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Special Product</td>
					<td>
						<select name="special">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Add Product" name="submit"></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
<?php
include "include/footer.php";
?>