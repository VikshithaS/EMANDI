<?php
session_start();
include('./connection.php');

// -------------------- SIGN UP --------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signed_up'])) {
    $chef_username = $_POST['chef_username'];
    $chef_fname    = $_POST['chef_fname'];
    $chef_lname    = $_POST['chef_lname'];
    $chef_age      = intval($_POST['chef_age']);
    $chef_gender   = $_POST['chef_gender'];
    $chef_password = $_POST['chef_password'];

    // Hash password
    $hashed_password = password_hash($chef_password, PASSWORD_DEFAULT);

    // Prepare SQL
    $stmt = $con->prepare("INSERT INTO chef (chef_username, chef_fname, chef_lname, chef_age, chef_gender, chef_password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $chef_username, $chef_fname, $chef_lname, $chef_age, $chef_gender, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['chef_username'] = $chef_username;
        echo "<script>alert('✅ Signup successful! Please log in.'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('❌ Signup failed. Username might already exist.'); window.location.href='signup.html';</script>";
    }

    $stmt->close();
}

// -------------------- LOGIN --------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logged_in'])) {
    $chef_username = $_POST['chef_username'];
    $chef_password = $_POST['chef_password'];

    $stmt = $con->prepare("SELECT * FROM chef WHERE chef_username = ?");
    $stmt->bind_param("s", $chef_username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($chef_password, $user['chef_password'])) {
        $_SESSION['chef_username'] = $user['chef_username'];
        echo "<script>alert('✅ Login successful!'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('❌ Invalid username or password'); window.location.href='login.html';</script>";
    }

    $stmt->close();
}

$con->close();
?>
