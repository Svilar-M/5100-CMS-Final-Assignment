<?php
session_start();
include "include/database.php";
include "include/header.php";
include "include/menu.php";
if(!isset($_SESSION['user_id']) && ($_SESSION['user_status']) != 1 && ($_SESSION['user_status']) != 2) {
    header('Location: login.php');
}
?>
<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<hr>
					<h2 class="section-subheading text-muted">VIEW CART</h2>
					<hr>
				</div>
			</div>
		</div>
 <div class="view-cart">
 	<?php


 	if(isset($_POST['submit'])) {
	include_once("class/cart.php");
	$data = $_POST;
	$carts = new Cart();
    if($carts->add($data) == true) {
		header('Location: cart_view.php');
	}
}

 	$rez = 0;
    $current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	if(isset($_SESSION["products"]))
    {

	    $total = 0;
		echo '<form method="post" action="cart_process.php">';
		echo '<ul>';
		$cart_items = 0;
		foreach ($_SESSION["products"] as $cart_itm)
        {
        	
           $product_code = $cart_itm["code"];
		
		  $results = "SELECT name,description,price,image FROM products WHERE product_code='$product_code'  LIMIT 1";
		   foreach($pdo->query($results) as $obj);
		   
		    echo '<li class="cart-itm">';
			echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
			echo '<div class="product-thumb"><img src="'.$obj['image'].'"></div>';
			echo '<div class="p-price">'.$currency.$obj['price'].'</div>';
            echo '<div class="product-info">';
			echo '<h3>'.$obj['name'].' (Code :'.$product_code.')</h3> ';
            echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
            echo '<div>'.$obj['description'].'</div>';
			echo '</div>';
            echo '</li>';
			$subtotal = ($obj['price']*$cart_itm["qty"]);
			$total = ($total + $subtotal);

			echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$obj['name'].'" />';
			echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$product_code.'" />';
			echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$obj['description'].'" />';
			echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$cart_itm["qty"].'" />';
			$cart_items ++;
			
        }
    	echo '</ul>';
		echo '<span class="check-out-txt">';
		echo '<strong>Total : '.$currency.$total.'</strong>  ';
		echo '<input type="submit" value="Pay Now" />';
		echo '</span>';
		echo '</form>';
		
    }else{
		echo 'Your Cart is empty';
	}
	

    ?>
    </div>

<?php
	include "include/footer.php";
?>
