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


   
    ?>


</head>

<body>
    <input type="checkbox" name="" id="menu-toggle">
    <div class="overlay">
        <label for="menu-toggle"></label>
    </div>
    <?php include('sidebar.php'); ?>
    <div class="main-content">

        <?php
        // Display success or error message
        if (isset($_SESSION['message'])) {
            $message_type = $_SESSION['msg_type'] === "success" ? "bg-green-500" : "bg-red-500";
            echo '<div class="alert ' . $message_type . ' text-white font-bold rounded-lg px-4 py-2 mb-4" role="alert">
                    ' . $_SESSION['message'] . '
                    <button onclick="this.parentElement.style.display=\'none\'" class="float-right ml-2 text-white" aria-label="Close">&times;</button>
                </div>';
            unset($_SESSION['message']);
            unset($_SESSION['msg_type']);
        }
        ?>

       
    </div>

    <script src="./script.js"></script>
</body>

</html>