<?php
include('./secure.php');

// MySQLi connection
$servername = 'localhost';
$database   = 'fsms';
$username   = 'root';
$password   = '';

$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("❌ Connection failed: " . mysqli_connect_error());
}

// -------------------- Delete Chef --------------------
if (isset($_POST['delete_chef'])) {
    $chef_username = $_POST['delete_chef'];
    $stmt = $con->prepare("DELETE FROM chef WHERE chef_username = ?");
    $stmt->bind_param("s", $chef_username);
    $stmt->execute();
    header('Location: signup.html');
    exit();
}

// -------------------- Delete Ingredient --------------------
if (isset($_POST['delete_ingredient'])) {
    $ingredient_id = $_POST['delete_ingredient'];
    $stmt = $con->prepare("DELETE FROM ingredient WHERE ingredient_id = ?");
    $stmt->bind_param("s", $ingredient_id);
    $stmt->execute();
    header('Location: home.php');
    exit();
}

// -------------------- Delete Allergy --------------------
if (isset($_POST['delete_allergy'])) {
    $allergy_num = $_POST['delete_allergy'];
    $stmt = $con->prepare("DELETE FROM allergy WHERE allergy_num = ?");
    $stmt->bind_param("i", $allergy_num);
    $stmt->execute();
    header('Location: home.php');
    exit();
}

// -------------------- Delete Supplier --------------------
if (isset($_POST['delete_supplier'])) {
    $supp_num = $_POST['delete_supplier'];
    $stmt = $con->prepare("DELETE FROM supplier WHERE supp_num = ?");
    $stmt->bind_param("i", $supp_num);
    
    try {
        $stmt->execute();
    } catch (Exception $e) {
        echo "Delete failed: " . $e->getMessage();
        exit();
    }

    header('Location: home.php');
    exit();
}
?>
