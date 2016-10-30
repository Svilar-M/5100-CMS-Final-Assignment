<?php
	session_start();
	include "include/database.php";
	include "include/header.php";
	include "include/menu.php";
	
?>
<div class="row">
<?php 
include "include/slider.php"; 
include "include/category-side.php";	
?>
 	
<!-- Proizvodi -->
	<div class="new">
	<section id="portfolio" class="bg-light-gray">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<hr>
					<h2 class="section-subheading text-muted">Products</h2>
					<hr>
				</div>
			</div>
		</div>
	</section>
</div>
  
<div class="row">
	<?php 
				$has_products = false;
				$products = "SELECT * 
						FROM products 
						WHERE products.special <> 0 
						AND products.status = 1 
						ORDER BY products.product_id ASC";
				foreach($pdo->query($products) as $row):
				$has_products = true;
			?>
	<a href="cart_index.php?id=<?php echo $row['product_id']; ?>">
		<div class="col-sm-2 col-lg-2 col-md-2">
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
</div>
<?php
	include "include/footer.php";
?>
