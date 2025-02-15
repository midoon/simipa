<x-layout title="Kegiatan | Admin">
    <x-navbar-admin>
        {{-- header --}}
        <header class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold">Data Kegiatan Siswa</h1>
            <div>
                <button onclick="createActivityModal()"
                    class="px-2 py-2 bg-simipa-1 text-white rounded-lg hover:bg-simipa-2 w-full">
                    Tambah Data Kegiatan
                </button>

            </div>

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

        {{-- table --}}
        <div class="relative overflow-x-auto rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs text-simipa-1 uppercase bg-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama Kegiatan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deskripsi
                        </th>

                        <th scope="col" class="px-6 py-3">
                            opsi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr class="bg-simipa-6 border-b">
                            <td class="px-6 py-4 ">
                                {{ $activity->name }}
                            </td>
                            <td class="px-6 py-4 ">
                                {{ $activity->description }}
                            </td>

                            <td class="px-6 py-4 ">
                                <div class="flex gap-3">
                                    <button onclick="editActivityModal({{ $activity->id }})" data-target="">
                                        <svg class="w-6 h-6 text-gray-800 hover:text-simipa-2 mx-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                    </button>
                                    <form action="/admin/activity/{{ $activity->id }}" method="POST">
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
                        <x-modal-edit-activity :activity="$activity"></x-modal-edit-activity>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-navbar-admin>

    <x-modal-create-activity></x-modal-create-activity>
    <script>
        function closeErrorBtn(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function confirmDeletion() {
            return confirm("Apakah Anda yakin ingin menghapusnya?");
        }

        // create
        function createActivityModal() {
            document.getElementById('createModalActivity').classList.toggle('hidden');
        }



        // edit
        function editActivityModal(id) {
            document.getElementById('editModalActivity' + id).classList.toggle('hidden');
        }
    </script>
</x-layout>
