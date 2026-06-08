<?php
session_start();
include "db.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users 
                            WHERE email='$email' 
                            ");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['password'])) {

            $_SESSION['user'] = $email;
            header("Location: index.php");
            exit();

        } else {
            $error = "Invalid email or password 💔";
        }

    } else {
        $error = "Invalid email or password 💔";
    }
}

?>

<link rel="stylesheet" href="style.css">

<div class="login-container">
    <h2>Login to Noella Luxe 👜✨</h2>

    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email 💌" required>
        <input type="password" name="password" placeholder="Password 🔒" required>

        <button name="login">Login 💖</button>
    </form>
</div>
<p>No account? <a href="register.php">Register 💅</a></p>
