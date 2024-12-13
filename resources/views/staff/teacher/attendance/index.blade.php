<x-layout title="Presensi | Guru">
    <x-navbar-teacher></x-navbar-teacher>
    <div class="px-4 sm:mx-[250px] sm:flex sm:flex-col sm:justify-center sm:items-center">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- card-fitur --}}
        <div class="grid grid-cols-2 gap-3 sm:w-3/4 sm:grid-cols-4">
            <div class="shadow-md border aspect-[4/3] gap-4 rounded-lg flex flex-col items-center justify-center sm:hover:cursor-pointer"
                onclick="openCreateAttendance()">
                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h4M9 3v4a1 1 0 0 1-1 1H4m11 6v4m-2-2h4m3 0a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
                </svg>
                <h1>Tambah Presensi</h1>
            </div>
            <div class="shadow-md border aspect-[4/3] gap-4 rounded-lg flex flex-col items-center justify-center sm:hover:cursor-pointer"
                onclick=" openReadAttendance()">
                <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                </svg>

                <h1>Lihat Presensi</h1>
            </div>
            <div class="shadow-md border aspect-[4/3] gap-4 rounded-lg flex flex-col items-center justify-center sm:hover:cursor-pointer"
                onclick=" openEditAttendance()">
                <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                </svg>

                <h1>Edit Presensi</h1>
            </div>
            <div
                class="shadow-md border aspect-[4/3] gap-4 rounded-lg flex flex-col items-center justify-center sm:hover:cursor-pointer">
                <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                </svg>

                <h1>Rekap Presensi</h1>
            </div>
        </div>
    </div>

    <x-teacher-modal-create-attendance :activities="$activities" :groups="$groups"></x-teacher-modal-create-attendance>
    <x-teacher-modal-read-attendance :activities="$activities" :groups="$groups"></x-teacher-modal-read-attendance>
    <x-teacher-modal-edit-attendance :activities="$activities" :groups="$groups"></x-teacher-modal-edit-attendance>

    <script>
        function openCreateAttendance() {
            document.getElementById('createAttendance').classList.remove('hidden');
        }

        function closeCreateAttendance() {
            document.getElementById('createAttendance').classList.add('hidden');
        }

        // read
        function openReadAttendance() {
            document.getElementById('readAttendance').classList.remove('hidden');
        }

        function closeReadAttendance() {
            document.getElementById('readAttendance').classList.add('hidden');
        }

        //edit
        function openEditAttendance() {
            document.getElementById('editAttendance').classList.remove('hidden');
        }

        function closeEditAttendance() {
            document.getElementById('editAttendance').classList.add('hidden');
        }
    </script>

</x-layout>
