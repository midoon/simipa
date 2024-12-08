<x-layout title="Presensi | Siswa">
    <x-navbar-teacher>

    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px]">


        <div class="flex flex-col items-center mb-4 border-b-2 text-simipa-2">
            <h1 class="judul">Presensi {{ $group[0]->name }} : {{ $activity[0]->name }}
            </h1>
            <p class="tanggal">{{ \Carbon\Carbon::parse($day)->format('d-m-Y') }} </p>
        </div>


        <div class="max-h-[60vh] overflow-y-auto sm:flex sm:flex-col sm:items-center">
            @forelse ($attendances as $attendance)
                <div class="flex justify-between py-4 px-4 border rounded-lg mb-2 sm:w-2/3">
                    <p>{{ $attendance->student->name }}</p>
                    <p>{{ $attendance->status }}</p>
                </div>

            @empty
                <h1>Data kosong</h1>
            @endforelse
        </div>


    </div>



</x-layout>
