<?php
session_start();
include("db.php");

// Protect page
if(!isset($_SESSION['admin']) == true){
    header("Location: login.php");
    exit();
}

// ➕ ADD PRODUCT
if(isset($_POST['add'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp, "images/".$image);

    mysqli_query($conn, "INSERT INTO products (name, price, category, image)
                         VALUES ('$name','$price','$category','$image')");

    header("Location: admin_dashboard.php?msg=added");
    exit();
}

// 🗑 DELETE PRODUCT
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

    header("Location: admin_dashboard.php?msg=deleted");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<!-- 🌸 NAVBAR -->
<nav class="navbar">
    <h2>Admin Dashboard </h2>

    <div>
        <a href="dashboard.php">Home 🏠</a>
        <a href="products.php">Shop 🛍️</a>
        <a href="cart.php">Cart 🛒</a>
        <a href="logout.php">Logout </a>
    </div>
</nav>

<!-- 💬 SUCCESS MESSAGES -->
<?php
if(isset($_GET['msg']) && $_GET['msg'] == "added"){
    echo "<p style='color:green; text-align:center;'>Product added successfully 👜✨</p>";
}

if(isset($_GET['msg']) && $_GET['msg'] == "deleted"){
    echo "<p style='color:red; text-align:center;'>Product deleted successfully 🗑️</p>";
}
?>

<!-- ➕ ADD PRODUCT FORM -->
<div class="login-container">

    <h2>Add New Bag 👜</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="name" placeholder="Bag Name" required>

        <input type="number" name="price" placeholder="Price" required>

        <input type="text" name="category" placeholder="Category" required>

        <input type="file" name="image" required>

        <button name="add">Add Product ➕</button>

    </form>

</div>

<hr>

<!-- 👀 VIEW PRODUCTS -->
<h2 style="text-align:center;">Manage Products 🛍️</h2>

<div style="display:flex; flex-wrap:wrap; justify-content:center;">

<?php
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");

while($row = mysqli_fetch_assoc($result)){
?>

<div style="background:white; margin:15px; padding:15px; border-radius:15px; width:200px; text-align:center; box-shadow:0 0 10px #ddd;">

    <img src="images/<?php echo $row['image']; ?>" width="150" style="border-radius:10px;"><br><br>

    <b><?php echo $row['name']; ?></b><br>
    Ksh <?php echo $row['price']; ?><br>
    <small><?php echo $row['category']; ?></small>

    <br><br>
    <!-- ✏️ EDIT BUTTON -->
<a href="edit_product.php?id=<?php echo $row['id']; ?>">
    <button style="background:blue; color:white; border:none; padding:8px; border-radius:5px; margin-right:5px;">
        Edit ✏️
    </button>
</a>

    <!-- 🗑 DELETE -->
    <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>"
       onclick="return confirm('Delete this product?')">

        <button style="background:red; color:white; border:none; padding:8px; border-radius:5px;">
            Delete 🗑️
        </button>

    </a>

</div>

<?php } ?>

</div>

</body>
</html>