<x-layout title="Presensi | Siswa">
    <x-navbar-teacher>

    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px]">
        <div class="flex flex-col items-center mb-4 border-b-2 text-simipa-2">
            <h1 class="judul">Tambah presensi {{ $group[0]->name }} <span class="hidden">{{ $group[0]->id }}</span>
            </h1>
            <p class="tanggal">{{ \Carbon\Carbon::parse($day)->format('d-m-Y') }} <span
                    class="hidden">{{ $day }}</span></p>
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
        document.querySelector('.submit-attendance-btn').addEventListener('click', function() {
            const presensiData = [];

            const activityId = document.querySelector('.kegiatan').querySelector('span').textContent
            const groupId = document.querySelector('.judul').querySelector('span').textContent
            const day = document.querySelector('.tanggal').querySelector('span').textContent

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
                    console.log(data)
                    // location.reload(); // Muat ulang halaman jika diperlukan
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data presensi.');
                });
        });
    </script>
</x-layout>
