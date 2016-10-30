<?php
session_start();
if(!isset($_SESSION['user_id']) && $_SESSION['user_status'] != 1) {
	header('Location: index.php');
}
include "include/header.php";
include "include/menu.php";
include "include/database.php";

if(isset($_GET['edit'])) {
	include_once("class/category.php");
	$category_id = $_GET['id'];
	$categories = new Category();
	if($categories->delete($category_id) == true) {
		header('Location: admin_categories.php');
	}
}

?>
<div class="row">
    <div class="col-md-9">
		<div class="row">
			<a href="add_category.php">Add Category</a><br /><br />
			<table border="1" width="100%">
			<tr>
				
				<th>Category</th>
				
				<th colspan="2">Actions</th>
			</tr>
			<?php 
				$has_categories = false;
				$categories = "SELECT categories.*, categories.name as category_name
						FROM categories
						ORDER BY categories.category_id ASC";
				foreach($pdo->query($categories) as $row):
				$has_categories = true;
			?>
			<tr>
				
				<td><?php echo $row['category_name']; ?></td>
				
				<td><a href="edit_category.php?id=<?php echo $row['category_id']; ?>">Edit</a></td>
				<td><a href="admin_categories.php?edit=true&id=<?php echo $row['category_id']; ?>">Remove</a></td>
			</tr>
			<?php endforeach; ?>
			<?php if($has_categories == false): ?>
				<p>No products in this category</p>
			<?php endif; ?>
			</table>
		</div>
	</div>
</div>
<?php
include "include/footer.php";
?>