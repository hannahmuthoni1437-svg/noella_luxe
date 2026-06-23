<?php
session_start();
include("db.php");

// 🔒 Protect page (admin only)
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

// 🚨 Get product ID
if(!isset($_GET['id'])){
    header("Location: admin_dashboard.php");
    exit();
}

$id = $_GET['id'];

// 📦 Fetch product data
$result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$product = mysqli_fetch_assoc($result);

if(!$product){
    header("Location: admin_dashboard.php");
    exit();
}

// ✏️ UPDATE PRODUCT
if(isset($_POST['update'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    

    // 🖼 check image upload
    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $temp = $_FILES['image']['tmp_name'];

        move_uploaded_file($temp, "images/".$image);

        $query = "UPDATE products SET 
                    name='$name',
                    price='$price',
                    category='$category',
                    
                    image='$image'
                  WHERE id='$id'";
    } else {
        $query = "UPDATE products SET 
                    name='$name',
                    price='$price',
                    category='$category',
            image= '$category'
                  WHERE id='$id'";
    }

    mysqli_query($conn, $query);

    header("Location: admin_dashboard.php?msg=updated");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body{
            font-family: Arial;
            background:#f4f4f4;
            text-align:center;
        }

        .form-box{
            background:white;
            width:350px;
            margin:50px auto;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px #ccc;
        }

        input, textarea{
            width:90%;
            padding:10px;
            margin:8px 0;
        }

        button{
            background:green;
            color:white;
            padding:10px;
            border:none;
            width:95%;
            cursor:pointer;
        }
    </style>
</head>
<body>

<div class="form-box">

    <h2>Edit Product ✏️</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>

        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>

        <input type="text" name="category" value="<?php echo $product['category']; ?>" required>

    
        <p>Current Image:</p>
        <img src="images/<?php echo $product['image']; ?>" width="100">

        <input type="file" name="image">

        <button type="submit" name="update">Update Product ✔</button>

    </form>

</div>

</body>
</html>