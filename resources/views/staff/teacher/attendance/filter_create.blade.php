<x-layout title="Filter Presensi">
    <x-navbar-teacher>
    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px]">

        <div class="p-2 border rounded-md shadow-sm">
            <h1 class="font-bold text-center mb-5">Tambah Presensi</h1>
            <form action="/teacher/attendance/create" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="block font-semibold mb-1">Rombongan Belajar</label>
                    <select name="group_id" id="groupSelect" class="border w-full rounded-lg px-2 py-1.5" required>
                        @foreach ($groups as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="mb-3">
                    <label for="activity" class="block font-semibold mb-1">Jenis Presensi</label>
                    <select name="activity_id" id="activity" class="border w-full rounded-lg px-2 py-1.5" required>
                        @foreach ($activities as $act)
                            <option value="{{ $act->id }}">{{ $act->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-10">
                    <label for="day" class="block font-semibold mb-1">Tanggal</label>
                    <input type="date" id="day" name="day" class="w-full px-2 py-2 border rounded-lg">
                </div>
                <div class="flex justify-end mt-3">
                    <button type="button" onclick="batal()"
                        class="px-4 py-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-1 bg-simipa-2 text-white rounded hover:bg-gray-400 mr-2">Tambah</button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function batal() {
            window.location.href = '/teacher/dashboard';
        }
    </script>
</x-layout>
