<x-layout>
    <x-slot:title>Guru | Admin</x-slot:title>
    <x-navbar-admin>
        <!-- Header -->
        <header class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold">Data Guru</h1>
            <div>
                <button onclick="createModalTeacher()"
                    class="px-4 py-2 bg-simipa-1 text-white rounded-lg hover:bg-simipa-2">
                    Tambah Data Guru
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

        <div>
            <div class="relative overflow-x-auto rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs text-simipa-1 uppercase bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jenis Kelamin
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Akses
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr class="bg-simipa-6 border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $teacher->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $teacher->nik }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $teacher->gender }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ implode(', ', $teacher->role) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-3">
                                        <button onclick="editModalTeacher({{ $teacher->id }})"
                                            data-target="#editModalTeacher{{ $teacher->id }}">
                                            <svg class="w-6 h-6 text-gray-800 hover:text-simipa-2 mx-1"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                        </button>
                                        <form action="/admin/teacher/{{ $teacher->id }}" method="POST">
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
                            <x-modal-edit-teacher :teacher="$teacher"></x-modal-edit-teacher>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5 ">
                    {{ $teachers->links() }}
                </div>
            </div>

        </div>
    </x-navbar-admin>


    <x-modal-create-teacher></x-modal-create-teacher>


    <script>
        function closeErrorBtn(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function confirmDeletion() {
            return confirm("Apakah Anda yakin ingin menghapusnya?");
        }

        function createModalTeacher() {
            document.getElementById('createModalTeacher').classList.toggle('hidden');
        }



        function editModalTeacher(id) {
            document.getElementById('editModalTeacher' + id).classList.toggle('hidden');
        }
    </script>


</x-layout>
