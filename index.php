<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animate.min.css"/>

    <script defer src="js/cdn.min.js"></script>
    <script src="js/fa.js"></script>
    <script src="js/tailwind.18"></script>
    <title>Welcome Blue Telecoms</title>
</head>

<body class="bg-white">
<div class="w-full flex items-center justify-start" x-data="{ login_page: true, password_page: false }">

    <div class="w-3/4 relative hidden lg:block">
        <canvas id="nokey" class="w-full h-screen absolute"></canvas>
        <img class="w-full h-screen " src="assets/img/bg23.jpg">
        <div class="absolute top-48 right-48 p-2 animate__animated animate__bounceInLeft">
            <img src="assets/img/logo.png" class="w-[650px]">
        </div>
    </div>
    <div x-show="login_page" class="flex-1 mx-4 md:mx-16 animate__animated animate__bounceIn">
        <header>
            <img class="w-20 mx-auto mb-5" src="assets/img/user.png"/>
        </header>
        <form>
            <div>
                <label class="block mb-2 text-blue-500" for="username"><i class="fa fa-user"></i> User Name</label>
                <input
                        class="w-full p-2 mb-6 text-blue-700 border-b-2 border-blue-500 outline-none focus:bg-gray-300"
                        type="text" name="u_id">
            </div>
            <div>
                <label class="block mb-2 text-blue-500" for="password"> <i class="fa fa-key"></i> Password</label>
                <input class="w-full p-2 text-blue-700 border-b-2 border-blue-500 outline-none focus:bg-gray-300"
                       type="password" name="password">
            </div>

            <div class="mb-6 float-right">
                <a class="text-blue-700 hover:text-pink-700 text-sm font-bold" href="#"
                   @click="password_page = true; login_page = false">Forgot
                    Password?</a>
            </div>
            <div>
                <button
                        class="w-full bg-blue-700 hover:bg-indigo-700 text-white font-bold py-2 px-4 mb-6 rounded uppercase">
                    Login
                </button>
            </div>
        </form>
    </div>
    <div x-show="password_page" class="flex-1 mx-4 md:mx-20 animate__animated animate__bounceIn">
        <header>
            <img class="w-20 mx-auto mb-5" src="images/user.png"/>
        </header>
        <form>
            <div>
                <label class="block mb-2 text-blue-500" for="username">Email</label>
                <input class="w-full p-2 text-blue-700 border-b-2 border-blue-500 outline-none focus:bg-gray-300"
                       type="email" name="email">
            </div>

            <div class="mb-6 float-right">
                <a class="text-blue-700 hover:text-pink-700 text-sm font-bold" href="#"
                   @click="password_page = false; login_page = true">Return to Login?</a>
            </div>
            <div>
                <button
                        class="w-full bg-blue-700 hover:bg-indigo-700 text-white font-bold py-2 px-4 mb-6 rounded uppercase">
                    Send
                </button>
            </div>
        </form>
    </div>
</div>

<script src="js/background.js"></script>
</body>

