<?php
session_start();
if(!isset($_SESSION['user_id']) && $_SESSION['user_status'] != 1) {
	header('Location: index.php');
}

include "include/header.php";
include "include/menu.php";
include "include/database.php";



if(isset($_POST['submit'])) {
	include_once("class/category.php");
	$data = $_POST;
	$image = $_FILES;
	$categories = new Category();
    if($categories->add($data, $image) == true) {
		header('Location: admin_categories.php');
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
					<td>Image</td>
					<td><input type="file" name="image"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Add Category" name="submit"></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
<?php include "include/footer.php"; ?>