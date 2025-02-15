<x-layout title="Lihat Tagihan">
    <x-navbar-teacher>
    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px] ">
        @if ($errors->any())
            <div id="error-any" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <div class="flex justify-between">
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="btn-error-any p-3" onclick="closeErrorBtn('error-any')">&#10006</button>
                </div>
            </div>
        @endif

        <div class="p-2 py-10 border rounded-md shadow-sm sm:p-10 sm:w-2/3 sm:mx-auto">
            <h1 class="font-bold text-center text-simipa-1 mb-5 sm:text-xl">Lihat Tagihan</h1>
            <form action="/teacher/payment/fee" method="GET">

                <div class="mb-3">
                    <label for="name" class="block font-semibold mb-3">Rombongan Belajar</label>
                    <select name="group_id" id="groupSelect" class="border w-full rounded-lg px-2 py-1.5" required>
                        @foreach ($groups as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="flex justify-end mt-10">
                    <button type="button" onclick="batal()"
                        class="px-4 py-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-1 bg-simipa-2 text-white rounded hover:bg-gray-400 mr-2">Lihat</button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function closeErrorBtn(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function batal() {
            window.location.href = '/teacher/dashboard';
        }
    </script>
</x-layout>
