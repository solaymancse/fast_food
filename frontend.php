<?php
session_start();
include('./customer_registration.php');


// Handle order placement
if (isset($_POST['menu_id']) && isset($_SESSION['customer_id'])) {
    $menu_id = $_POST['menu_id'];
    $user_id = $_SESSION['customer_id'];
    $status = 'placed order'; // or any other status you want

    // Insert order into the database
    $sql = "INSERT INTO orders (user_id, menu_id, status) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iis", $user_id, $menu_id, $status);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Order placed successfully!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Error placing order.";
            $_SESSION['msg_type'] = "error";
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = "Error preparing order query.";
        $_SESSION['msg_type'] = "error";
    }
    header("Location: ./dashboard/CustomerDashboard.php");
    exit();
}

if (isset($_POST['submit'])) {
    $action = $_POST['submit'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($phone) || empty($password)) {
        $_SESSION['message'] = "Phone number and password are required.";
        $_SESSION['msg_type'] = "error";
    } else {
        if ($action === "Sign up") {
            // Sign-up logic remains the same as before
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO customers (email, phone, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sss", $email, $phone, $hashed_password);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['customer_id'] = mysqli_insert_id($conn);
                    $_SESSION['customer_logged_in'] = true;
                    $_SESSION['message'] = "Registration successful!";
                    $_SESSION['msg_type'] = "success";
                    header("Location: ./dashboard/CustomerDashboard.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error: " . mysqli_stmt_error($stmt);
                    $_SESSION['msg_type'] = "error";
                }
                mysqli_stmt_close($stmt);
            } else {
                $_SESSION['message'] = "Error preparing the statement.";
                $_SESSION['msg_type'] = "error";
            }
        } elseif ($action === "Login") {
            // Adjust the login query to only use the phone number
            $sql = "SELECT id, password FROM customers WHERE phone = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $phone);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    mysqli_stmt_bind_result($stmt, $customer_id, $hashed_password);
                    mysqli_stmt_fetch($stmt);

                    if (password_verify($password, $hashed_password)) {
                        $_SESSION['customer_id'] = $customer_id;
                        $_SESSION['customer_logged_in'] = true;
                        $_SESSION['message'] = "Login successful!";
                        $_SESSION['msg_type'] = "success";
                        header("Location: ./dashboard/CustomerDashboard.php");
                        exit();
                    } else {
                        $_SESSION['message'] = "Invalid password.";
                        $_SESSION['msg_type'] = "error";
                    }
                } else {
                    $_SESSION['message'] = "Account not found.";
                    $_SESSION['msg_type'] = "error";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }
}
$table_check_query = "SHOW TABLES LIKE 'menus'";
$table_check_result = mysqli_query($conn, $table_check_query);
if (mysqli_num_rows($table_check_result) > 0) {
    $sql = "SELECT * FROM menus ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
} else {
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>

    <!-- Tailwind CSS CDN link -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="shadow-lg w-full h-[80px]">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div>
                <h1 class="text-[#E21B70] font-bold text-xl">Fast Food</h1>
            </div>
            <div class="flex gap-4">
                <a href="./admin_login.php" class="btn border-2 font-semibold rounded-md px-4 py-2">Admin login</a>
                <a href="./restaurant_login.php" class="btn border-2 font-semibold rounded-md px-4 py-2">restaurant login</a>
                <div onclick="my_modal_2.showModal()" class="btn border-2 font-semibold rounded-md px-4 py-2">login</div>
                <div onclick="my_modal_1.showModal()" class="btn bg-[#E21B70] text-white font-semibold rounded-md px-4 py-2">sign up</div>
            </div>

            <dialog id="my_modal_2" class="modal">

                <form action="" method="post" class="modal-box flex flex-col gap-2">
                    <div>
                        <label onclick="my_modal_2.close()" for="my_modal_2" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                    </div>
                    <p class="text-xl text-center font-bold mb-4">Login</p>
                    <input name="phone" type="text" placeholder="Enter phone number" class="input input-bordered w-full" required />
                    <input name="password" type="password" placeholder="Enter password" class="input input-bordered w-full" required />
                    <input type="submit" name="submit" value="Login" class="input input-bordered w-full bg-[#E21B70] text-white" />
                </form>
            </dialog>
            <dialog id="my_modal_1" class="modal">
                <form action="" method="post" class="modal-box flex flex-col gap-2">
                    <div>
                        <label onclick="my_modal_1.close()" for="my_modal_2" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                    </div>
                    <p class="text-xl text-center font-bold mb-4">Sign up</p>
                    <input name="email" type="email" placeholder="Enter email" class="input input-bordered w-full" required />
                    <input name="phone" type="text" placeholder="Enter phone number" class="input input-bordered w-full" required />
                    <input name="password" type="password" placeholder="Enter password" class="input input-bordered w-full" required />
                    <input type="submit" name="submit" value="Sign up" class="input input-bordered hover:bg-[#E21B70] cursor-pointer w-full bg-[#E21B70] text-white" />
                </form>
            </dialog>
        </div>
    </div>

    <div class="w-full h-full flex justify-between">
        <div class="w-[50%] h-[80vh] flex flex-col justify-center ml-[100px]">
            <h1 class="text-4xl font-bold mb-4">It's the food and groceries you love,<br /> delivered</h1>
            <div class="flex h-[80px] shadow-xl rounded-xl justify-between items-center px-2">
                <input type="text" placeholder="Enter Your Location" class="border outline-none w-full py-2">
                <button class="btn bg-[#E21B70] text-white font-semibold rounded-md px-4">Find Food</button>
            </div>
        </div>
        <div class="w-[50%] h-[100vh]">
            <img src="https://images.deliveryhero.io/image/foodpanda/homepage/refresh-hero-home-bd.png?width=1264" alt="">
        </div>
    </div>


    <div class="max-w-7xl mx-auto py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
            // Check if the result has data
            if (!empty($result) && mysqli_num_rows($result) > 0) {
                // Loop through the result set
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <!-- Card image with status on top -->
                        <div class="relative">
                            <?php if (!empty($row['image'])) { ?>
                                <img src="restaurant/uploads/<?php echo $row['image']; ?>" alt="Image" class="w-full h-32 object-cover rounded-lg">
                            <?php } else { ?>
                                <span>No image</span>
                            <?php } ?>
                            <div class="absolute top-2 left-2 bg-<?php echo $row['status'] === 'available' ? 'green' : 'red'; ?>-500 text-white py-1 px-3 rounded-full text-sm">
                                <?php echo $row['status'] === 'available' ? 'Available' : 'Not Available'; ?>
                            </div>
                        </div>

                        <!-- Food Name -->
                        <h3 class="mt-4 text-xl font-semibold text-gray-800"><?php echo htmlspecialchars($row['name']); ?></h3>

                        <!-- Price -->
                        <p class="mt-2 text-lg text-gray-600">$<?php echo number_format($row['price'], 2); ?></p>

                        <!-- Order Button -->
                        <div class="mt-4">
                            <form method="POST" action="">
                                <input type="hidden" name="menu_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="w-full py-2 px-4 rounded-lg text-white font-semibold 
                                <?php echo $row['status'] === 'available' ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-gray-400 cursor-not-allowed'; ?>"
                                    <?php echo $row['status'] === 'available' ? '' : 'disabled'; ?>>
                                    <?php echo $row['status'] === 'available' ? 'Order' : 'Not Available'; ?>
                                </button>
                            </form>
                        </div>
                    </div>
            <?php }
            } else {
               
            }
            ?>
        </div>
    </div>



    <!-- Display message alerts -->
    <?php if (isset($_SESSION['message'])): ?>
        <script>
            alert('<?php echo $_SESSION['message']; ?>');
        </script>
        <?php unset($_SESSION['message']); // Clear the message after displaying 
        ?>
    <?php endif; ?>

</body>

</html>