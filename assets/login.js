function validateForm() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let error = document.getElementById("error");

    if (email === "" || password === "") {
        error.innerHTML = "All fields are required!";
        return false;
    }

    if (!email.includes("@")) {
        error.innerHTML = "Invalid email format!";
        return false;
    }

    if (password.length < 6) {
        error.innerHTML = "Password must be at least 6 characters!";
        return false;
    }

    alert("Login successful!");
    return true;
}