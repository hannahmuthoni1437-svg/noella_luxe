<?php
session_start();
include("db.php");
include "header.php";

// check cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Cart is empty");
}

// get form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment = $_POST['payment'];

// generate order id
$order_id = "ORD-" . rand(10000, 99999);

// calculate total
$total_amount = 0;
foreach ($_SESSION['cart'] as $item) {
$price =isset($item['price']) ? $item['price'] : 0;
$quantity = isset($item['quantity']) ? $item['quantity'] : 1;
$total_amount += $price * $quantity;
}

// insert into database
$sql = "INSERT INTO orders 
(order_id, customer_name, phone, address, payment_method, total_amount, status)
VALUES 
('$order_id', '$name', '$phone', '$address', '$payment', '$total_amount', 'PACKED')";

if (!mysqli_query($conn, $sql)) {
    die("Error inserting order: " . mysqli_error($conn));
}

// optional session storage for display
$_SESSION['order'] = [
    "order_id" => $order_id,
    "name" => $name,
    "phone" => $phone,
    "address" => $address,
    "payment" => $payment,
    "total_amount" => $total_amount,
    "status" => "PACKED"
];

// clear cart
unset($_SESSION['cart']);
?>

<link rel="stylesheet" href="style.css">

<div class="page-box">
    <h2>🎉 Order Placed Successfully</h2>

    <p><b>Order ID:</b> <?= $order_id ?></p>
    <p><b>Total_amount:</b> KES <?= $total_amount ?></p>
    <p><b>Payment:</b> <?= $payment ?></p>

    <h3 style="color:green;">Status: PACKED 📦</h3>

    <a href="track_order.php?order_id=<?= $order_id ?>">
        <button>Track Order</button>
    </a>
</div>