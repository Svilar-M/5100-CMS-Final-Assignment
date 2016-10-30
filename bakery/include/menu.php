
    <header class="mainHeader">
		<img src="uploads/logo.gif">
		
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<nav class="navbar-collapse collapse pull-left">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="categories.php">Categories</a></li>
					
				</ul>
				<div class="desno">
					<ul>
				<?php if(isset($_SESSION['user_id']) && ($_SESSION['user_status'] == 1)): ?>
					
					<li ><a href="admin_products.php">Products</a></li>
					<li ><a href="admin_users.php">Users</a></li>
					<li ><a href="admin_categories.php">Categories</a></li>
					<li ><a href="admin_cart.php">Cart</a></li>
					<?php endif; ?>
						<?php if(isset($_SESSION['user_id'])): ?>
							<li><a href="logout.php">Logout</a></li>
						<?php else: ?>
							<li><a href="registration.php">Sign up</a></li>
							<li><a href="login.php">Login</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</nav>
		</div>
		
	</header>