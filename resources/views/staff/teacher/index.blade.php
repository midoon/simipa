<x-layout title="Dashboard | Guru">
    <x-navbar-teacher></x-navbar-teacher>

    <div class="px-4 sm:mx-[250px]">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="">
            <h1 class="text-2xl mb-4 text-simipa-7  font-semibold text-center">Jadwal
                Hari {{ \Carbon\Carbon::now()->isoFormat('dddd') }}</h1>
            <div class="sm:flex sm:flex-wrap sm justify-center ">
                @forelse ($schedules as $schedule)
                    <div
                        class="block p-2 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 mb-2 sm:w-2/3 sm:h-[90px] sm:flex sm:flex-wrap sm:p-3">
                        <div class="flex justify-between sm:w-full">
                            <h5 class="mb-2 text-md font-bold tracking-tight text-simipa-1 sm:text-lg">
                                {{ $schedule->subject->name }}
                            </h5>

                            <p class="text-xs sm:text-sm">Mulai: {{ $schedule->start_time }}</p>
                        </div>
                        <div class="flex justify-between sm:w-full sm:self-end">
                            <p class="font-normal text-gray-700 dark:text-gray-400 text-sm sm:text-lg">
                                {{ $schedule->group->name }}
                            </p>
                            <p class="text-xs sm:text-sm">Selesai: {{ $schedule->end_time }}</p>
                        </div>
                    </div>
                @empty
                    <div>
                        <p class="text-center">Tidak ada jadwal mengajar hari ini</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
