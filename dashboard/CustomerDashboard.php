<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['customer_logged_in']) || $_SESSION['customer_logged_in'] !== true) {
  header("Location: ../index.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>


</head>

<body class="bg-gray-100 font-sans antialiased h-screen flex">
    <input type="checkbox" name="" id="menu-toggle">
    <div class="overlay">
        <label for="menu-toggle"></label>
    </div>
    <!-- Sidebar -->
    <?php include('./customer_sidebar.php'); ?>
    <div class="py-8 w-full ml-8">
        <h1 class="text-2xl font-bold mb-4 text-center">Order Details</h1>

        <div class="flex gap-4 items-center mx-auto max-w-4xl mx-auto">
            <div class="w-32 h-32 border border-slate-500">
                <img src="../assets/briyani.jpg" alt="" class="w-full h-full">
            </div>
            <div class="font-semibold text-lg">
                <div>
                    <h1>Bathmats Briyani</h1>
                    <h1>Quantity: 1</h1>
                </div>
                <h1>Total Amount: Tk. 100</h1>
            </div>
        </div>

        <div class="p-4 mt-4">
            <h1 class="text-xl text-center font-semibold mb-6">Order status</h1>
            <div class="container">
                <div class="flex flex-col md:grid grid-cols-12 text-gray-50">

                    <div class="flex md:contents">
                        <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
                            <div class="h-full w-6 flex items-center justify-center">
                                <div class="h-full w-1 bg-green-500 pointer-events-none"></div>
                            </div>
                            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-green-500 shadow text-center">
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                        </div>
                        <div class="bg-green-500 col-start-4 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
                            <h3 class="font-semibold text-lg mb-1">Order Placed</h3>
                            <p class="leading-tight text-justify w-full">
                                21 July 2021, 04:30 PM
                            </p>
                        </div>
                    </div>

                    <div class="flex md:contents">
                        <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
                            <div class="h-full w-6 flex items-center justify-center">
                                <div class="h-full w-1 bg-green-500 pointer-events-none"></div>
                            </div>
                            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-green-500 shadow text-center">
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                        </div>
                        <div class="bg-green-500 col-start-4 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
                            <h3 class="font-semibold text-lg mb-1">Order Delivered</h3>
                            <p class="leading-tight text-justify">
                                22 July 2021, 01:00 PM
                            </p>
                        </div>
                    </div>

                    <!-- <div class="flex md:contents">
                        <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
                            <div class="h-full w-6 flex items-center justify-center">
                                <div class="h-full w-1 bg-red-500 pointer-events-none"></div>
                            </div>
                            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-red-500 shadow text-center">
                                <i class="fas fa-times-circle text-white"></i>
                            </div>
                        </div>
                        <div class="bg-red-500 col-start-4 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
                            <h3 class="font-semibold text-lg mb-1 text-gray-50">Cancelled</h3>
                            <p class="leading-tight text-justify">
                                Customer cancelled the order
                            </p>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </div>

    <script src="./script.js"></script>
</body>

</html>