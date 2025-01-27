<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>Admin | Dashboard</title>
</head>

<body>
    <x-navbar-admin>
        <!-- Header -->
        <header class="flex items-center justify-between bg-white p-6">
            <h1 class="text-3xl font-semibold text-simipa-1">Dashboard</h1>
        </header>
        <hr class="my-4">


        <div class="bg-white p-6  shadow-md">
            <!-- Dashboard Content -->
            <section class="grid grid-cols-1 md:grid-cols-2  gap-6">
                <div class="p-6 bg-gray-100 rounded-lg shadow">
                    <h3 class="text-xl font-semibold">Jumlah Siswa</h3>
                    <p class="mt-2 text-gray-600">{{ $cStudent }} siswa </p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow">
                    <h3 class="text-xl font-semibold">Jumlah Guru</h3>
                    <p class="mt-2 text-gray-600">{{ $cTeacher }} guru </p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow">
                    <h3 class="text-xl font-semibold">Jumlah Akun Guru</h3>
                    <p class="mt-2 text-gray-600">{{ $cTeacherAccount }} guru sudah mendaftar pada sistem</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow">
                    <h3 class="text-xl font-semibold">Revenue</h3>
                    <p class="mt-2 text-gray-600">Display revenue summary</p>
                </div>
            </section>

            <!-- Additional Content -->
            <section class="mt-8 grid grid-cols-2 gap-6">


            </section>
        </div>




    </x-navbar-admin>



</body>

</html>
