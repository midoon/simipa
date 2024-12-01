<x-layout title="Dashboard | Guru">
    <x-navbar-teacher></x-navbar-teacher>

    <div class="px-4">
        <div class="px-3 flex justify-center mb-10 gap-3">
            <a href="" class="bg-simipa-2 text-white px-6 py-1 rounded-full">Presensi</a>
            <a href="" class="bg-simipa-2 text-white px-6 py-1 rounded-full">Jadwal</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="contailer">
            <h1 class="text-2xl mb-4 text-simipa-7">Jadwal hari {{ \Carbon\Carbon::now()->isoFormat('dddd') }}</h1>
            @forelse ($schedules as $schedule)
                <div class="flex gap-4 mb-2">
                    <div class="font-light">
                        <p>{{ $schedule->start_time }}</p>
                    </div>
                    <div
                        class="block max-w-sm p-4 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 w-full">
                        <div class="flex justify-between">
                            <h5 class="mb-2 text-lg font-bold tracking-tight text-simipa-1">
                                {{ $schedule->subject->name }}</h5>

                            <p class="text-sm">selesai: {{ $schedule->end_time }}</p>
                        </div>
                        <p class="font-normal text-gray-700 dark:text-gray-400"> Kelas: {{ $schedule->group->name }}
                        </p>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center text-gray-500">Tidak ada jadwal
                        mengajar hari ini</td>
                </tr>
            @endforelse
        </div>



        <div>



            {{-- {{ $teacherId }}
            <p>Hari ini adalah: {{ \Carbon\Carbon::now()->isoFormat('dddd') }}</p> --}}
        </div>
    </div>
</x-layout>
