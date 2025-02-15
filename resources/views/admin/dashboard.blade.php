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
        @if ($errors->any())
            <div id="error-any" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <div class="flex justify-between">
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="btn-error-any p-3" onclick="closeErrorBtn('error-any')">&#10006</button>
                </div>
            </div>
        @endif


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
                    <h3 class="text-xl font-semibold">Total Tagihar Terbayar</h3>
                    <p class="mt-2 text-gray-600">Rp. {{ $paidFee }} terbayar dari Rp. {{ $totalFee }}</p>
                </div>
            </section>

            <!-- Additional Content -->
            <section class="mt-8 grid grid-cols-2 gap-6">


            </section>
        </div>




    </x-navbar-admin>


    <script>
        function closeErrorBtn(id) {
            document.getElementById(id).classList.toggle('hidden');
        }
    </script>

</body>

</html>
