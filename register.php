<?php
include("db.php");

$error = "";

if(isset($_POST['register'])){
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
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
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed')";

        if(mysqli_query($conn, $sql)){
            header("Location: login.php?msg=registered");
            exit();
        } else {
            $error = "Registration failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
    <label>Email</label><br>
    <input type="email" name="email" id="email" oninput="validateEmailLive()" required>
    <br>
    <small id="emailMsg"></small>

    <br>

    <!-- PASSWORD -->
    <label>Password</label><br>
    <input type="password" name="password" id="password" oninput="handlePasswordInput(this.value)" required>
    <br>
    <small id="passMsg"></small>

    <br>

    <!-- STRENGTH BAR (NO CSS, JUST BASIC DIV) -->
    <div>
        <div id="strengthBar"></div>
    </div>

    <br>

    <!-- CONFIRM PASSWORD -->
    <label>Confirm Password</label><br>
    <input type="password" name="confirm_password" id="confirm_password" oninput="checkMatch()" required>
    <br>
    <small id="matchMsg"></small>

    <br><br>

    <!-- SHOW PASSWORD -->
    <input type="checkbox" onclick="togglePassword()"> Show Password

    <br><br>

    <button name="register">Register</button>

</form>

<script>

// EMAIL VALIDATION
function validateEmailLive(){
    let email = document.getElementById("email").value;
    let msg = document.getElementById("emailMsg");
    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(email === ""){
        msg.innerHTML = "";
    }
    else if(!pattern.test(email)){
        msg.style.color = "red";
        msg.innerHTML = "Invalid email ❌";
    }
    else {
        msg.style.color = "green";
        msg.innerHTML = "Valid email ✅";
    }
}

// PASSWORD STRENGTH
function handlePasswordInput(password){
    let bar = document.getElementById("strengthBar");
    let msg = document.getElementById("passMsg");

    let strength = 0;

    if(password === ""){
        bar.style.width = "0%";
        bar.style.height = "10px";
        msg.innerHTML = "";
        return;
    }

    if(password.length >= 6) strength++;
    if(password.match(/[A-Z]/)) strength++;
    if(password.match(/[0-9]/)) strength++;
    if(password.match(/[@$!%*?&]/)) strength++;

    bar.style.height = "10px";

    if(strength <= 1){
        bar.style.width = "25%";
        bar.style.background = "red";
        msg.style.color = "red";
        msg.innerHTML = "Weak ❌";
    }
    else if(strength == 2){
        bar.style.width = "50%";
        bar.style.background = "orange";
        msg.style.color = "orange";
        msg.innerHTML = "Fair ⚠️";
    }
    else if(strength == 3){
        bar.style.width = "75%";
        bar.style.background = "gold";
        msg.style.color = "goldenrod";
        msg.innerHTML = "Good 👍";
    }
    else {
        bar.style.width = "100%";
        bar.style.background = "green";
        msg.style.color = "green";
        msg.innerHTML = "Strong 💚";
    }
}
// PASSWORD MATCH
function checkMatch(){
    let pass = document.getElementById("password").value;
    let confirm = document.getElementById("confirm_password").value;
    let msg = document.getElementById("matchMsg");

    if(confirm === ""){
        msg.innerHTML = "";
    }
    else if(pass !== confirm){
        msg.style.color = "red";
        msg.innerHTML = "Passwords do not match ❌";
    }
    else {
        msg.style.color = "green";
        msg.innerHTML = "Passwords match ✅";
    }
}

// FORM VALIDATION
function validateForm(){
    let email = document.getElementById("email").value;
    let pass = document.getElementById("password").value;
    let confirm = document.getElementById("confirm_password").value;

    if(email.trim() === ""  pass.trim() === ""  confirm.trim() === ""){
        alert("Please fill all fields");
        return false;
    }

    if(pass !== confirm){
        alert("Passwords do not match!");
        return false;
    }

    return true;
}

// TOGGLE PASSWORD
function togglePassword(){
    let pass = document.getElementById("password");
    let confirm = document.getElementById("confirm_password");

    let type = pass.type === "password" ? "text" : "password";

    pass.type = type;
    confirm.type = type;
}

</script>

</body>
</html>