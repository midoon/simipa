<x-layout title="Filter Pembayaran">
    <x-navbar-teacher>
    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px] ">

        <div class="p-2 border rounded-md shadow-sm sm:p-6">
            <h1 class="font-bold text-center mb-5">Tambah Pembayaran</h1>
            <form action="/teacher/payment/create" method="GET">

                <div class="mb-3">
                    <label for="name" class="block font-semibold mb-1">Rombongan Belajar</label>
                    <select name="group_id" id="groupSelect" class="border w-full rounded-lg px-2 py-1.5" required>
                        @foreach ($groups as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="mb-3">
                    <label for="payment_type" class="block font-semibold mb-1">Jenis Pembayaran</label>
                    <select name="payment_type_id" id="payment_type" class="border w-full rounded-lg px-2 py-1.5"
                        required>
                        @foreach ($paymentTypes as $ptt)
                            <option value="{{ $ptt->id }}">{{ $ptt->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-10">
                    <label for="date" class="block font-semibold mb-1">Tanggal</label>
                    <input type="date" id="date" name="date" class="w-full px-2 py-2 border rounded-lg">
                </div>
                <div class="flex justify-end mt-3">
                    <button type="button" onclick="batal()"
                        class="px-4 py-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-1 bg-simipa-2 text-white rounded hover:bg-gray-400 mr-2">Tambah</button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function batal() {
            window.location.href = '/teacher/dashboard';
        }
    </script>
</x-layout>
