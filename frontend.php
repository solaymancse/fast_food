<?php
session_start();
include('./customer_registration.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if (empty($email) || empty($phone) || empty($password)) {
        $_SESSION['message'] = "All fields are required.";
        $_SESSION['msg_type'] = "error";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO customers (email, phone, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $email, $phone, $hashed_password);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = "Registration successful!";
                $_SESSION['msg_type'] = "success";
                header("Location: " . "./dashboard/CustomerDashboard.php");
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
    }
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
                <div class="btn border-2 font-semibold rounded-md px-4 py-2">login</div>
                <div onclick="my_modal_1.showModal()" class="btn bg-[#E21B70] text-white font-semibold rounded-md px-4 py-2">sign up</div>
            </div>

            <dialog id="my_modal_1" class="modal">
                <form action="" method="post" class="modal-box flex flex-col gap-2">
                    <p class="text-xl text-center font-bold mb-4">Sign up</p>
                    <input name="email" type="email" placeholder="Enter email" class="input input-bordered w-full" required />
                    <input name="phone" type="text" placeholder="Enter phone number" class="input input-bordered w-full" required />
                    <input name="password" type="password" placeholder="Enter password" class="input input-bordered w-full" required />
                    <input type="submit" name="submit" value="Submit" class="input input-bordered w-full bg-[#E21B70] text-white" />
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