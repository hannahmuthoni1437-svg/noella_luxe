<?php
session_start();

$_SESSION['order'] = [
    "name" => $_POST['name'],
    "phone" => $_POST['phone'],
    "address" => $_POST['address'],
    "payment" => $_POST['payment'],
    "status" => "PACKED"
];

unset($_SESSION['cart']);
?>
<link rel="stylesheet" href="style.css">
<div class="page-box">
<h2>🎉 Order Placed Successfully</h2>

<p><b>Payment Method:</b> <?= $_SESSION['order']['payment'] ?></p>

<h3 style="color:green;">Status: PACKED 📦</h3>

<a href="track_order.php">
    <button>Track Order</button>
</a>
</div>