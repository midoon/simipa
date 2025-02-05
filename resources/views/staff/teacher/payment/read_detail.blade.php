<x-layout title="Detail | Pembayaran">
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

                        <div class="flex justify-between item sm:h-full items-center">

                            <div class="flex gap-2 ">
                                <p class="font-semibold text-simipa-1 sm:self-start">{{ $p->payment_date }} : </p>
                                <p>Rp. {{ $p->amount }}</p>
                            </div>
                            <div class="flex gap-2">
                                <button type="button" class="bg-yellow-500 py-2 px-4 rounded-md"
                                    onclick="editPayment({{ $p->id }})">
                                    <svg class="w-6 h-6 text-white hover:text-simipa-2 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>
                                </button>
                                <form action="/teacher/payment/delete" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="text" name="payment_id" id="payment_id" class="hidden"
                                        value="{{ $p->id }}">
                                    <button type="submit" class="bg-red-500 py-2 px-4 rounded-md"
                                        onclick="return confirmDeletePayment()">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <x-teacher-modal-edit-payment :payment="$p"></x-teacher-modal-edit-payment>
            @empty
                <h1>Belum Melakukan Pembayaran</h1>
            @endforelse
        </div>



        <script>
            function confirmDeletePayment() {
                return confirm("Apakah Anda yakin ingin menghapusnya?");
            }

            function editPayment(id) {
                document.getElementById('editPayment' + id).classList.toggle('hidden')
            }
        </script>
    </div>
</x-layout>
