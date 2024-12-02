<x-layout title="Presensi | Siswa">
    <x-navbar-teacher>

    </x-navbar-teacher>

    <div class="container px-4">
        <h1>Tambah presensi</h1>

        <div>
            @forelse ($students as $student)
                <div
                    class="block max-w-sm px-4 py-4 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 w-full mb-3 sm:py-2 sm:h-[80px]">
                    <div class="flex justify-between sm:h-full">
                        <p class="font-semibold text-simipa-1 sm:self-start">{{ $student->name }} </p>
                        <select class="form-control status p-2 rounded-lg border" data-id="">
                            <option value="Hadir">Hadir</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                    </div>
                </div>
            @empty
                <h1>Data kosong</h1>
            @endforelse
        </div>
    </div>
</x-layout>
