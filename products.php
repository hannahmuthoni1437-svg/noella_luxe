<?php
include "db.php";
include "header.php";

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM products");
?>


<link rel="stylesheet" href="style.css">

<nav>
    <a href="products.php">Shop 👜</a>
    <a href="cart.php">Cart 🛍</a>
    <a href="logout.php">Logout</a>
</nav>

<h1>Our Bags Collection 👜</h1>

<div class="product-grid">

<?php while ($row = $result->fetch_assoc()) { ?>

    <div class="card">
        <img src="images/<?php echo $row['image']; ?>" width="150">

        <h3><?php echo $row['name']; ?></h3>
        <p>Ksh <?php echo $row['price']; ?></p>
        <small><?php echo $row['category']; ?></small>

        <!-- FIXED ADD TO CART -->
        <a href="cart.php?id=<?php echo $row['id']; ?>">
            <button>Add to Cart </button>
        </a>

    </div>

<?php } ?>

</div>