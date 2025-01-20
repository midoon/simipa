@props(['student', 'paymentType', 'date'])

<div id="amountCreatePayment{{ $student->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50  hidden z-50">

    <div class="h-full flex items-center justify-center">
        <div class="bg-white rounded-lg w-10/12 p-4 sm:w-1/3 sm:py-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Bayar: {{ $student->name }}</h2>

            <!-- Formulir Tambah Data -->
            <form action="/teacher/payment/create" method="POST">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="amount">Nominal Tagihan</label>
                    <input type="number" name="amount" id="amount" class="border px-2 py-2 w-full">
                </div>
                <div class="mb-3">
                    <label for="description">Catatan</label>
                    <textarea name="description" id="description" class="border px-2 py-2 w-full">{{ $paymentType->name }}</textarea>
                </div>
                <input type="text" name="student_id" id="student_id" class="hidden" value="{{ $student->id }}">
                <input type="text" name="payment_type_id" id="payment_type_id" class="hidden"
                    value="{{ $paymentType->id }}">
                <input type="date" name="date" id="date" class="hidden" value="{{ $date }}">


                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" onclick="amountCreatePayment({{ $student->id }})"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-simipa-1 text-white rounded hover:bg-simipa-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
