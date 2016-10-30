<?php
session_start();
include "include/header.php";
include "include/menu.php";
include "include/database.php";
?>

    <div class="new">
	<section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <hr>
                    <h2 class="section-subheading text-muted">Categories</h2>
					<hr>
                </div>
				
            </div>
			<?php 
				$categories = "SELECT * FROM categories"; 
			?>
			
            <div class="row">
				<?php foreach($pdo->query($categories) as $row): ?>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="product_list.php?cat=<?php echo $row['category_id']; ?>" class="portfolio-link" data-toggle="#">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="<?php echo $row['image']; ?>" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <a href="product_list.php?cat=<?php echo $row['category_id']; ?>"><h4><?php echo $row['name']; ?></h4></a>
                    </div>
                </div>
				<?php endforeach; ?>
				
	</div>
        </div></section>
		
	
    <?php
        include "include/footer.php";
    ?>