<?php
session_start();
include "db.php";
include "navbar.php";
include "header.php";

// Protect page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }
}

// Remove item
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
}
?>
<link rel="stylesheet" href="style.css">
<h2>Your Cart 🛍️</h2>

<a href="products.php">← Continue Shopping</a>

<table>
<tr>
    <th>Image</th>
    <th>Bag</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Action</th>
</tr>

<?php
$total = 0;

foreach ($_SESSION['cart'] as $id => $qty) {
    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    $row = $result->fetch_assoc();

    $subtotal = $row['price'] * $qty;
    $total += $subtotal;
?>

<tr>
    <!-- IMAGE -->
    <td>
        <img src="images/<?php echo $row['image']; ?>" width="80">
    </td>

    <!-- NAME -->
    <td><?php echo $row['name']; ?></td>

    <!-- PRICE -->
    <td>Ksh <?php echo $row['price']; ?></td>

    <!-- QUANTITY -->
    <td><?php echo $qty; ?></td>

    <!-- TOTAL -->
    <td>Ksh <?php echo $subtotal; ?></td>

    <!-- REMOVE -->
    <td>
        <a href="cart.php?remove=<?php echo $id; ?>">Remove ❌</a>
    </td>
</tr>

<?php } ?>

<tr>
    <td colspan="4"><strong>Grand Total </strong></td>
    <td colspan="2">Ksh <?php echo $total; ?></td>
</tr>

</table>
<a href="checkout.php">
    <button>Proceed to checkout</button>
</a>
