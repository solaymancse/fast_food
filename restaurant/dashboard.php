<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: ../restaurant_login.php");
  exit();
}

@include('./create_order.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased h-screen flex">

  <!-- Sidebar -->
  <?php @include('./sidebar.php'); ?>

  <!-- Main Content Area -->
  <main class="flex-1 p-6 overflow-y-auto">
    <h1 class="text-3xl font-semibold mb-6">Welcome to Your Dashboard</h1>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      <!-- Sample Card 1 -->
      <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-2">Total Income</h2>
        <p class="text-gray-600">This is an example of a dashboard card.</p>
      </div>
      <!-- Sample Card 2 -->
      <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-2">Total Order</h2>
        <p class="text-gray-600">This is an example of a dashboard card.</p>
      </div>
      <!-- Sample Card 3 -->
      <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-2">Active Order</h2>
        <p class="text-gray-600">This is an example of a dashboard card.</p>
      </div>
      <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-2">Order Deliverd</h2>
        <p class="text-gray-600">This is an example of a dashboard card.</p>
      </div>
    </div>
  </main>

  <script>
    // Set localStorage item to track login status
    if (!localStorage.getItem("logged")) {
      localStorage.setItem("logged", "true");
    }
  </script>


</body>

</html>