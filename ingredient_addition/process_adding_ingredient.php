<?php
include('../secure.php');

if (isset($_GET['ingredient_submitted'])) {
    include_once('../connection.php');

    // Get data from GET request
    $ingredient_name = trim($_GET['ingredient_name']);
    $ingredient_cost = floatval($_GET['ingredient_cost']);
    $purchase_date   = $_GET['purchase_date'];
    $expire_date     = $_GET['expire_date'];

    $supp_name     = trim($_GET['supp_name']);
    $supp_phone    = $_GET['supp_phone'];
    $supp_country  = trim($_GET['supp_country']);

    $allergy_type     = trim($_GET['allergy_type']);
    $allergy_severity = intval($_GET['severity_level']);

    // Generate a unique ingredient_id
    $ingredient_id = strtolower(substr(str_replace(" ", "", $ingredient_name), 0, 4)) . substr(time(), -4);

    // Insert allergy info
    $stmt = $con->prepare("INSERT INTO allergy (allergy_type, allergy_severity) VALUES (?, ?)");
    $stmt->bind_param("si", $allergy_type, $allergy_severity);
    $stmt->execute();

    // Insert supplier info
    $stmt = $con->prepare("INSERT INTO supplier (supp_name, supp_phone, supp_country) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $supp_name, $supp_phone, $supp_country);
    $stmt->execute();

    // Get the last inserted allergy_num
    $result = mysqli_query($con, "SELECT allergy_num FROM allergy ORDER BY allergy_num DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $allergy_num = $row['allergy_num'];

    // Get the last inserted supp_num
    $result = mysqli_query($con, "SELECT supp_num FROM supplier ORDER BY supp_num DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $supp_num = $row['supp_num'];

    // Insert into ingredient table
    $stmt = $con->prepare("INSERT INTO ingredient (ingredient_id, ingredient_name, ingredient_cost, purchase_date, expire_date, allergy_type, supplier)
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssii", $ingredient_id, $ingredient_name, $ingredient_cost, $purchase_date, $expire_date, $allergy_num, $supp_num);
    $stmt->execute();

    echo "<script>alert('✅ Ingredient added successfully to the inventory!'); window.location.href='../home.php';</script>";
} else {
    echo "<script>alert('❌ Ingredient addition failed.'); window.location.href='../home.php';</script>";
}
?>
