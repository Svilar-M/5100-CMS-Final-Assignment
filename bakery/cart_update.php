<?php
session_start();
include_once("include/database.php");

//print_r($_SESSION);
//exit();

if(!isset($_SESSION['user_id']) && ($_SESSION['user_status']) != 1 && ($_SESSION['user_status']) != 2) {
    header('Location: login.php');
}
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==3)
{
	$return_url = base64_decode($_GET["return_url"]); //return url
	session_destroy();
	header('Location:'.$return_url);
	}

if(isset($_POST["type"]) && $_POST["type"]=='add')
{
	if(isset($_SESSION['user_status']) == 3) {
	header('Location: index.php');
}
	$product_code 	= filter_var($_POST["product_code"], FILTER_SANITIZE_STRING); //product code
	$product_qty 	= filter_var($_POST["product_qty"], FILTER_SANITIZE_NUMBER_INT); //product code
	$return_url 	= base64_decode($_POST["return_url"]); //return url
	$results = "SELECT name,price FROM products WHERE product_code='$product_code' LIMIT 1";
	foreach($pdo->query($results) as $obj)

	if ($results) {
		$new_product = array(array('name'=>$obj->name, 'code'=>$product_code, 'qty'=>$product_qty, 'price'=>$obj->price));

		if(isset($_SESSION["products"]))
		{
			$found = false;

			foreach ($_SESSION["products"] as $cart_itm)
			{
				if($cart_itm["code"] == $product_code){

					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty, 'price'=>$cart_itm["price"]);
					$found = true;
				}else{
					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
				}
			}

			if($found == false) {
				$_SESSION["products"] = array_merge($product, $new_product);
			}else{
				$_SESSION["products"] = $product;
			}

		}else{
			$_SESSION["products"] = $new_product;
		}

	}

	header('Location:'.$return_url);
}

if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"]))
{
	$product_code 	= $_GET["removep"];
	$return_url 	= base64_decode($_GET["return_url"]);


	foreach ($_SESSION["products"] as $cart_itm) {
		if($cart_itm["code"]!=$product_code){
			$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
		}

		$_SESSION["products"] = $product;
	}
	header('Location:'.$return_url);
}
include "include/header.php";
include "include/menu.php";
?>

<?php
	include "include/footer.php";
?>