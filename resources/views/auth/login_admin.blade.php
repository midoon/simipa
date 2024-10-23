<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <div class="w-full bg-simipa-5 border">
        <div class="w-full flex justify-center items-center min-h-screen px-8">
            <div class="w-full md:max-w-sm rounded-xl bg-white p-10 border">
                <h1 class="text-center text-3xl font-bold text-simipa-1">Login</h1>
                <form action="" class="mt-10">
                    <div class="mb-10">
                        <input type="text" name="username" id="username" placeholder="username "
                            class="border-b-2 w-full focus:outline-none py-1.5">
                    </div>
                    <div class="mb-10">
                        <input type="password" name="password" id="password" placeholder="password"
                            class="border-b-2 w-full focus:outline-none py-1.5">
                    </div>
                    <div class="w-full text-center">
                        <button type="submit" class="px-20 py-2 bg-simipa-2 text-white rounded-full">Login
                            Admin</button>
                    </div>
                </form>
                <div class="mt-8">

                    <h3 class="text-simipa-2 text-center text-sm mt-5 hover:underline"><a href="#">Login sebagai
                            guru</a></h3>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
