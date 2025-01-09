<x-layout title="Kelas | Admin">
    <x-navbar-admin>
        <!-- Header -->
        <header class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold">Data Kelas & Rombel</h1>
            <div class="flex justify-center gap-3">
                <button onclick="createGradeModal()"
                    class="px-4 py-2 bg-simipa-1 text-white rounded-lg hover:bg-simipa-2">
                    Tambah Data Kelas
                </button>
                <button onclick="createGroupModal()"
                    class="px-4 py-2 bg-simipa-1 text-white rounded-lg hover:bg-simipa-2">
                    Tambah Data Rombel
                </button>
            </div>
        </header>
        <hr class="my-4">
        @error('error')
            <div class="flex justify-center my-3">
                <div class="text-red-500 font-bold">{{ $message }}</div>
            </div>
        @enderror
        @error('kelas')
            <div class="flex justify-center my-3">
                <div class="text-red-500 font-bold">{{ $message }}</div>
            </div>
        @enderror
        @error('rombel')
            <div class="flex justify-center my-3">
                <div class="text-red-500 font-bold">{{ $message }}</div>
            </div>
        @enderror


        <div class="grid grid-cols-5 gap-6">
            {{-- table kelas --}}
            <div class="col-span-2">
                <div class="relative overflow-x-auto rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs text-simipa-1 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama
                                </th>
                                <th scope="col" class="px-1 py-3">
                                    Opsi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr class="bg-simipa-6 border-b ">

                                    <td class="px-6 py-4">
                                        {{ $grade->name }}
                                    </td>
                                    <td class="px-1 py-4">
                                        <div class="flex gap-3">
                                            <button onclick="editGradeModal({{ $grade->id }})">
                                                <svg class="w-6 h-6 text-gray-800 hover:text-simipa-2 mx-1"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                </svg>
                                            </button>
                                            <form action="/admin/grade/{{ $grade->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirmDeletion()">
                                                    <svg class="w-6 h-6 text-gray-800 hover:text-red-700"
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
                                <x-modal-edit-grade :grade="$grade"></x-modal-edit-grade>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- table rombel --}}
            <div class="col-span-3">
                <div class="relative overflow-x-auto rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs text-simipa-1 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Rombel
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    kelas
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Opsi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr class="bg-simipa-6 border-b ">

                                    <td class="px-6 py-4">
                                        {{ $group->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $group->grade->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-3">
                                            <button onclick="editGroupModal({{ $group->id }})">
                                                <svg class="w-6 h-6 text-gray-800 hover:text-simipa-2 mx-1"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                </svg>
                                            </button>
                                            <form action="/admin/group/{{ $group->id }}" method="POST">
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
                                <x-modal-edit-group :grades="$grades" :group="$group"></x-modal-edit-group>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </x-navbar-admin>

    <x-modal-create-grade></x-modal-create-grade>
    <x-modal-create-group :grades="$grades"></x-modal-create-group>


    <script>
        function confirmDeletion() {
            return confirm("Apakah Anda yakin ingin menghapusnya?");
        }

        //Kelas
        function createGradeModal() {
            document.getElementById('createModalGrade').classList.toggle('hidden');
        }

        function editGradeModal(id) {
            document.getElementById('editModalGrade' + id).classList.toggle('hidden');
        }



        // Rombel
        function createGroupModal() {
            document.getElementById('createModalGroup').classList.toggle('hidden');
        }

        function editGroupModal(id) {
            document.getElementById('editModalGroup' + id).classList.toggle('hidden');
        }
    </script>
</x-layout>
