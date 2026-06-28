<?php
session_start();
include "db.php";
include "header.php";

$error = "";
$success = "";

// LOGIN FUNCTION
if (isset($_POST['login'])) {
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Prepared statement (SECURE)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];    
            if ($user['role'] === 'admin') {
                $_SESSION['admin'] = true;
                header("Location: admin_dashboard.php");
                exit();
            }
            else{
                header("Location: index.php");
                exit();
            }
        } else {
            $error = "Invalid email or password ❌";
        }
    } else {
        $error = "Invalid email or password ❌";
    }
}

// FORGOT PASSWORD FUNCTION
if (isset($_POST['reset_password'])) {
    $email = trim($_POST['reset_email']);
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
    $stmt->bind_param("ss", $newPassword, $email);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $success = "Password reset successful! You can now login ✅";
    } else {
        $error = "Email not found ❌";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="login-container">

    <h2>Login to Noella Luxe 👜</h2>

    <!-- SUCCESS MESSAGE -->
    <?php if ($success): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <!-- ERROR MESSAGE -->
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- LOGIN FORM -->
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>

    <!-- FORGOT PASSWORD TOGGLE -->
    <p><a href="#" onclick="toggleReset()">Forgot Password? 🔑</a></p>

    <!-- RESET PASSWORD FORM -->
    <div id="resetBox" style="display:none;">
        <h3>Reset Password</h3>
        <form method="POST">
            <input type="email" name="reset_email" placeholder="Enter your email" required>
            <input type="password" name="new_password" placeholder="New password" required>
            <button name="reset_password">Reset Password</button>
        </form>
    </div>

</div>

<p>No account? <a href="register.php">Register 💅</a></p>

<script>
function toggleReset() {
    var box = document.getElementById("resetBox");
    box.style.display = (box.style.display === "none") ? "block" : "none";
}
</script>

</body>
</html>