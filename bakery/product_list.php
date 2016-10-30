<?php
session_start();
include "include/header.php";
include "include/menu.php";
include "include/database.php";
?>
<?php $category_id = $_GET['cat']; ?>
<div class="row">
	<div class="col-lg-12 text-center">
					<hr>
					<h2 class="section-subheading text-muted">Product List!</h2>
					<hr>
				</div>
	<?php include "include/category-side.php"; ?>
	<?php 
 if(isset($_GET['id'])) {
 	include_once "class/product.php";
	$product_id = $_GET['id'];
	$products = new Product();
	if($products->get($product_id) == true) {
		header('Location: cart_index.php');
	}
}	
?>
    <div class="col-md-9">

		<div class="row">
			<?php 
				$has_products = false;
				$products = "SELECT * 
						FROM products 
						WHERE products.special <> 0 
						AND products.status = 1 
						AND products.category_id = $category_id
						ORDER BY products.product_id ASC";
				foreach($pdo->query($products) as $row):
				$has_products = true;
			?>
			<a href="cart_index.php?id=<?php echo $row['product_id']; ?>">
		<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
				<img src="<?php echo $row['image']; ?>" alt="">
				<div class="caption">
					<h4><?php echo $row['name']; ?></h4>
					<h4 class="pull-right">$<?php echo $row['price']; ?></h4>
					<p><?php if($row['description'] != "") { 
							if(strlen($row['description']) > 40) {
								echo substr($row['description'], 0, 40) ."..."; 
							} else {
								echo $row['description'];
							} 
						}
						?></p>
				</div>
			
			</div>
		</div>
	</a>
			<?php endforeach; ?>
			<?php if($has_products == false): ?>
				<p>No products in this category</p>
			<?php endif; ?>
		</div>
	</div>
</div><!-- /.container -->
<?php
include "include/footer.php";
?>