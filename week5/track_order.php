<?php
include "navbar.php";
include "db.php";
session_start();
$order = $_SESSION['order'] ?? null;
?>
<link rel="stylesheet" href="style.css">
<div class="page-box">
<h2>Order Tracking</h2>

<?php if (!$order): ?>

<p>No order found.</p>
<a href="index.php">Shop Now</a>

<?php else: ?>

<p><b>Name:</b> <?= $order['name'] ?></p>
<p><b>Phone:</b> <?= $order['phone'] ?></p>
<p><b>Address:</b> <?= $order['address'] ?></p>
<p><b>Payment:</b> <?= $order['payment'] ?></p>

<h3>Order Status:</h3>

<div>
    📦 PACKED → 🚚 OUT FOR DELIVERY → 🏠 DELIVERED
</div>

<p style="color:green;"><b>Current: <?= $order['status'] ?></b></p>

<form method="POST" action="update_status.php">
    <button type="submit">Mark as Delivered</button>
</form>

<?php endif; ?>
</div>