<?php
include('db.php');

$category = "coach";

$stmt = $conn->prepare("DELETE FROM products WHERE category=?");
$stmt->bind_param("s", $category);
$stmt->execute();

header("Location: products.php");
exit();
echo "Deleted products in category: $category";
?>