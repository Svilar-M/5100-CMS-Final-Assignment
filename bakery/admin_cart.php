<?php
session_start();
if(!isset($_SESSION['user_status']) ) {
	header('Location: index.php');
}
include "include/header.php";
include "include/menu.php";
include "include/database.php";

if(isset($_POST['submit'])) {
	include_once("class/Cart.php");
	$data = $_POST;
	$cart = new Cart();
    if($cart->add($data) == true) {
		header('Location: admin_cart.php');
	}
}

?>
<div class="row">
    <div class="col-md-9">
		<div class="row">
			
			<table border="1" width="100%">
			<tr>
				<th>Name</th>
				<th>Product</th>
				<th>Date</th>

			<?php 
				$rez = "SELECT user_name,user_surname,name, date from carts JOIN products ON carts.product=products.product_id JOIN users ON carts.user=users.user_id";
				foreach($pdo->query($rez) as $row):
			?>
			<tr>
				<td><?php echo $row['user_name'] . ' ' . $row['user_surname']; ?></td>
			     <td><?php echo $row['name']; ?></td>

			<td><?php echo $row['date']; ?></td>

			</tr>

			<?php endforeach; ?>
			
			</table>

		</div>
	</div>
</div>
<?php
include "include/footer.php";
?>