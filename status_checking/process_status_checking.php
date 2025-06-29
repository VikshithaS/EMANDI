<?php

include('../secure.php');

if (isset($_POST['checked_status'])) {

    function get_ingredient_id($ingredient_id_name)
    {
        $ingredient_id_name_array = explode(",", $ingredient_id_name);
        $ingredient_id = $ingredient_id_name_array[0];

        return $ingredient_id;
    }

    include_once('../connection.php');

    $chef_username = $_SESSION['chef_username'];

    $meal_name = $_POST['meal_name'];
    $meal_id = strtolower(substr(str_replace(" ", "", $meal_name), 0, 4)) . substr(time(), -4);
    $action_date = $_POST['action_date'];
    $meal_category = $_POST['meal_category'];
    $selected_ingredients = $_POST['selected_ingredients'];

    $action_type = "";
    $sum_ingredient_cost = 0;
    foreach ($selected_ingredients as $ingredient_id_name) {

        $ingredient_id = get_ingredient_id($ingredient_id_name);
        $query = $conn->prepare("SELECT * FROM ingredient I LEFT OUTER JOIN allergy A ON I.allergy_type = A.allergy_num WHERE ingredient_id = ?");
        $query->execute([$ingredient_id]);
        $row = $query->fetch(PDO::FETCH_OBJ);

        $allergy_severity = 0;

        if ($row->allergy_num !== NULL) {
            $allergy_severity = $row->allergy_severity;
        }

        $expire_date = $row->expire_date;

        // check if ingredient is expired or consists of allergies
        if (strtotime($expire_date) < strtotime($action_date)) {
            echo "<h1>The ingredient '$row->ingredient_name' was Expired on $row->expire_date</h1>";
            $action_type = "Rejected";
        } else {
            if ($allergy_severity > 5)
                echo "<h1>The ingredient '$row->ingredient_name' causes Severe Allergic Effects</h1>";

            $sum_ingredient_cost += $row->ingredient_cost;
        }
    }


    // insert after approval for high allergy
    $meal_price = $sum_ingredient_cost;

    if ($action_type != "Rejected") {
        $action_type = "Prepared";

        $query = $conn->prepare("INSERT INTO meal (meal_id, meal_name, meal_price, meal_category) VALUES (?, ?, ?, ?)");
        $query->execute([$meal_id, $meal_name, $meal_price, $meal_category]);

        $query = $conn->prepare("INSERT INTO meal_chef (meal_id, chef_username, action_date, action_type) VALUES (?, ?, ?, ?)");
        $query->execute([$meal_id, $chef_username, $action_date, $action_type]);

        foreach ($selected_ingredients as $ingredient_id_name) {

            $ingredient_id = get_ingredient_id($ingredient_id_name);
            $query = $conn->prepare("INSERT INTO meal_ingredient (meal_id, ingredient_id) VALUES (?, ?)");
            $query->execute([$meal_id, $ingredient_id]);

            echo "<h1>Congratulations! The Meal $meal_name is Safe for Serving to Customers!<h1>";
        }

        header("Location: ../home.php");
    }
} else {
    echo "Error: Form not submitted\n";
}
