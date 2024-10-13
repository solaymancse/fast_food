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

    include('../createRestaurant/create.php');

    if (isset($_POST['update'])) {
        $id = $_GET['id'];

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];

        $sql = "UPDATE restaurant SET name= '$name', email= '$email' , phone= '$phone', location= '$location' WHERE id= '$id'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['message'] = "Restaurant Updated successfully";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
            $_SESSION['msg_type'] = "error";
        }

        header("Location: " . "restaurant_list.php");
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id']; // Again, validate and sanitize this input
        $sql = "SELECT * FROM restaurant WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }
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

        <main class="w-full h-full bg-white">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>"
                method="post" class="w-full max-w-sm">
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input value="<?php echo $row['name']; ?>" name="name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" required>
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Location
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input value="<?php echo $row['location']; ?>" name="location" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" required>
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Email
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input value="<?php echo $row['email']; ?>" name="email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="email" required>
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Phone
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input value="<?php echo $row['phone']; ?>" name="phone" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" required>
                    </div>
                </div>

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="w-full">
                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" name="update">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <script src="./script.js"></script>
</body>

</html>