@props(['groups', 'activities'])

<div id="readAttendance" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-10/12 p-4 sm:w-1/2 sm:py-10">
            <h1 class="font-bold text-center mb-5">Lihat Presensi</h1>
            <form action="/teacher/attendance/read" method="POST">
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
                    <button type="button" onclick="closeReadAttendance()"
                        class="px-4 py-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Tutup</button>
                    <button type="submit"
                        class="px-4 py-1 bg-simipa-2 text-white rounded hover:bg-gray-400 mr-2">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>
