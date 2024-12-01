<x-layout title="Jadwal | Guru">
    <x-navbar-teacher></x-navbar-teacher>
    {{-- container --}}
    <div class="mp-4 sm:mx-[250px]">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- content mobile --}}
        <div class="px-4 sm:flex sm:flex-wrap sm:justify-evenly sm:gap-4">
            @foreach ($days as $day)
                <div class="block max-w-sm p-4 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 w-full mb-2 sm:py-2 sm:h-[80px]"
                    onclick="openShowScheduleTeacher('{{ $day }}')">
                    <div class="flex justify-between sm:h-full">
                        <p class="font-semibold text-simipa-1 sm:self-start">{{ $day }} </p>
                        <p class="sm:self-end">Lihat selengkapnya...</p>
                    </div>
                </div>
                <x-teacher-modal-schedule :schedules="$schedules" :day="$day"></x-teacher-modal-schedule>
            @endforeach
        </div>


    </div>

    <script>
        function openShowScheduleTeacher(day) {
            document.getElementById('showTeacherScheduleModal' + day).classList.remove('hidden');
        }

        function closeShowScheduleTeacher(day) {
            document.getElementById('showTeacherScheduleModal' + day).classList.add('hidden');
        }
    </script>
</x-layout>
