<x-layout title="Pembayaran | Tambah">
    <x-navbar-teacher>

    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px]">
        @if (session('success'))
            <div class=" text-green-700 p-4 rounded mb-4 text-center">
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


        <div class="flex flex-col items-center mb-4 border-b-2 text-simipa-2">
            <h1 class="judul">Pembayaran {{ $paymentType->name }} {{ $group->name }}
            </h1>
            <p class="tanggal">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }} </p>
        </div>

        <div class="max-h-[60vh] overflow-y-auto sm:flex sm:flex-col sm:items-center">
            @forelse ($students as $student)
                <div
                    class="block px-4 py-4 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 w-full mb-3 sm:py-2 sm:h-[70px] ">
                    <div class="data-presensi hidden">{{ $student['id'] }}</div>
                    <div class="flex justify-between sm:h-full">
                        <p class="font-semibold text-simipa-1 sm:self-start">{{ $student['name'] }} </p>
                        <div class="flex items-center">
                            <button type="button" onclick="amountCreatePayment({{ $student['id'] }})"
                                class="bg-simipa-3 text-white px-4 py-1 rounded-lg hover:bg-simipa-2 sm:px-8 sm:py-2">
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>
                <x-teacher-modal-create-payment :student="$student" :paymentType="$paymentType"
                    :date="$date"></x-teacher-modal-create-payment>
            @empty
                <h1>Data kosong</h1>
            @endforelse
        </div>


    </div>



    <script>
        function amountCreatePayment(id) {
            document.getElementById('amountCreatePayment' + id).classList.toggle('hidden')
        }
    </script>



</x-layout>
