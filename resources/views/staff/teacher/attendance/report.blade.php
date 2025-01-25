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



        <div class="flex justify-between items-center mb-5">
            <h1 class="font-bold text-2xl text-simipa-1">Rekapitulasi Presensi</h1>
            <a href="/teacher/attendance/report/generate?group_id={{ $group_id }}&activity_id={{ $activity_id }}&start_date={{ $start_date }}&end_date={{ $end_date }}&export=pdf"
                class="py-2 px-4 bg-simipa-1 text-white rounded-lg download-btn">Download</a>
        </div>



        <div class="border w-full mb-5 grid grid-cols-2 p-2">
            <div>
                <table>
                    <tr class="">
                        <td>Rombel</td>
                        <td> :</td>
                        <td>{{ $group }}</td>
                    </tr>

                    <tr class="">
                        <td>Activity</td>
                        <td> :</td>
                        <td>{{ $activity }}</td>
                    </tr>

                </table>
            </div>
            <div>
                <table>
                    <tr class="">
                        <td>Tanggal Awal</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }}</td>
                    </tr>
                    <tr class="">
                        <td>Tanggal Akhir</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- table --}}
        <div class="relative overflow-x-auto rounded-md ">
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
