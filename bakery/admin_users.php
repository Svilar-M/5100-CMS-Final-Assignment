<?php
session_start();
if(!isset($_SESSION['user_id']) && $_SESSION['user_status'] != 1) {
	header('Location: index.php');
}
include "include/header.php";
include "include/menu.php";
include "include/database.php";

if(isset($_GET['edit'])) {
	include_once("class/user.php");
	$user_id = $_GET['id'];
	$users = new User();
	if($users->delete($user_id) == true) {
		header('Location: admin_users.php');
	}
}

?>
<div class="row">
    <div class="col-md-9">
		<div class="row">
			<table border="1" width="100%">
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th colspan="2">Actions</th>
			</tr>
			<?php 
				$users = "SELECT * FROM users ORDER BY users.user_name ASC";
				foreach($pdo->query($users) as $row):
			?>
			<tr>
				<td><?php echo $row['user_name'] .' '. $row['user_surname']; ?></td>
				<td><?php echo $row['user_email']; ?></td>
				<td><?php 
					if($row['user_status'] == 1) { 
						echo "Admin"; 
					} elseif($row['user_status'] == 2) { 
						echo "User"; 
					} elseif($row['user_status'] == 3) {
						echo "Need to Approve";
					} 
				?></td>
				<td><a href="edit_user.php?id=<?php echo $row['user_id']; ?>">Edit</a></td>
				<td><a href="admin_users.php?edit=true&id=<?php echo $row['user_id']; ?>">Remove</a></td>
			</tr>
			<?php endforeach; ?>
			</table>
		</div>
	</div>
</div>
<?php
include "include/footer.php";
?>