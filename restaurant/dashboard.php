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
  <aside class="w-64 bg-blue-800 text-white flex flex-col">
    <div class="px-6 py-4 text-2xl font-bold">
      Dashboard
    </div>
    <nav class="flex-1 px-6 space-y-2">
      <a href="#" class="block py-2 px-4 rounded-md hover:bg-blue-700">Home</a>
      <a href="#" class="block py-2 px-4 rounded-md hover:bg-blue-700">Profile</a>
      <a href="#" class="block py-2 px-4 rounded-md hover:bg-blue-700">Settings</a>
      <a href="#" class="block py-2 px-4 rounded-md hover:bg-blue-700">Reports</a>
    </nav>
    <div class="p-6">
      <a href="#" class="block text-center py-2 px-4 rounded-md bg-red-500 hover:bg-red-600">Logout</a>
    </div>
  </aside>

  <!-- Main Content Area -->
  <main class="flex-1 p-6 overflow-y-auto">
    <h1 class="text-3xl font-semibold mb-6">Welcome to Your Dashboard</h1>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      <!-- Sample Card 1 -->
      <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-2">Card 1</h2>
        <p class="text-gray-600">This is an example of a dashboard card.</p>
      </div>
      <!-- Sample Card 2 -->
      <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-2">Card 2</h2>
        <p class="text-gray-600">This is an example of a dashboard card.</p>
      </div>
      <!-- Sample Card 3 -->
      <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-2">Card 3</h2>
        <p class="text-gray-600">This is an example of a dashboard card.</p>
      </div>
    </div>
  </main>

</body>
</html>
