<html>
<head>
    @livewireStyles
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-indigo-900 text-white hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-indigo-800">
                BrandName
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="block py-2.5 px-4 rounded bg-indigo-800 transition">Dashboard</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-indigo-800 transition">Users</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-indigo-800 transition">Analytics</a>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-indigo-800 transition">Settings</a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-8">
                <h1 class="text-xl font-semibold text-gray-800">Overview</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 text-sm">Welcome, User!</span>
                    <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white">
                        U
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500 uppercase font-bold">Total Revenue</p>
                        <p class="text-3xl font-bold text-gray-800">$24,500</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500 uppercase font-bold">Active Users</p>
                        <p class="text-3xl font-bold text-gray-800">1,240</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500 uppercase font-bold">New Signups</p>
                        <p class="text-3xl font-bold text-gray-800">42</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 min-h-[400px]">
                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Recent Activity</h2>
                    <p class="text-gray-500">This is where your Livewire components will go.</p>
                    
                    </div>

            </main>
        </div>
        

</body>
    @livewireScripts
</html>