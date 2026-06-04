<!DOCTYPE html>
<html>
<head>
    <title>Bags Collection Shop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>


<!-- 🌸 TOP BAR -->
<div class="topbar">
    <span class="menu-btn" onclick="openMenu()">☰</span>
    <h2>Noella Luxe 👜✨</h2>
</div>

<!-- 📱 SIDE MENU -->
<div id="myMenu" class="sidemenu">

    <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">×</a>

    <a href="home.php">Home 🏠</a>
    <a href="products.php">Shop 👜</a>
    <a href="cart.php">Cart 🛒</a>
    <a href="admin_dashboard.php">Admin dashboard</a>

    <?php if(isset($_SESSION['user'])) { ?>
        <a href="admin_dashboard.php">Admin 👑</a>
        <a href="logout.php">Logout 🚪</a>
    <?php } else { ?>
        <a href="login.php">Login 🔐</a>
        <a href="register.php">Register ✍️</a>
    <?php } ?>

</div>

<!-- HERO TITLE -->
<div class="container">
    <h1>Welcome to Bags Collection 💖👜</h1>
    <p style="text-align:center;">Luxury • Coach • Affordable • School Bags 🎒</p>
</div>

<!-- 🌸 FEATURED 4 BAG IMAGES -->
<div class="container">
    <h2>Featured Bags ✨</h2>

    <div class="product-grid">

        <!-- Bag 1 -->
        <div class="card">
            <img src="images/birkin.jpg" alt="Birkin Bag">
            <h3>Birkin Style Luxury</h3>
    
        </div>

        <!-- Bag 2 -->
        <div class="card">
            <img src="images/coach.jpg" alt="Coach Bag">
            <h3>Coach Inspired Bag</h3>
    
        </div>

        <!-- Bag 3 -->
        <div class="card">
            <img src="images/tote.jpg" alt="tote Bag">
            <h3>Tote Bag</h3>
            
        </div>

        <!-- Bag 4 -->
        <div class="card">
            <img src="images/schoolbag.jpg" alt="School Bag">
            <h3>School Backpack 🎒</h3>
            
        </div>

    </div>
</div>

<!-- CALL TO ACTION -->
<div class="container" style="text-align:center;">
    <a href="products.php">
        <button>Shop All Bags 👜💖</button>
    </a>
</div>
<script>
function openMenu() {
    document.getElementById("myMenu").style.width = "250px";
}

function closeMenu() {
    document.getElementById("myMenu").style.width = "0";
}
</script>

<!-- FOOTER -->
<footer>
    <p>Made with 💖 by Noella | Bags Collection Shop</p>
</footer>


</body>
</html>