<x-layout title="Rekap | Pembayaran">
    <x-navbar-teacher>

    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px]">

        @if (session('success'))
            <div class=" bg-green-700 p-4 rounded mb-4 text-center text-white">
                {{ session('success') }}
            </div>
        @endif

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
            <h1 class="font-bold text-xl text-simipa-1 sm:text-2xl">Rekapitulasi Pembayaran</h1>
            <a href="/teacher/payment/report/generate?group_id={{ $groupId }}&payment_type_id={{ $paymentTypeId }}&export=pdf"
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
                        <td>Jenis</td>
                        <td> :</td>
                        <td>{{ $paymentType }}</td>
                    </tr>

                </table>
            </div>
            <div>
                <table>
                    <tr class="">
                        <td>Tagihan per Kelas</td>
                        <td> :</td>
                        <td>{{ $totalAmount }}</td>
                    </tr>

                    <tr class="">
                        <td>Terbayar per Kelas</td>
                        <td> :</td>
                        <td>{{ $totalPaidFeeAmount }}</td>
                    </tr>

                </table>
            </div>
        </div>


        <div class="relative overflow-x-auto rounded-md ">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-white bg-simipa-2">
                    <tr>
                        <th class="border p-2">No</th>
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Tagihan</th>
                        <th class="border p-2">Status</th>

                </thead>
                <tbody>
                    @foreach ($studentData as $sd)
                        <tr class="bg-simipa-6 border">
                            <td class="px-2 py-1 border">{{ $loop->iteration }}</td>
                            <td class="px-2 py-1 border">{{ $sd['name'] }}</td>
                            <td class="px-2 py-1 border">{{ $sd['remainingAmount'] }}</td>
                            <td class="px-2 py-1 border">{{ $sd['status'] }}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-layout>
