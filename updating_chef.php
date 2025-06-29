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

// Sanitize input
$chef_username = $_GET['chef_username'] ?? '';

$stmt = $con->prepare("SELECT * FROM chef WHERE chef_username = ?");
$stmt->bind_param("s", $chef_username);
$stmt->execute();
$result = $stmt->get_result();
$chef_row = $result->fetch_assoc();

// Variables for form
$chef_fname    = $chef_row['chef_fname'];
$chef_lname    = $chef_row['chef_lname'];
$chef_age      = $chef_row['chef_age'];
$chef_gender   = $chef_row['chef_gender'];
$chef_password = $chef_row['chef_password'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FSMS - Updating Chef</title>
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
    <h1 class="text-2xl font-bold">Updating Chef</h1>
  </header>

  <main>
    <div class="container mx-auto mt-4">
      <form action="process_update.php" method="POST">
        <div class="rounded-lg shadow-lg bg-white p-6">
          <div class="flex items-center justify-center">
            <div class="w-1/4">
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Update First Name</label>
                <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 w-full" type="text" value="<?php echo htmlspecialchars($chef_fname); ?>" name="chef_fname" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Update Last Name</label>
                <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 w-full" type="text" value="<?php echo htmlspecialchars($chef_lname); ?>" name="chef_lname" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Update Age</label>
                <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 w-full" type="number" value="<?php echo htmlspecialchars($chef_age); ?>" name="chef_age" />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Update Gender</label>
                <select class="appearance-none border rounded-lg py-2 px-3 text-gray-700 w-full" name="chef_gender">
                  <option value="<?php echo $chef_gender ?>"><?php echo $chef_gender ?></option>
                  <?php
                    $genderOptions = ["Male", "Female", "Other"];
                    foreach ($genderOptions as $gender) {
                      if ($gender !== $chef_gender) {
                        echo "<option value=\"$gender\">$gender</option>";
                      }
                    }
                  ?>
                </select>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Update Password</label>
                <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 w-full" type="password" value="<?php echo htmlspecialchars($chef_password); ?>" name="chef_password" />
              </div>
              <div class="mb-4">
                <input type="hidden" name="update_chef" value="<?php echo htmlspecialchars($chef_username); ?>" />
                <input type="submit" class="btn bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" value="Update" />
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</body>
</html>
