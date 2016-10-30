<?php 
try {
	$pdo = new PDO('mysql:host=localhost;dbname=bakery', 'root', 'root');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $err) {
	die($err->getMessage());
}
$currency = '$';