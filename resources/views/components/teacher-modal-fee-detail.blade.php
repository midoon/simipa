@props(['fees', 'studentId'])

<div id="detailFee{{ $studentId }}" class="fixed inset-0 bg-gray-900 bg-opacity-50  hidden z-50">

    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-10/12 p-4 sm:w-1/3 sm:py-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-5">Daftar Tagihan </h2>

            <div class="mb-5 max-h-[60vh] overflow-y-auto">
                @foreach ($fees as $f)
                    <div
                        class="block p-2 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 mb-2 ">
                        <div class="flex justify-between">
                            <h5 class="mb-2 text-md font-bold tracking-tight text-simipa-1">
                                {{ $f['fee'] }}
                            </h5>

                            <p class="text-xs"> Nominal: Rp. {{ $f['amount'] }} </p>
                        </div>
                        <div class="flex justify-between">
                            <div class="flex gap-1">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                                </svg>
                                {{ $f['dueDate'] }}
                            </div>

                            <p class="text-xs">Sisa: Rp. {{ $f['remainingAmount'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Formulir Tambah Data -->


            <div class="flex justify-end">
                <button type="button" onclick="detailFee({{ $studentId }})"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
            </div>
        </div>
    </div>

</div>
