<x-layout>
    <x-slot:title>Siswa | Admin</x-slot:title>
    <x-navbar-admin>

        {{-- header --}}
        <header class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold">Data Siswa</h1>
            <div>
                <button onclick="createStudenModal()"
                    class="px-2 py-2 bg-simipa-1 text-white rounded-lg hover:bg-simipa-2 w-full">
                    Tambah Data Siswa
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
            <div class="mb-3">
                <div class="flex gap-3 border">
                    {{-- by group --}}
                    <form action="/admin/student" method="GET" class="flex gap-2  items-center w-1/4">
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
                    {{-- by grade --}}
                    <form action="/admin/student" method="GET" class="flex gap-2  items-center w-1/4">
                        <div class="w-full">
                            <select name="grade_id" id="gradeSelect" class="px-2 py-2 w-full rounded-lg shadow-md">
                                <option disabled selected>Filter Kelas</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">
                                        {{ $grade->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Tombol Aksi -->
                        <button type="submit"
                            class="px-4 py-1 bg-simipa-1 text-white rounded hover:bg-simipa-2">Cari</button>
                    </form>
                    {{-- by name --}}
                    <form action="/admin/student" method="GET" class="flex gap-2  items-center w-1/4">
                        <div class="w-full">
                            <input type="text" placeholder="Cari berdasarkan nama" name="name"
                                class="px-2 py-2 w-full rounded-lg shadow-md">
                        </div>
                        <!-- Tombol Aksi -->
                        <button type="submit"
                            class="px-4 py-1 bg-simipa-1 text-white rounded hover:bg-simipa-2">Cari</button>
                    </form>
                    {{-- delete filter --}}
                    <div class="flex justify-end w-1/4">
                        <a href="/admin/student">
                            <button type="submit"
                                class="px-8 py-2 bg-simipa-1 text-white rounded-lg hover:bg-simipa-2">Hapus
                                Filter</button>
                        </a>
                    </div>
                </div>
            </div>

            {{-- content --}}
            <div class="relative overflow-x-auto rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs text-simipa-1 uppercase bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                NISN
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jenis Kelamin
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rombel
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($students as $student)
                            <tr class="bg-simipa-6 border-b">
                                <td class="px-6 py-4 ">
                                    {{ $student->nisn }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $student->name }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $student->gender }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $student->group->name }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ $student->group->grade->name }}
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="flex gap-3">
                                        <button onclick="editStudenModal({{ $student->id }})" data-target="">
                                            <svg class="w-6 h-6 text-gray-800 hover:text-simipa-2 mx-1"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                        </button>
                                        <form action="/admin/student/{{ $student->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirmDeletion()">
                                                <svg class="w-6 h-6 text-grey-800 hover:text-red-700" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <x-modal-edit-student :groups="$groups" :student="$student"></x-modal-edit-student>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </x-navbar-admin>

    <x-modal-create-student :groups="$groups"></x-modal-create-student>


    <script>
        function confirmDeletion() {
            return confirm("Apakah Anda yakin ingin menghapusnya?");
        }

        function createStudenModal() {
            document.getElementById('createModalStudent').classList.toggle('hidden');
        }



        // edit
        function editStudenModal(id) {
            document.getElementById('editModalStudent' + id).classList.toggle('hidden');
        }
    </script>
</x-layout>
