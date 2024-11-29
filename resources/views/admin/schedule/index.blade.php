<x-layout title="Jadwal | Admin">
    <x-navbar-admin>
        {{-- header --}}
        <header class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold">Data Jadwal Guru</h1>
            <div>
                <button onclick="openCreateScheduleModal()"
                    class="px-2 py-2 bg-simipa-1 text-white rounded-lg hover:bg-simipa-2 w-full">
                    Tambah Data Jadwal
                </button>

            </div>

        </header>
        <hr class="my-4">




        @error('student')
            <div class="flex justify-center my-3">
                <div class="text-red-500 font-bold">{{ $message }}</div>
            </div>
        @enderror

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- table --}}
        <div>
            {{-- filter --}}
            <div class="mb-3 flex gap-3">
                <form action="/admin/schedule" method="GET" class="flex gap-2  items-center w-1/2">
                    <div class="w-full">
                        <select name="group_id" id="groupSelect" class="px-2 py-2 w-full rounded-lg shadow-md">
                            <option disabled selected>Filter Rombel</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">
                                    {{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tombol Aksi -->
                    <button type="submit"
                        class="px-4 py-1 bg-simipa-1 text-white rounded hover:bg-simipa-2">Cari</button>
                </form>
                <form action="/admin/schedule" method="GET" class="flex gap-2  items-center w-1/2">
                    <div class="w-full">
                        <select name="teacher_id" id="teacherSelect" class="px-2 py-2 w-full rounded-lg shadow-md">
                            <option disabled selected>Filter Guru</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">
                                    {{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tombol Aksi -->
                    <button type="submit"
                        class="px-4 py-1 bg-simipa-1 text-white rounded hover:bg-simipa-2">Cari</button>
                </form>
                <form action="/admin/schedule" method="GET" class="flex gap-2  items-center w-1/2">
                    <div class="w-full">
                        <select name="day_of_week" id="daySelect" class="px-2 py-2 w-full rounded-lg shadow-md">
                            <option disabled selected>Filter Hari</option>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="minggu">minggu</option>
                        </select>
                    </div>
                    <!-- Tombol Aksi -->
                    <button type="submit"
                        class="px-4 py-1 bg-simipa-1 text-white rounded hover:bg-simipa-2">Cari</button>
                </form>
                <form action="/admin/schedule" method="GET" class="flex gap-2  items-center w-1/2">
                    <div class="w-full">
                        <input type="text" placeholder="Cari berdasarkan nama" name="name"
                            class="px-2 py-2 w-full rounded-lg shadow-md">
                    </div>
                    <!-- Tombol Aksi -->
                    <button type="submit"
                        class="px-4 py-1 bg-simipa-1 text-white rounded hover:bg-simipa-2">Cari</button>
                </form>
                <div class="flex justify-end ">
                    <a href="/admin/schedule">
                        <button type="submit"
                            class="px-8 py-2 text-sm bg-simipa-1 text-white rounded-lg hover:bg-simipa-2">Hapus
                            Filter</button>
                    </a>
                </div>
            </div>


            {{-- content --}}
            <div class="relative overflow-x-auto rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs text-simipa-1 uppercase bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                rombel
                            </th>
                            <th scope="col" class="px-6 py-3">
                                mapel
                            </th>
                            <th scope="col" class="px-6 py-3">
                                guru
                            </th>
                            <th scope="col" class="px-6 py-3">
                                hari
                            </th>
                            <th scope="col" class="px-6 py-3">
                                mulai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                selesai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($schedules as $schedule)
                            <tr class="bg-simipa-6 border-b">
                                <td class="px-6 py-4 ">
                                    {{ $schedule->group->name }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $schedule->subject->name }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $schedule->teacher->name }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $schedule->day_of_week }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $schedule->start_time }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $schedule->end_time }}
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="flex gap-3">
                                        <button onclick="" data-target="">
                                            <svg class="w-6 h-6 text-gray-800 hover:text-simipa-2 mx-1"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                        </button>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirmDeletion()">
                                                <svg class="w-6 h-6 text-grey-800 hover:text-red-700"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </x-navbar-admin>

    <x-modal-create-schedule :groups="$groups" :teachers="$teachers" :subjects="$subjects"></x-modal-create-schedule>

    <script>
        function confirmDeletion() {
            return confirm("Apakah Anda yakin ingin menghapusnya?");
        }

        // create
        function openCreateScheduleModal() {
            document.getElementById('createModalSchedule').classList.remove('hidden');
        }

        function closeCreateScheduleModal() {
            document.getElementById('createModalSchedule').classList.add('hidden');
        }

        // edit
        function openEditScheduleModal(id) {
            document.getElementById('editModalSchedule' + id).classList.remove('hidden');
        }

        function closeEditScheduleModal(id) {
            document.getElementById('editModalSchedule' + id).classList.add('hidden');
        }
    </script>
</x-layout>
