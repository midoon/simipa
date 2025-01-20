<x-layout title="Detail | Pembayaran">
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

        {{-- content --}}
        <div class="flex flex-col items-center mb-4 border-b-2 text-simipa-2">
            <h1 class="judul sm:mb-6"> Detail Pembayaran {{ $paymentType->name }} {{ $student->name }}
            </h1>
            <h1 class="mb-4">Sisa tagihan {{ $paymentType->name }} : Rp. {{ $remainingAmount }}</h1>
        </div>

        <div>
            @forelse ($payments as $p)
                <div>
                    <div
                        class="block px-4 py-4 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 w-full mb-3 sm:py-2 sm:h-[70px] ">

                        <div class="flex justify-between sm:h-full">
                            <p class="font-semibold text-simipa-1 sm:self-start">{{ $p->payment_date }} </p>
                            <p>Rp. {{ $p->amount }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <h1>Belum Melakukan Pembayaran</h1>
            @endforelse
        </div>
</x-layout>
