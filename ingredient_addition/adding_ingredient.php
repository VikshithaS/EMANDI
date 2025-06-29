<?php
include('../secure.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FSMS - Ingredient Addtion</title>
  <link rel="icon" type="image/x-icon" href="../images/logo.png" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <div class="flex">
    <div class="w-1/4 h-screen bg-gray-900 text-white flex flex-col justify-center">
      <ul class="ml-3 mt-10">
        <li class="mb-4">
          <a href="../home.php" class="hover:text-blue-200 font-medium">Home</a>
        </li>
        <li class="mb-4">
          <a href="../personal_info.php" class="hover:text-blue-200 font-medium">Personal Info</a>
        </li>
        <li class="mb-4">
          <a href="adding_ingredient.php" class="hover:text-blue-200 font-medium">Ingredient Addition</a>
        </li>
        <li class="mb-4">
          <a href="../status_checking/status_checking.php" class="hover:text-blue-200 font-medium">Meal Status Checking</a>
        </li>
        <li class="mt-10">
          <a class="block bg-white text-blue-500 py-2 px-2 rounded-full mr-6 text-center" href="../logout.php">Logout</a>
        </li>
      </ul>
    </div>
    <div class="w-3/4 h-screen bg-white flex flex-col justify-center items-center overflow-y-auto">
      <header class="text-center py-4">
        <h1 class="text-2xl font-bold">Ingredient Addtion</h1>
      </header>

      <nav class="bg-gray-100 py-4 w-full">
        <div class="container mx-auto flex justify-center">
          <a id="nav-ingredient" class="px-6 py-2 rounded-lg bg-white mr-2 hover:text-gray-500 focus:outline-none" href="#section-ingredient">
            Ingredient Details
          </a>
          <a id="nav-supplier" class="px-6 py-2 rounded-lg text-gray-700 hover:text-gray-500 focus:outline-none" href="#section-supplier">
            Supplier Details
          </a>
          <a id="nav-allergy" class="px-6 py-2 rounded-lg text-gray-700 hover:text-gray-500 focus:outline-none" href="#section-allergy">
            Allergy Details
          </a>
        </div>
      </nav>

      <main class="w-full">
        <div class="container mx-auto mt-4">
          <form action="process_adding_ingredient.php" method="GET">
            <section id="section-ingredient">
              <div class="rounded-lg shadow-lg bg-white p-6">
                <div class="flex justify-center">
                  <div class="w-1/4">
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2">
                        Name
                      </label>
                      <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" type="text" placeholder="Enter the Ingredient's Name" name="ingredient_name" />
                    </div>
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2">
                        Cost
                      </label>
                      <input class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter Cost of the Ingredient" name="ingredient_cost" />
                    </div>
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2">
                        Purchase Date
                      </label>
                      <input type="date" class="border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="purchase_date" />
                    </div>
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2">
                        Expire Date
                      </label>
                      <input type="date" class="border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="expire_date" />
                    </div>
                    <div class="mb-4 flex justify-end">
                      <a id="next-supplier" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" href="#section-supplier">
                        Next
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <section id="section-supplier" class="hidden">
              <div class="rounded-lg shadow-lg bg-white p-6">
                <div class="flex items-center justify-center">
                  <div class="w-1/4">
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2">
                        Supplier Name
                      </label>
                      <input type="text" class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter the Ingredient's Name" name="supp_name" />
                    </div>
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2">
                        Phone Number
                      </label>
                      <input type="text" class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter Supplier's Phone Number" name="supp_phone" />
                    </div>
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2">
                        Supplier Country
                      </label>
                      <input type="text" class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter Supplier's Country" name="supp_country" />
                    </div>
                    <div class="mb-4 flex justify-end">
                      <a id="next-allergy" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" href="#section-allergy">
                        Next
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section id="section-allergy" class="hidden">
              <div class="rounded-lg shadow-lg bg-white p-6">
                <div class="flex items-center justify-center">
                  <div class="w-1/4">
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2">
                        Allergy Type
                      </label>
                      <input type="text" class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter the Name of the Allergy Type" name="allergy_type" />
                    </div>
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2">
                        Severty Level
                      </label>
                      <input type="text" class="appearance-none border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" placeholder="Enter a number from 1-10" name="severity_level" />
                    </div>
                    <div class="mb-4 flex justify-end">
                      <input type="hidden" name="ingredient_submitted" value="1" />
                      <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit" name="submit" value="Add Ingredient" />
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </form>
        </div>
      </main>
    </div>
  </div>
  <script src="adding_ingredient.js"></script>
</body>

</html>