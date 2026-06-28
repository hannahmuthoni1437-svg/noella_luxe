<?php
session_start();
include "db.php";
include "header.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>
<link rel="stylesheet" href="style.css">
<div class="page-box">
<h2>Checkout </h2>

<table border="1" cellpadding="10">
<tr>
    <th>Bag</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total</th>
</tr>

<?php foreach ($cart as $id => $qty): 

    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    $row = $result->fetch_assoc();

    $subtotal = $row['price'] * $qty;
    $total += $subtotal;
?>

<tr>
    <td><?= $row['name'] ?></td>
    <td>Ksh <?= $row['price'] ?></td>
    <td><?= $qty ?></td>
    <td>Ksh <?= $subtotal ?></td>
</tr>

<?php endforeach; ?>

<tr>
    <td colspan="3"><b>Grand Total</b></td>
    <td><b>Ksh <?= $total ?></b></td>
</tr>
</table>

<br>

<!-- PAYMENT FORM -->
<form method="POST" action="place_order.php">

<h3>Payment Method</h3>

<label><input type="radio" name="payment" value="Cash" required> Cash on Delivery</label><br>
<label><input type="radio" name="payment" value="Mpesa"> M-Pesa</label><br>
<label><input type="radio" name="payment" value="Card"> Card</label><br><br>

<input type="text" name="name" placeholder="Full Name" required><br><br>
<input type="text" name="phone" placeholder="Phone Number" required><br><br>
<input type="text" name="address" placeholder="Delivery Address" required><br><br>

<button type="submit">Place Order</button>

</form>
</div>