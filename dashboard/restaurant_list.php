<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>

    <?php
    session_start();

    include('../config/db.php');

    $sql = "select * from restaurant";

    $result = mysqli_query($conn, $sql);


    ?>

</head>

<body>
    <input type="checkbox" name="" id="menu-toggle">
    <div class="overlay">
        <label for="menu-toggle"></label>
    </div>
    <?php include('sidebar.php'); ?>
    <div class="main-content">

        <main class="w-full h-full bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Phone</th>
                            <th class="py-3 px-6 text-left">Location</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6"><?php echo $row['id'] ?></td>
                                <td class="py-3 px-6"><?php echo $row['name'] ?></td>
                                <td class="py-3 px-6"><?php echo $row['email'] ?></td>
                                <td class="py-3 px-6"><?php echo $row['phone'] ?></td>
                                <td class="py-3 px-6"><?php echo $row['location'] ?></td>
                                <td class="py-3 px-6"><span class="bg-green-200 text-green-600 py-1 px-2 rounded"><?php echo $row['status'] ?></span></td>
                                <td class="py-3 px-6">
                                    <button class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 mr-1">Edit</button>
                                    <button class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 mr-1">Delete</button>
                                    <button class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600">Block</button>
                                </td>
                            </tr>
                        <?php
                        }

                        ?>


                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="./script.js"></script>
</body>

</html>