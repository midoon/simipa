<x-layout title="Presensi | Siswa">
    <x-navbar-teacher>

    </x-navbar-teacher>
    <div class="data-presensi hidden">
        <div class="rombel"><span>{{ $group[0]->id }}</span></div>
        <div class="tanggal"><span>{{ $day }}</span></div>
        <div class="kegiatan"><span>{{ $activity[0]->id }}</span></div>
    </div>

    <div class=" px-4 sm:mx-[250px]">
        <div class="flex flex-col items-center mb-4 border-b-2 text-simipa-2">
            <h1 class="judul">Tambah presensi {{ $activity[0]->name }} {{ $group[0]->name }}

            </h1>
            <p class="">{{ \Carbon\Carbon::parse($day)->format('d-m-Y') }}
        </div>

        <div class="flex justify-between items-center mb-4">
            <button type="button" onclick="cancelCreate()"
                class="cancel-attendance-btn px-6 py-1 bg-red-500 text-white rounded hover:bg-gray-400 mr-2">Batal</button>
            <button type="button"
                class="submit-attendance-btn px-4 py-1 bg-simipa-2 text-white rounded hover:bg-gray-400 mr-2">Simpan</button>
        </div>

        <div class="max-h-[60vh] overflow-y-auto sm:flex sm:flex-col sm:items-center">
            @forelse ($students as $student)
                <div
                    class="block px-4 py-4 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 w-full mb-3 sm:py-2 sm:h-[70px] ">
                    <div class="flex justify-between sm:h-full">
                        <p class="font-semibold text-simipa-1 sm:self-start">{{ $student->name }} </p>
                        <select class="form-control status p-2 rounded-lg border" data-id="{{ $student->id }}">
                            <option value="hadir">Hadir</option>
                            <option value="alpha">Alpha</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                        </select>
                    </div>
                </div>

            @empty
                <h1>Data kosong</h1>
            @endforelse
        </div>


    </div>


    <script>
        function cancelCreate() {
            window.location.href = '/teacher/dashboard';
        }

        document.querySelector('.submit-attendance-btn').addEventListener('click', function() {
            const presensiData = [];

            const activityId = document.querySelector('.data-presensi').querySelector('.kegiatan').querySelector(
                'span').textContent
            const groupId = document.querySelector('.data-presensi').querySelector('.rombel').querySelector(
                'span').textContent
            const day = document.querySelector('.data-presensi').querySelector('.tanggal').querySelector(
                'span').textContent

            // Kumpulkan semua data presensi
            document.querySelectorAll('.status').forEach(select => {
                const siswaId = select.getAttribute('data-id');
                const status = select.value;



                presensiData.push({
                    student_id: siswaId,
                    status: status,
                    activity_id: activityId,
                    group_id: groupId,
                    day: day
                });
            });





            // Kirim data ke controller
            fetch('/teacher/attendance/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        presensi: presensiData
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Tampilkan pesan sukses
                    // redirect ke halaman lihat presensi dengan filter tertentu
                    window.location.href = '/teacher/dashboard';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data presensi.');
                });
        });
    </script>
</x-layout>
