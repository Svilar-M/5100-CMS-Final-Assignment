<?php
session_start();

include "include/header.php";
include "include/menu.php";
include "include/database.php";


if(isset($_POST['submit'])) {
	include_once("class/category.php");
	$data 		= $_POST;
	$image 		= $_FILES;
	$category_id = $_GET['id'];
	$categories 	= new Category();
    if($categories->edit($category_id, $data, $image) == true) {
		header('Location: admin_categories.php');
	}
}

if(isset($_GET['id'])) {
	include_once("class/category.php");
	$id = $_GET['id'];
	$categories = new Category();
    $category = $categories->get($id);
} else {
	header('Location: admin_categories.php');
}

?>
<div class="row">
    <div class="col-md-9">
		<div class="row">
			<form enctype="multipart/form-data" method="post">
			<table>
				<tr>
					<td>Name</td>
					<td><input type="text" value="<?php echo $category['name']; ?>" name="name"></td>
				</tr>
				<tr>
					<td>Description</td>
					<td><textarea name="description"><?php echo $category['description']; ?></textarea></td>
				</tr>
				
				<tr>
					<td>Image</td>
					<td><input type="file" name="image"></td>
				</tr>
				
				
				<tr>
					<td colspan="2"><input type="submit" value="Edit Category" name="submit"></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
<?php
include "include/footer.php";
?>