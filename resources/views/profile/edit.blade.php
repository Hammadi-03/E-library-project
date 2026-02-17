@section('title', 'Settings - Qatar National Library')
<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 px-4 sm:px-0">Settings</h1>
            
                <!-- Content -->
                <div class="flex-1 px-4 sm:px-0">
                    <div class="space-y-12 divide-y divide-gray-200">
                        
                        <!-- General / Lending Periods -->
                        <section>
                            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">General</h2>
                            
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Lending periods</h3>
                                <p class="text-sm text-gray-500 mb-6">Set your default lending period for each format.</p>
                                
                                <div class="space-y-4">
                                    <!-- Ebook -->
                                    <div class="flex items-center justify-between max-w-md">
                                        <span class="text-sm font-medium text-gray-700">Ebook:</span>
                                        <div class="flex border border-gray-300 rounded-md overflow-hidden lending-period-group" data-format="ebook">
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50 border-r">7 days</button>
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50 border-r">14 days</button>
                                            <button class="px-4 py-2 text-sm text-white bg-gray-800">21 days</button>
                                        </div>
                                    </div>
                                    
                                    <!-- Audiobook -->
                                    <div class="flex items-center justify-between max-w-md">
                                        <span class="text-sm font-medium text-gray-700">Audiobook:</span>
                                        <div class="flex border border-gray-300 rounded-md overflow-hidden lending-period-group" data-format="audiobook">
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50 border-r">7 days</button>
                                            <button class="px-4 py-2 text-sm text-white bg-gray-800 border-r">14 days</button>
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50">21 days</button>
                                        </div>
                                    </div>
                                    
                                     <!-- Magazine -->
                                    <div class="flex items-center justify-between max-w-md">
                                        <span class="text-sm font-medium text-gray-700">Magazine:</span>
                                        <div class="flex border border-gray-300 rounded-md overflow-hidden lending-period-group" data-format="magazine">
                                            <button class="px-4 py-2 text-sm text-white bg-gray-800 border-r">7 days</button>
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50 border-r">14 days</button>
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50">21 days</button>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-4 text-xs text-gray-500">Certain titles may have lending periods that can't be changed.</p>
                                
                                <hr class="my-6 border-gray-100">

                                <h3 class="text-lg font-medium text-gray-900 mb-2">History</h3>
                                <p id="historyStatus" class="text-sm text-gray-500 mb-4">Displaying your history from January 6, 2026. <a href="#" class="underline">Learn more about the history feature.</a></p>
                                <button id="historyToggleBtn" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Hide History
                                </button>
                            </div>
                        </section>

                        <!-- Content Preferences -->
                          <section class="pt-12">
                            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">Content Preferences</h2>
                             <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Audience(s)</h3>
                                <p class="text-sm text-gray-500 mb-4">Choose the types of content you'd like to see while browsing and searching the collection.</p>
                                <div class="flex flex-wrap gap-2">
                                    <button class="px-4 py-2 rounded-md text-sm font-medium text-white bg-gray-600">All audiences</button>
                                    <button class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">Juvenile</button>
                                    <button class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">Young adult</button>
                                     <button class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">General adult</button>
                                      <button class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">Mature adult</button>
                                </div>
                             </div>
                        </section>

                         <!-- Display Options -->
                        <section class="pt-12">
                            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">Display Options</h2>
                             <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="dyslexic_font" name="dyslexic_font" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="dyslexic_font" class="font-medium text-gray-900">Dyslexic font</label>
                                        <p class="text-gray-500">Turn on dyslexic font for this website.</p>
                                    </div>
                                </div>
                             </div>
                        </section>

                        <!-- Profile Management (Kept from original but styled down) -->
                        <section class="pt-12">
                            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">Account Information</h2>
                             <div class="bg-white border border-gray-200 rounded-lg divide-y divide-gray-200">
                                <div class="p-6">
                                     @include('profile.partials.update-profile-information-form')
                                </div>
                                <div class="p-6">
                                     @include('profile.partials.update-password-form')
                                </div>
                                <div class="p-6">
                                     @include('profile.partials.delete-user-form')
                                </div>
                             </div>
                             
                             <div class="mt-8">
                                 <button class="px-6 py-3 bg-black text-white text-sm font-bold rounded shadow-sm hover:bg-gray-800">
                                     Save changes
                                 </button>
                             </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Lending periods functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Handle lending period buttons
            const lendingPeriodGroups = document.querySelectorAll('.lending-period-group');
            
            lendingPeriodGroups.forEach(group => {
                const buttons = group.querySelectorAll('button');
                buttons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove active class from all buttons in this group
                        buttons.forEach(btn => {
                            btn.classList.remove('bg-gray-800', 'text-white');
                            btn.classList.add('bg-white', 'text-gray-700');
                        });
                        
                        // Add active class to clicked button
                        this.classList.remove('bg-white', 'text-gray-700');
                        this.classList.add('bg-gray-800', 'text-white');
                        
                        // Store preference (you can add API call here)
                        const format = group.dataset.format;
                        const days = this.textContent.trim();
                        console.log(`Set ${format} to ${days}`);
                        
                        // You can add an API call here to save the preference
                        // Example: 
                        // fetch('/api/user/lending-preferences', {
                        //     method: 'POST',
                        //     headers: { 'Content-Type': 'application/json' },
                        //     body: JSON.stringify({ format, days })
                        // });
                    });
                });
            });
            
            // History toggle functionality
            const historyBtn = document.getElementById('historyToggleBtn');
            const historyStatus = document.getElementById('historyStatus');
            let historyEnabled = true;
            
            historyBtn.addEventListener('click', function() {
                historyEnabled = !historyEnabled;
                
                if (historyEnabled) {
                    this.textContent = 'Hide History';
                    historyStatus.textContent = `Displaying your history from ${new Date().toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}.`;
                } else {
                    this.textContent = 'Show History';
                    historyStatus.textContent = 'History is currently hidden.';
                }
                
                // You can add an API call here to save the preference
                console.log('History enabled:', historyEnabled);
            });
        });
    </script>
</x-app-layout>
