<x-layout title="Presensi | Siswa">
    <x-navbar-teacher>

    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px]">
        <div class="flex flex-col items-center mb-4 border-b-2 text-simipa-2">
            <h1 class="judul">Lihat presensi {{ $group[0]->name }}
            </h1>
            <p class="tanggal">{{ \Carbon\Carbon::parse($day)->format('d-m-Y') }} </p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <p class="kegiatan border p-2 rounded-md ">Tipe: {{ $activity[0]->name }} <span
                    class="hidden">{{ $activity[0]->id }}</span>
            </p>
            <div>
                <button type="button"
                    class="submit-attendance-btn px-4 py-1 bg-simipa-2 text-white rounded hover:bg-gray-400 mr-2">Simpan</button>
            </div>
        </div>

        <div class="max-h-[60vh] overflow-y-auto sm:flex sm:flex-col sm:items-center">
            @forelse ($attendances as $attendance)
                {{ $attendance }}

            @empty
                <h1>Data kosong</h1>
            @endforelse
        </div>


    </div>



</x-layout>
