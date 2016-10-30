<?php 
	include "include/database.php";
?>
<aside class="top-sidebar">
	<article>
	<h2 class="proizvod">Categories</h2>
		<div>
		<?php 
			$categories = "SELECT * FROM categories";
			foreach($pdo->query($categories) as $row): 
		?>
			<a href="product_list.php?cat=<?php echo $row['category_id']; ?>" class="list-group-item"><?php echo $row['name']; ?></a>
		<?php endforeach; ?>
		</div>
	</article>
</aside>