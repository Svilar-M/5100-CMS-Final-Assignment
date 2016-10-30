<?php
session_start();
include_once"include/database.php";
include "include/header.php";
include "include/menu.php";

?>
<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <hr>
                    <h2 class="section-subheading text-muted">CART INDEX</h2>
                    <hr>
                </div>
            </div>
        </div>
<div id="products-wrapper">
    <div class="products">
    <?php

	$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $id = 0;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
   

	$results = "SELECT * FROM products WHERE product_id = $id";
    if ($results) { 
	
        //fetch results set as object and output HTML
        foreach($pdo->query($results) as $obj)
        {
			echo '<div class="product">'; 
            echo '<form method="post" action="cart_update.php">';
			echo '<div class="product-thumb"><img src="'.$obj['image'].'"></div>';
            echo '<div class="product-content"><h3>'.$obj['name'].'</h3>';
            echo '<div class="product-desc">'.$obj['description'].'</div>';
            echo '<div class="product-info">';
			echo 'Price '.$currency.$obj['price'].' | ';
            echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
			echo '<button class="add_to_cart">Add To Cart</button>';
			echo '</div></div>';
            echo '<input type="hidden" name="product_code" value="'.$obj['product_code'].'" />';
            echo '<input type="hidden" name="type" value="add" />';
			echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
            echo '</form>';
            echo '</div>';
        }
    
    }
    ?>
    </div>
    
<div class="shopping-cart">
<h2>Your Shopping Cart</h2>
<?php

if(isset($_SESSION["products"]))
{

    $results = "SELECT * FROM products WHERE product_id = $id";
    foreach($pdo->query($results) as $obj){
    $total = 0;
    echo '<ol>';
        $cart_itm['name']=$obj['name'];
    foreach ($_SESSION["products"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
        echo '<h3>'.$obj['name'].'</h3>';

        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
        echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
        echo '<div class="p-price">Price :'.$currency.$obj["price"].'</div>';
        echo '</li>';
        $subtotal = ($obj["price"]*$cart_itm["qty"]);
        $total = ($total + $subtotal);
    }
    echo '</ol>';
    echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> <a href="cart_view.php">Check-out!</a></span>';
	echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
    
}
}

else{
    echo 'Your Cart is empty';
}

?>
</div>
  
</div>

<?php
    include "include/footer.php";
?>

