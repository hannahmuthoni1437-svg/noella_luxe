<?php
session_start();

$product = $_POST['product'];

$_SESSION['cart'][] = $product;

header("Location: products.php");
?>