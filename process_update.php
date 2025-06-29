if (isset($_POST['update_ingredient'])) {
    $ingredient_id   = $_POST['update_ingredient'];
    $ingredient_name = $_POST['ingredient_name'];
    $ingredient_cost = $_POST['ingredient_cost'];
    $purchase_date   = $_POST['purchase_date'];
    $expire_date     = $_POST['expire_date'];

    $stmt = $con->prepare("UPDATE ingredient SET ingredient_name = ?, ingredient_cost = ?, purchase_date = ?, expire_date = ? WHERE ingredient_id = ?");
    $stmt->bind_param("sdsss", $ingredient_name, $ingredient_cost, $purchase_date, $expire_date, $ingredient_id);
    $stmt->execute();

    header("Location: home.php");
    exit();
}
