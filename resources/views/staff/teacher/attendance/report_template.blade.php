<x-layout title="Presensi | Lihat">

    <div class="flex flex-col items-center p-10">
        <h1 class="font-bold text-2xl ">REKAPITULASI KEHADIRAN SISWA</h1>
        <h1 class="font-bold text-2xl">MI PANCASILA MOJOSARI MOJOKERTO</h1>

        <div class="grid grid-cols-4 gap-4 mt-4 w-full mb-5">
            <div class=" col-span-3">
                <table>
                    <tr class="font-bold">
                        <td>Rombel</td>
                        <td> :</td>
                        <td>{{ $group }}</td>
                    </tr>

                    <tr class="font-bold">
                        <td>Activity</td>
                        <td> :</td>
                        <td>{{ $activity }}</td>
                    </tr>

                </table>
            </div>
            <div class="">
                <table>
                    <tr class="font-bold">
                        <td>Dari</td>
                        <td>:</td>
                        <td>{{ $start_date }}</td>
                    </tr>
                    <tr class="font-bold">
                        <td>Sampai</td>
                        <td>:</td>
                        <td>{{ $end_date }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="rounded-md w-full">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-white bg-simipa-2">
                    <tr>
                        <th class="border p-2">No</th>
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Hadir</th>
                        <th class="border p-2">Alpha</th>
                        <th class="border p-2">Izin</th>
                        <th class="border p-2">Sakit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportMap as $student_id => $data)
                        <tr class="bg-simipa-6 border">
                            <td class="px-2 py-1 border">{{ $loop->iteration }}</td>
                            <td class="px-2 py-1 border">{{ $data['name'] }}</td>
                            <td class="px-2 py-1 border">{{ $data['hadir'] }}</td>
                            <td class="px-2 py-1 border">{{ $data['sakit'] }}</td>
                            <td class="px-2 py-1 border">{{ $data['izin'] }}</td>
                            <td class="px-2 py-1 border">{{ $data['alpha'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>





</x-layout>
