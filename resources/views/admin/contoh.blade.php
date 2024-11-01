<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Container -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-gray-100 flex-shrink-0">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-white">Admin Dashboard</h2>
                <p class="mt-2 text-gray-400">Welcome, {{ session('user.username') }}</p>
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="block py-2.5 px-4 rounded hover:bg-gray-700">Dashboard</a>
                <a href="/profile" class="block py-2.5 px-4 rounded hover:bg-gray-700">Profile</a>
                <a href="/manage-users" class="block py-2.5 px-4 rounded hover:bg-gray-700">Manage Users</a>
                <a href="/reports" class="block py-2.5 px-4 rounded hover:bg-gray-700">Reports</a>
                <a href="/settings" class="block py-2.5 px-4 rounded hover:bg-gray-700">Settings</a>
                <a href="/logout" class="block py-2.5 px-4 rounded hover:bg-gray-700">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-white p-8">
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
        </main>

    </div>

</body>

</html>
