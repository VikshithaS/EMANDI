<?php
include('../secure.php');

if (isset($_GET['ingredient_submitted'])) {
    include_once('../connection.php');

    // Capture form inputs
    $ingredient_name = $_GET['ingredient_name'];
    $ingredient_id = strtolower(substr(str_replace(" ", "", $ingredient_name), 0, 4)) . substr(time(), -4);
    $ingredient_cost = $_GET['ingredient_cost'];
    $purchase_date = $_GET['purchase_date'];
    $expire_date = $_GET['expire_date'];

    $supp_name     = $_GET['supp_name'];
    $supp_phone    = $_GET['supp_phone'];
    $supp_country  = $_GET['supp_country'];

    $allergy_type     = $_GET['allergy_type'];
    $allergy_severity = $_GET['severity_level'];

    // Insert into allergy
    $stmt = $con->prepare("INSERT INTO allergy (allergy_type, allergy_severity) VALUES (?, ?)");
    $stmt->bind_param("si", $allergy_type, $allergy_severity);
    $stmt->execute();

    // Insert into supplier
    $stmt = $con->prepare("INSERT INTO supplier (supp_name, supp_phone, supp_country) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $supp_name, $supp_phone, $supp_country);
    $stmt->execute();

    // Get latest allergy_num
    $result = mysqli_query($con, "SELECT allergy_num FROM allergy ORDER BY allergy_num DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $allergy_num = $row['allergy_num'];

    // Get latest supp_num
    $result = mysqli_query($con, "SELECT supp_num FROM supplier ORDER BY supp_num DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $supp_num = $row['supp_num'];

    // Insert into ingredient
    $stmt = $con->prepare("INSERT INTO ingredient (ingredient_id, ingredient_name, ingredient_cost, purchase_date, expire_date, allergy_type, supplier)
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssii", $ingredient_id, $ingredient_name, $ingredient_cost, $purchase_date, $expire_date, $allergy_num, $supp_num);
    $stmt->execute();

    echo "<script>alert('✅ Ingredient added successfully!'); window.location.href = '../home.php';</script>";
} else {
    echo "<script>alert('❌ Ingredient addition failed.'); window.location.href = '../home.php';</script>";
}
?>
