<x-layout>
    <x-slot:title>Guru | Admin</x-slot:title>
    <x-navbar-admin>
        <!-- Header -->
        <header class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold">Data Guru</h1>
        </header>
        <hr class="my-4">

        <div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right  rounded-">
                    <thead class="text-xs text-simipa-1 uppercase bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jenis Kelamin
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Akses
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-simipa-6 border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                Apple MacBook Pro 17"
                            </th>
                            <td class="px-6 py-4">
                                Silver
                            </td>
                            <td class="px-6 py-4">
                                Laptop
                            </td>
                            <td class="px-6 py-4">
                                $2999
                            </td>
                        </tr>
                        <tr class="bg-simipa-6 border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                Apple MacBook Pro 17"
                            </th>
                            <td class="px-6 py-4">
                                Silver
                            </td>
                            <td class="px-6 py-4">
                                Laptop
                            </td>
                            <td class="px-6 py-4">
                                $2999
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </x-navbar-admin>


</x-layout>
