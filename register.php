<?php
include("db.php");

$error = "";

if(isset($_POST['register'])){

    $email = isset($_POST['email']) ? strtolower(trim($_POST['email'])) : "";
$password = isset($_POST['password']) ? trim($_POST['password']) : "";
$confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : "";
    // VALIDATION
    if(empty($email) || empty($password) || empty($confirm_password)){
        $error = "All fields are required!";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email format!";
    }
    elseif(strlen($password) < 6){
        $error = "Password must be at least 6 characters!";
    }
    elseif($password !== $confirm_password){
        $error = "Passwords do not match!";
    }
    else {

        // CHECK IF EMAIL EXISTS
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if($result->num_rows > 0){
            $error = "Email already exists!";
        } else {

            // HASH PASSWORD
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // INSERT USER
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashed);

            if($stmt->execute()){
                header("Location: login.php?msg=registered");
                exit();
            } else {
                $error = "Registration failed!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<h2>Create Account ✍️</h2>

<?php if($error): ?>
    <p style="color:red; font-weight:bold;">
        <?= $error ?>
    </p>
<?php endif; ?>

<form method="POST" onsubmit="return validateForm()">

    <!-- EMAIL -->
    <label>Email</label>
    <input type="email" name="email" id="email" required>

    <!-- PASSWORD -->
    <label>Password</label>
    <input type="password"
           name="password"
           id="password"
           oninput="checkStrength(this.value)"
           required>

    <small id="passMsg"></small>

    <div class="bar">
        <div id="strengthBar"></div>
    </div>

    <!-- CONFIRM PASSWORD -->
    <label>Confirm Password</label>
    <input type="password"
           name="confirm_password"
           id="confirm_password"
           required>

    <small id="matchMsg"></small>

    <br>

    <!-- SHOW PASSWORD -->
    <input type="checkbox" onclick="togglePassword()"> Show Password

    <br><br>

    <button name="register">Register</button>

</form>

<script>

// PASSWORD STRENGTH
function checkStrength(password){

    let bar = document.getElementById("strengthBar");
    let msg = document.getElementById("passMsg");

    let strength = 0;

    if(password.length === 0){
        bar.style.width = "0%";
        msg.innerHTML = "";
        return;
    }

    if(password.length >= 6) strength++;
    if(/[A-Z]/.test(password)) strength++;
    if(/[0-9]/.test(password)) strength++;
    if(/[@$!%*?&]/.test(password)) strength++;

    if(strength <= 1){
        bar.style.width = "25%";
        bar.style.background = "red";
        msg.innerHTML = "Weak ❌";
        msg.style.color = "red";
    }
    else if(strength == 2){
        bar.style.width = "50%";
        bar.style.background = "orange";
        msg.innerHTML = "Fair ⚠️";
        msg.style.color = "orange";
    }
    else if(strength == 3){
        bar.style.width = "75%";
        bar.style.background = "gold";
        msg.innerHTML = "Good 👍";
        msg.style.color = "goldenrod";
    }
    else {
        bar.style.width = "100%";
        bar.style.background = "green";
        msg.innerHTML = "Strong 💚";
        msg.style.color = "green";
    }
}

// CONFIRM PASSWORD CHECK
document.getElementById("confirm_password").addEventListener("input", function(){
    let pass = document.getElementById("password").value;
    let confirm = this.value;
    let msg = document.getElementById("matchMsg");
    if(confirm.length === 0){
        msg.innerHTML = "";
    }
    else if(pass === confirm){
        msg.style.color = "green";
        msg.innerHTML = "Passwords match ✅";
    }
    else {
        msg.style.color = "red";
        msg.innerHTML = "Passwords do not match ❌";
    }
});

// FINAL VALIDATION
function validateForm(){
    let pass = document.getElementById("password").value;
    let confirm = document.getElementById("confirm_password").value;

    if(pass !== confirm){
        alert("Passwords do not match!");
        return false;
    }

    return true;
}

// SHOW/HIDE PASSWORD
function togglePassword(){
    let pass = document.getElementById("password");
    let confirm = document.getElementById("confirm_password");

    pass.type = pass.type === "password" ? "text" : "password";
    confirm.type = confirm.type === "password" ? "text" : "password";
}

</script>

</body>
</html>