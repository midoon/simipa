<x-layout>
    <x-slot:title>Dashboard | Admin</x-slot:title>
    <x-navbar-admin>
        <!-- Header -->
        <header class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold">Dashboard</h1>
        </header>
        <hr class="my-4">

        <!-- Dashboard Content -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-6 bg-gray-100 rounded-lg shadow">
                <h3 class="text-xl font-semibold">Statistics</h3>
                <p class="mt-2 text-gray-600">Show your stats here</p>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow">
                <h3 class="text-xl font-semibold">New Users</h3>
                <p class="mt-2 text-gray-600">Show new user count here</p>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow">
                <h3 class="text-xl font-semibold">Revenue</h3>
                <p class="mt-2 text-gray-600">Display revenue summary</p>
            </div>
        </section>

        <!-- Additional Content -->
        <section class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Recent Activities</h2>
            <div class="bg-gray-100 rounded-lg p-6 shadow">
                <p class="text-gray-700">Activity log content goes here.</p>
            </div>
        </section>
    </x-navbar-admin>
</x-layout>
