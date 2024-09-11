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

</body>

</html>