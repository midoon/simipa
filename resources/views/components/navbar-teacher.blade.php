<div class="mb-6 sm:px-[250px] sm:mb-20 ">
    <nav class="bg-white sticky top-0 z-50 flex items-center justify-between  sm:flex sm:items-center ">
        <div class="max-w-7xl  flex gap-3 items-center px-4 py-3">
            <!-- Logo atau Nama -->
            <a href="/teacher/dashboard" class="text-lg font-bold text-gray-700 hover:text-gray-900">
                <img src="{{ asset('images/logo.png') }}" alt="logo.png" width="40" class="sm:w-[50px]">
            </a>

            <h1 class="font-semibold text-simipa-1 text-sm sm:text-xl">Hello, {{ session('teacher')['name'] }}</h1>

        </div>

        <div class="sm:flex">
            <div class="hidden sm:flex sm:gap-2 sm:items-center">
                <div>
                    <button onclick="toggleDropdown('presensiDropdownDesktop')"
                        class="bg-simipa-2 text-white px-8 py-2 rounded-full">Presensi</button>
                    <div id="presensiDropdownDesktop"
                        class="hidden absolute bg-white text-gray-800 rounded-md shadow-md mt-2 w-48 z-10">
                        <a href="/teacher/attendance/read" class="block px-4 py-2 hover:bg-gray-200">Lihat Presensi</a>
                        <a href="/teacher/attendance/create" class="block px-4 py-2 hover:bg-gray-200">Tambah
                            Presensi</a>
                        <a href="/rekap-presensi" class="block px-4 py-2 hover:bg-gray-200">Rekap Presensi</a>
                    </div>
                </div>
                <a href="/teacher/schedule" class="bg-simipa-2 text-white px-8 py-2 rounded-full">Jadwal</a>
                @if (collect(session('teacher')['role'])->contains('bendahara'))
                    <a href="/teacher/payment" class="bg-simipa-2 text-white px-8 py-2 rounded-full">Pembayaran</a>
                @endif
            </div>


            <form action="/teacher/logout" method="POST" class="m-3 sm:ml-3">
                @method('DELETE')
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-center w-full rounded-full text-white">
                    Logout
                </button>
            </form>
        </div>

    </nav>
</div>

<div class=" flex justify-center mb-10 gap-3  sm:hidden">
    <div>
        <button onclick="toggleDropdown('presensiDropdownMobile')"
            class="bg-simipa-2 text-white px-4 py-1 rounded-full">Presensi</button>
        <div id="presensiDropdownMobile"
            class="hidden absolute bg-white text-gray-800 rounded-md shadow-md mt-2 w-48 z-10">
            <a href="/teacher/attendance/read" class="block px-4 py-2 hover:bg-gray-200">Lihat Presensi</a>
            <a href="/teacher/attendance/create" class="block px-4 py-2 hover:bg-gray-200">Tambah Presensi</a>
            <a href="/rekap-presensi" class="block px-4 py-2 hover:bg-gray-200">Rekap Presensi</a>
        </div>
    </div>


    <a href="/teacher/schedule" class="bg-simipa-2 text-white px-4 py-1 rounded-full">Jadwal</a>
    @if (collect(session('teacher')['role'])->contains('bendahara'))
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
