<div class="mb-6 sm:px-[250px] sm:mb-20">
    <nav class="bg-white sticky top-0 z-50 sm:flex sm:items-center sm:justify-between">
        <div class="max-w-7xl  flex gap-3 items-center px-4 py-3">
            <!-- Logo atau Nama -->
            <a href="/teacher/dashboard" class="text-lg font-bold text-gray-700 hover:text-gray-900">
                <img src="{{ asset('images/logo.png') }}" alt="logo.png" width="40" class="sm:w-[50px]">
            </a>

            <h1 class="font-semibold text-simipa-1 text-sm sm:text-xl">Hello, {{ session('teacher')['name'] }}</h1>
        </div>

        <div class="hidden sm:flex sm:gap-2">
            <a href="" class="bg-simipa-2 text-white px-8 py-2 rounded-full">Presensi</a>
            <a href="/teacher/schedule" class="bg-simipa-2 text-white px-8 py-2 rounded-full">Jadwal</a>
        </div>
    </nav>
</div>

<div class="px-3 flex justify-center mb-10 gap-3 sm:hidden">
    <a href="" class="bg-simipa-2 text-white px-6 py-1 rounded-full">Presensi</a>
    <a href="/teacher/schedule" class="bg-simipa-2 text-white px-6 py-1 rounded-full">Jadwal</a>
</div>
