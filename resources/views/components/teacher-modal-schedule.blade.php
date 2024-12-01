@props(['schedules', 'day'])

<div id="showTeacherScheduleModal{{ $day }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-10/12 p-4 sm:w-1/2 sm:py-10">
            <div class="max-h-[60vh] overflow-y-auto sm:flex sm:flex-wrap sm:justify-center">
                @foreach ($schedules as $schedule)
                    @if ($schedule->day_of_week == $day)
                        <div
                            class="block p-2 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 mb-2 sm:w-2/3">
                            <div class="flex justify-between">
                                <h5 class="mb-2 text-md font-bold tracking-tight text-simipa-1">
                                    {{ $schedule->subject->name }}
                                </h5>

                                <p class="text-xs">Mulai: {{ $schedule->start_time }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="font-normal text-gray-700 dark:text-gray-400 text-sm">
                                    {{ $schedule->group->name }}
                                </p>
                                <p class="text-xs">selesai: {{ $schedule->end_time }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="flex justify-end mt-3">
                <button type="button" onclick="closeShowScheduleTeacher('{{ $day }}')"
                    class="px-4 py-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Tutup</button>
            </div>
        </div>
    </div>
</div>
