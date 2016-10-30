<?php
session_start();
if(!isset($_SESSION['user_id']) && $_SESSION['user_status'] != 1) {
	header('Location: index.php');
}

include "include/header.php";
include "include/menu.php";
include "include/database.php";

if(isset($_POST['submit'])) {
	include_once("class/user.php");
	$data 		= $_POST;
	$user_id 	= $_GET['id'];
	$user 	= new User();
    if($user->edit($user_id, $data) == true) {
		header('Location: admin_users.php');
	}
}

if(isset($_GET['id'])) {
	include_once("class/user.php");
	$id = $_GET['id'];
	$user = new User();
    $user = $user->get($id);
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
					<td><input type="text" value="<?php echo $user['user_name']; ?>" name="user_name"></td>
				</tr>
				<tr>
					<td>Surname</td>
					<td><input type="text" value="<?php echo $user['user_surname']; ?>" name="user_surname"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" value="<?php echo $user['user_email']; ?>" name="user_email"></td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<select name="user_status">
							<option value="1" <?php if($user['user_status'] == 1) { echo "selected"; } ?>>Admin</option>
							<option value="2" <?php if($user['user_status'] == 2) { echo "selected"; } ?>>User</option>
							<option value="3" <?php if($user['user_status'] == 3) { echo "selected"; } ?>>Unapprove User</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Add User" name="submit"></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
<?php
include "include/footer.php";
?>