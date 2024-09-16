<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="shadow-lg w-full h-[80px]">
        <div class="  max-w-7xl mx-auto flex justify-between items-center">
            <div>
                <h1 class="text-[#E21B70] font-bold text-xl">fast food</h1>
            </div>
            <div class="flex gap-4">
                <div class="btn border-2 font-semibold rounded-md px-4 py-2">login</div>
                <div onclick="my_modal_1.showModal()" class="btn bg-[#E21B70] text-white font-semibold rounded-md px-4 py-2">sign up</div>
            </div>

            <dialog id="my_modal_1" class="modal">
                <div class="modal-box flex flex-col gap-2">
                    <p class="text-xl text-center font-bold mb-4">Sign up</p>
                    <input type="email" placeholder="Enter email" class="input input-bordered w-full " />
                    <input type="password" placeholder="Enter password" class="input input-bordered w-full" />
                    <input type="submit" value="Submit" class="input input-bordered w-full bg-[#E21B70] text-white" />
                </div>
            </dialog>
        </div>
    </div>

    <div class="w-full h-full flex justify-between">
        <div class="w-[50%] h-[80vh]  flex flex-col justify-center ml-[100px]">
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

</body>

</html>