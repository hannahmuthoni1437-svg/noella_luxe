<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard - Noella Luxe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- 🌸 NAVBAR (YOUR FULL MENU) -->
<nav class="navbar">
    <h2>Noella Luxe 👜✨</h2>

    <div>
       
        <a href="index.php">home</a>
        <a href="#featured">Featured 👜</a>
        <a href="products.php">Shop 🛍️</a>
        <a href="cart.php">Cart 🛒</a>

        <?php if(isset($_SESSION['user'])) { ?>
            <a href="admin_dashboard.php">Admin 👑</a>
            <a href="logout.php">Logout 🚪</a>
        <?php } else { ?>
            <a href="login.php">Login 🔐</a>
            <a href="register.php">Register ✍️</a>
        <?php } ?>
    </div>
</nav>

<!-- 🏠 HERO SECTION -->
<div style="text-align:center; padding:30px;">
    <h1>Welcome to Noella Luxe 👜✨</h1>
    <p>Shop your dream bags 💖</p>
</div>

<!-- 👜 FEATURED PRODUCTS -->
<h2 id="featured" style="text-align:center;">Featured Bags ✨</h2>

<div style="display:flex; flex-wrap:wrap; justify-content:center;">

<?php
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 6");

while($row = mysqli_fetch_assoc($result)){
?>

<div style="background:white; margin:15px; padding:15px; border-radius:15px; width:200px; text-align:center; box-shadow:0 0 10px #ddd;">

    <!-- IMAGE -->
    <img src="images/<?php echo $row['image']; ?>" width="150" style="border-radius:10px;"><br><br>

    <!-- NAME -->
    <b><?php echo $row['name']; ?></b><br>

    <!-- PRICE -->
    Ksh <?php echo $row['price']; ?><br>

    <!-- CATEGORY -->
    <small><?php echo $row['category']; ?></small>

    <br><br>

    <!-- 🛒 ADD TO CART -->
    <a href="cart.php?id=<?php echo $row['id']; ?>">
        <button style="background:pink; border:none; padding:8px; border-radius:5px; color:white;">
            Add to Cart 🛒
        </button>
    </a>

</div>

<?php } ?>

</div>

<!-- 📌 QUICK LINKS SECTION -->
<hr>

<div style="text-align:center; margin:30px;">

    <h2>Quick Access ⚡</h2>

    <a href="products.php"><button>Shop 🛍️</button></a>
    <a href="cart.php"><button>Cart 🛒</button></a>
    <a href="login.php"><button>Login 🔐</button></a>
    <a href="register.php"><button>Register ✍️</button></a>

    <?php if(isset($_SESSION['user'])) { ?>
        <a href="admin_dashboard.php"><button>Admin 👑</button></a>
    <?php } ?>

</div>

</body>
</html>