<x-layout title="Presensi | Lihat">
    <x-navbar-teacher>

    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px]">

        @if (session('error'))
            <div class=" text-red-700 p-4 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="flex flex-col items-center mb-4 border-b-2 text-simipa-2">
            <h1 class="judul">Presensi {{ $group[0]->name }} {{ $activity[0]->name }}
            </h1>
            <p class="tanggal">{{ \Carbon\Carbon::parse($day)->format('d-m-Y') }} </p>
        </div>

        <div class="flex justify-between mb-4">
            <button type="button" class="btn-edit py-2 px-4 rounded-md bg-yellow-500 text-white"
                onclick="return confirmEdit()">Edit</button>
            <button type="button" class="btn-delete py-2 px-4 rounded-md bg-red-500 text-white">Hapus</button>
        </div>

        <div class="max-h-[60vh] overflow-y-auto sm:flex sm:flex-col sm:items-center">
            @forelse ($attendances as $attendance)
                <div
                    class="block px-4 py-4 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 w-full mb-3 sm:py-2 sm:h-[70px] ">
                    <div class="data-presensi hidden">{{ $attendance->id }}</div>
                    <div class="flex justify-between sm:h-full">
                        <p class="font-semibold text-simipa-1 sm:self-start">{{ $attendance->student->name }} </p>
                        <select class="form-control status p-2 rounded-lg border" data-id="{{ $attendance->id }}">
                            <option @if ($attendance->status == 'hadir') selected @endif value="hadir">Hadir</option>
                            <option @if ($attendance->status == 'alpha') selected @endif value="alpha">Alpha</option>
                            <option @if ($attendance->status == 'izin') selected @endif value="izin">Izin</option>
                            <option @if ($attendance->status == 'sakit') selected @endif value="sakit">Sakit</option>
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

        function confirmEdit() {
            return confirm("Apakah Anda yakin ingin mengubahnya?");
        }

        document.querySelector('.btn-edit').addEventListener('click', function() {
            const presensiData = [];
            rows = document.querySelectorAll('.status');
            if (rows.length == 0) {
                alert('Data presensi kosong');
                return;
            }

            // Kumpulkan semua data presensi
            document.querySelectorAll('.status').forEach(select => {
                const attendanceId = select.getAttribute('data-id');
                const status = select.value;

                presensiData.push({
                    attendance_id: attendanceId,
                    status: status,
                });
            });


            // Kirim data ke controller
            fetch('/teacher/attendance/update', {
                    method: 'PUT',
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
                    // console.log(data);
                    // redirect ke halaman lihat presensi dengan filter tertentu
                    // window.location.href = '/teacher/dashboard';

                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data presensi.');
                });
        });

        document.querySelector('.btn-delete').addEventListener('click', function() {
            const presensiData = [];
            rows = document.querySelectorAll('.status');
            if (rows.length == 0) {
                alert('Data presensi kosong');
                return;
            }

            // Kumpulkan semua data presensi
            document.querySelectorAll('.status').forEach(select => {
                const attendanceId = select.getAttribute('data-id');
                presensiData.push({
                    attendance_id: attendanceId,
                });
            });

            fetch('/teacher/attendance/delete', {
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
                    // console.log(data);
                    // redirect ke halaman lihat presensi dengan filter tertentu
                    window.location.href = '/teacher/dashboard';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data presensi.');
                });
        })
    </script>



</x-layout>
