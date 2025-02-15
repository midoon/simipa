<x-layout title="Lihat | Tagihan">

    <x-navbar-teacher>

    </x-navbar-teacher>

    <div class=" px-4 sm:mx-[250px]">


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


        <div class="flex flex-col items-center mb-4 border-b-2 text-simipa-2">
            <h1 class="judul sm:mb-6"> Daftar Tagihan kelas : {{ $groupName }}
            </h1>
        </div>

        <div class="max-h-[60vh] overflow-y-auto sm:flex sm:flex-col sm:items-center">

            @forelse ($studentFee as $sf)
                <div
                    class="block px-4 py-4 text-simipa-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 w-full mb-3 sm:py-2 sm:h-[70px] ">

                    <div class="flex justify-between sm:h-full">
                        <p class="font-semibold text-simipa-1 sm:self-start">{{ $sf['name'] }}</p>
                        <div class="flex items-center">
                            <button type="button" onclick="detailFee({{ $sf['studentId'] }})"
                                class="bg-simipa-2 text-white py-2 px-4 rounded-lg sm:px-8 sm:py-2">Detail</button>
                        </div>
                    </div>
                </div>
                <x-teacher-modal-fee-detail :studentId="$sf['studentId']" :fees="$sf['fees']"></x-teacher-modal-fee-detail>
            @empty
                <h1>Data kosong</h1>
            @endforelse
        </div>


    </div>

    <script>
        function closeErrorBtn(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function detailFee(studentId) {
            document.getElementById('detailFee' + studentId).classList.toggle('hidden');
        }
    </script>

</x-layout>
