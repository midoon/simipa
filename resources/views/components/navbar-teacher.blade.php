<div class="mb-6 sm:px-[250px] sm:mb-20 ">
    <nav class="bg-white sticky top-0 z-50  sm:flex sm:items-center sm:justify-between">
        <div class="max-w-7xl  flex gap-3 items-center px-4 py-3">
            <!-- Logo atau Nama -->
            <a href="/teacher/dashboard" class="text-lg font-bold text-gray-700 hover:text-gray-900">
                <img src="{{ asset('images/logo.png') }}" alt="logo.png" width="40" class="sm:w-[50px]">
            </a>

            <h1 class="font-semibold text-simipa-1 text-sm sm:text-xl">Hello, {{ session('teacher')['name'] }}</h1>

        </div>

        <div class="hidden sm:flex sm:gap-2">
            <a href="/teacher/attendance" class="bg-simipa-2 text-white px-8 py-2 rounded-full">Presensi</a>
            <a href="/teacher/schedule" class="bg-simipa-2 text-white px-8 py-2 rounded-full">Jadwal</a>
            @if (session('teacher')['role'][1] == 'bendahara' || session('teacher')['role'][0] == 'bendahara')
                <a href="/teacher/payment" class="bg-simipa-2 text-white px-8 py-2 rounded-full">Pembayaran</a>
            @endif
        </div>
    </nav>
</div>

<div class=" flex justify-center mb-10 gap-3  sm:hidden">
    <div>
        <button onclick="toggleDropdown('presensiDropdown')"
            class="bg-simipa-2 text-white px-4 py-1 rounded-full">Presensi</button>
        <div id="presensiDropdown" class="hidden absolute bg-white text-gray-800 rounded-md shadow-md mt-2 w-48 z-10">
            <a href="/teacher/attendance/read" class="block px-4 py-2 hover:bg-gray-200">Lihat Presensi</a>
            <a href="/teacher/attendance/create" class="block px-4 py-2 hover:bg-gray-200">Tambah Presensi</a>
            <a href="/rekap-presensi" class="block px-4 py-2 hover:bg-gray-200">Rekap Presensi</a>
        </div>
    </div>


    <a href="/teacher/schedule" class="bg-simipa-2 text-white px-4 py-1 rounded-full">Jadwal</a>
    @if (session('teacher')['role'][1] == 'bendahara' || session('teacher')['role'][0] == 'bendahara')
        <a href="/teacher/payment" class="bg-simipa-2 text-white px-4 py-1 rounded-full">Pembayaran</a>
    @endif
</div>

<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    }
</script>
