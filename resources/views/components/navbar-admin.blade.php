<div class=" flex min-h-screen">
    <aside class="bg-simipa-1 w-64 text-gray-100 flex-shrink-0 fixed h-full">
        <div class="p-6 ">
            <h2 class="text-2xl font-semibold text-simipa-6"><a href="/admin/dashboard">Admin Dashboard</a></h2>
            <p class="mt-2 text-simipa-5">Welcome, {{ session('user.username') }}</p>
        </div>
        <nav class="mt-8">
            <a href="/admin/teacher" class="block py-3 px-4 rounded hover:bg-simipa-2">Guru</a>
            <a href="/#" class="block py-3 px-4 rounded hover:bg-simipa-2">Kelas</a>
            <a href="/#" class="block py-3 px-4 rounded hover:bg-simipa-2">Siswa</a>
            <a href="/#" class="block py-3 px-4 rounded hover:bg-simipa-2">Mata Pelajaran</a>
            <a href="/#" class="block py-3 px-4 rounded hover:bg-simipa-2">Jadwal</a>
            <a href="/#" class="block py-3 px-4 rounded hover:bg-simipa-2">Kegiatan</a>
            <a href="/#" class="block py-3 px-4 rounded hover:bg-simipa-2">Pembayaran</a>
        </nav>
    </aside>

    {{-- main --}}
    <div class="flex-1 ml-64">
        <main class="p-8 bg-gray-100 min-h-screen">
            {{ $slot }}
        </main>
    </div>
</div>
