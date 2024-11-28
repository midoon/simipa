<div class=" flex min-h-screen">
    <aside class="bg-simipa-6 w-64 text-gray-100 flex-shrink-0 fixed h-full">

        <div class="py-3 mt-5 flex gap-2 justify-center items-center ">
            <img src="{{ asset('images/logo.png') }}" alt="logo.png" width="50">
            <p class=" text-simipa-1 font-bold ">Selamat datang</p>
        </div>
        <nav class="mt-8">
            <a href="/admin/teacher"
                class="text-simipa-1 font-semibold transition-colors hover:text-simipa-6 block py-3 px-4 rounded-lg hover:bg-simipa-2 group">
                <div class="flex ml-5">
                    <svg class="w-6 h-6 text-simipa-1 transition-colors group-hover:text-simipa-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <p class="ml-2">Guru</p>
                </div>
            </a>
            <a href="/admin/grade"
                class="text-simipa-1 font-semibold transition-colors hover:text-simipa-6 block py-3 px-4 rounded-lg hover:bg-simipa-2 group">
                <div class="flex ml-5">
                    <svg class="w-6 h-6 text-simipa-1 transition-colors group-hover:text-simipa-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                    </svg>

                    <p class="ml-2">Kelas</p>
                </div>
            </a>
            <a href="/admin/student"
                class="text-simipa-1 font-semibold transition-colors hover:text-simipa-6 block py-3 px-4 rounded-lg hover:bg-simipa-2 group">
                <div class="flex ml-5">
                    <svg class="w-6 h-6 text-simipa-1 transition-colors group-hover:text-simipa-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <p class="ml-2">Siswa</p>
                </div>
            </a>
            <a href="/admin/subject"
                class="text-simipa-1 font-semibold transition-colors hover:text-simipa-6 block py-3 px-4 rounded-lg hover:bg-simipa-2 group">
                <div class="flex ml-5">
                    <svg class="w-6 h-6 text-simipa-1 transition-colors group-hover:text-simipa-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4" />
                    </svg>

                    <p class="ml-2">Mata Pelajaran</p>
                </div>
            </a>
            <a href="/admin/schedule"
                class="text-simipa-1 font-semibold transition-colors hover:text-simipa-6 block py-3 px-4 rounded-lg hover:bg-simipa-2 group">
                <div class="flex ml-5">
                    <svg class="w-6 h-6 text-simipa-1 transition-colors group-hover:text-simipa-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                    </svg>

                    <p class="ml-2">Jadwal Pelajaran</p>
                </div>
            </a>
            <a href="#"
                class="text-simipa-1 font-semibold transition-colors hover:text-simipa-6 block py-3 px-4 rounded-lg hover:bg-simipa-2 group">
                <div class="flex ml-5">
                    <svg class="w-6 h-6 text-simipa-1 transition-colors group-hover:text-simipa-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 2a10 10 0 1 0 10 10A10.009 10.009 0 0 0 12 2Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.093 20.093 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM10 3.707a8.82 8.82 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.755 45.755 0 0 0 10 3.707Zm-6.358 6.555a8.57 8.57 0 0 1 4.73-5.981 53.99 53.99 0 0 1 3.168 4.941 32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.641 31.641 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM12 20.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 15.113 13a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                            clip-rule="evenodd" />
                    </svg>

                    <p class="ml-2">Kegiatan</p>
                </div>
            </a>
            <a href="#"
                class="text-simipa-1 font-semibold transition-colors hover:text-simipa-6 block py-3 px-4 rounded-lg hover:bg-simipa-2 group">
                <div class="flex ml-5">
                    <svg class="w-6 h-6 text-simipa-1 transition-colors group-hover:text-simipa-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                    </svg>

                    <p class="ml-2">Pembayaran</p>
                </div>
            </a>
        </nav>

        <div class="absolute bottom-0 left-0 w-full p-4">
            <a href="/logout" class="block py-2 px-4 rounded bg-simipa-1 hover:bg-red-600 text-center">Logout</a>
        </div>
    </aside>

    {{-- main --}}
    <div class="flex-1 ml-64">
        <main class="p-8 bg-gray-100 min-h-screen">
            {{ $slot }}
        </main>
    </div>
</div>
