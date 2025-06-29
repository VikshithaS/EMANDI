<?php
include('./secure.php');

// MySQLi Connection
$servername = 'localhost';
$database   = 'fsms';
$username   = 'root';
$password   = '';

$con = mysqli_connect($servername, $username, $password, $database);
if (!$con) {
    die("❌ Connection failed: " . mysqli_connect_error());
}

// Get user data
$chef_username = $_SESSION['chef_username'];
$stmt = $con->prepare("SELECT * FROM chef WHERE chef_username = ?");
$stmt->bind_param("s", $chef_username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FSMS - Personal Info</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
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
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 h-screen bg-gray-900 text-white flex flex-col justify-center">
            <ul class="ml-3 mt-10">
                <li class="mb-4"><a href="home.php" class="hover:text-blue-200 font-medium">Home</a></li>
                <li class="mb-4"><a href="personal_info.php" class="hover:text-blue-200 font-medium">Personal Info</a></li>
                <li class="mb-4"><a href="ingredient_addition/adding_ingredient.php" class="hover:text-blue-200 font-medium">Ingredient Addition</a></li>
                <li class="mb-4"><a href="status_checking/status_checking.php" class="hover:text-blue-200 font-medium">Meal Status Checking</a></li>
                <li class="mt-10"><a class="block bg-white text-blue-500 py-2 px-2 rounded-full mr-6 text-center" href='logout.php'>Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-3/4 h-screen bg-white flex flex-col justify-center items-center overflow-y-auto">
            <h1 class="text-2xl font-bold mb-6">Account Details</h1>
            <table class="table-auto">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">Username</th>
                        <th class="px-4 py-2">First Name</th>
                        <th class="px-4 py-2">Last Name</th>
                        <th class="px-4 py-2">Age</th>
                        <th class="px-4 py-2">Gender</th>
                        <th class="px-4 py-2">Password</th>
                        <th class="px-4 py-2">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = $result->fetch_assoc()) :
                        $bgColor = $i % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200'; ?>
                        <tr class='<?php echo $bgColor ?>'>
                            <td class='border px-4 py-2'> <?php echo htmlspecialchars($row['chef_username']); ?> </td>
                            <td class='border px-4 py-2'> <?php echo htmlspecialchars($row['chef_fname']); ?> </td>
                            <td class='border px-4 py-2'> <?php echo htmlspecialchars($row['chef_lname']); ?> </td>
                            <td class='border px-4 py-2'> <?php echo htmlspecialchars($row['chef_age']); ?> </td>
                            <td class='border px-4 py-2'> <?php echo htmlspecialchars($row['chef_gender']); ?> </td>
                            <td class='border px-4 py-2'> <?php echo htmlspecialchars($row['chef_password']); ?> </td>
                            <td class='border px-4 py-2'>
                                <a href='updating_chef.php?chef_username=<?php echo urlencode($row['chef_username']); ?>' class='btn'>Update | </a>
                                <form class='inline-block' action='process_delete.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='delete_chef' value='<?php echo htmlspecialchars($row['chef_username']); ?>'>
                                    <input type='submit' class='btn' value='Delete'>
                                </form>
                            </td>
                        </tr>
                    <?php $i++; endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
