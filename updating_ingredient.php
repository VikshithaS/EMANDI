<?php
include('./secure.php');

// MySQLi connection
$servername = 'localhost';
$database   = 'fsms';
$username   = 'root';
$password   = '';
$con = mysqli_connect($servername, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$ingredient_id = $_GET['ingredient_id'] ?? '';

// Fetch ingredient data
$stmt = $con->prepare("SELECT * FROM ingredient WHERE ingredient_id = ?");
$stmt->bind_param("s", $ingredient_id);
$stmt->execute();
$result = $stmt->get_result();
$ingredient_row = $result->fetch_assoc();

// Variables for the form
$ingredient_name = $ingredient_row['ingredient_name'];
$ingredient_cost = $ingredient_row['ingredient_cost'];
$purchase_date   = $ingredient_row['purchase_date'];
$expire_date     = $ingredient_row['expire_date'];
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FSMS - Updating Ingredient</title>
  <link rel="icon" type="image/x-icon" href="../images/logo.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .btn:hover {
      background-color: #ffff00;
      color: #000;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <header class="text-center py-4">
    <h1 class="text-2xl font-bold">Updating Ingredient</h1>
  </header>

  <main>
    <div class="container mx-auto mt-4">
      <form action="process_update.php" method="POST">
        <div class="rounded-lg shadow-lg bg-white p-6">
          <div class="flex items-center justify-center">
            <div class="w-1/4">
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Update Name</label>
                <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 w-full" type="text" value="<?php echo htmlspecialchars($ingredient_name); ?>" name="ingredient_name" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Update Ingredient Cost</label>
                <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 w-full" type="text" value="<?php echo htmlspecialchars($ingredient_cost); ?>" name="ingredient_cost" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Update Purchase Date</label>
                <input type="date" class="border rounded-lg py-2 px-3 text-gray-700 w-full" value="<?php echo htmlspecialchars($purchase_date); ?>" name="purchase_date" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Update Expire Date</label>
                <input type="date" class="border rounded-lg py-2 px-3 text-gray-700 w-full" value="<?php echo htmlspecialchars($expire_date); ?>" name="expire_date" />
              </div>
              <div class="mb-4">
                <input type="hidden" name="update_ingredient" value="<?php echo htmlspecialchars($ingredient_id); ?>" />
                <input type="submit" class="btn bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" value="Update" />
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</body>
</html>
