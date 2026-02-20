@section('title', 'Settings - Qatar National Library')
<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 px-4 sm:px-0">{{ __('app.settings') }}</h1>
            
                <!-- Content -->
                <div class="flex-1 px-4 sm:px-0">
                    <div class="space-y-12 divide-y divide-gray-200">
                        
                        <!-- General / Lending Periods -->
                        <section>
                            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">{{ __('app.general') }}</h2>
                            
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('app.lending_periods') }}</h3>
                                <p class="text-sm text-gray-500 mb-6">{{ __('app.lending_periods_desc') }}</p>
                                
                                <div class="space-y-4">
                                    <!-- Ebook -->
                                    <div class="flex items-center justify-between max-w-md">
                                        <span class="text-sm font-medium text-gray-700">{{ __('app.ebook') }}</span>
                                        <div class="flex border border-gray-300 rounded-md overflow-hidden lending-period-group" data-format="ebook">
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50 border-r">7 days</button>
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50 border-r">14 days</button>
                                            <button class="px-4 py-2 text-sm text-white bg-gray-800">21 days</button>
                                        </div>
                                    </div>
                                    
                                    <!-- Audiobook -->
                                    <div class="flex items-center justify-between max-w-md">
                                        <span class="text-sm font-medium text-gray-700">{{ __('app.audiobook') }}</span>
                                        <div class="flex border border-gray-300 rounded-md overflow-hidden lending-period-group" data-format="audiobook">
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50 border-r">7 days</button>
                                            <button class="px-4 py-2 text-sm text-white bg-gray-800 border-r">14 days</button>
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50">21 days</button>
                                        </div>
                                    </div>
                                    
                                     <!-- Magazine -->
                                    <div class="flex items-center justify-between max-w-md">
                                        <span class="text-sm font-medium text-gray-700">{{ __('app.magazine') }}</span>
                                        <div class="flex border border-gray-300 rounded-md overflow-hidden lending-period-group" data-format="magazine">
                                            <button class="px-4 py-2 text-sm text-white bg-gray-800 border-r">7 days</button>
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50 border-r">14 days</button>
                                            <button class="px-4 py-2 text-sm text-gray-700 bg-white hover:bg-gray-50">21 days</button>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-4 text-xs text-gray-500">{{ __('app.lending_note') }}</p>
                                
                                <hr class="my-6 border-gray-100">

                                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('app.history') }}</h3>
                                <p id="historyStatus" class="text-sm text-gray-500 mb-4">Displaying your history from January 6, 2026. <a href="#" class="underline">Learn more about the history feature.</a></p>
                                <button id="historyToggleBtn" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    {{ __('app.hide_history') }}
                                </button>
                            </div>
                        </section>

                        <!-- Content Preferences -->
                          <section class="pt-12">
                            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">{{ __('app.content_preferences') }}</h2>
                             <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('app.audiences') }}</h3>
                                <p class="text-sm text-gray-500 mb-4">{{ __('app.audiences_desc') }}</p>
                                <div class="flex flex-wrap gap-2">
                                    <button class="px-4 py-2 rounded-md text-sm font-medium text-white bg-gray-600">{{ __('app.all_audiences') }}</button>
                                    <button class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">{{ __('app.juvenile') }}</button>
                                    <button class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">{{ __('app.young_adult') }}</button>
                                     <button class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">{{ __('app.general_adult') }}</button>
                                      <button class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">{{ __('app.mature_adult') }}</button>
                                </div>
                             </div>
                        </section>

                         <!-- Display Options -->
                        <section class="pt-12">
                            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">{{ __('app.display_options') }}</h2>
                             <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="dyslexic_font" name="dyslexic_font" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="dyslexic_font" class="font-medium text-gray-900">{{ __('app.dyslexic_font') }}</label>
                                        <p class="text-gray-500">{{ __('app.dyslexic_font_desc') }}</p>
                                    </div>
                                </div>
                             </div>
                        </section>

                        <!-- Profile Management -->
                        <section class="pt-12">
                            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">{{ __('app.account_info') }}</h2>
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
                                     {{ __('app.save_changes') }}
                                 </button>
                             </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lendingPeriodGroups = document.querySelectorAll('.lending-period-group');
            
            lendingPeriodGroups.forEach(group => {
                const buttons = group.querySelectorAll('button');
                buttons.forEach(button => {
                    button.addEventListener('click', function() {
                        buttons.forEach(btn => {
                            btn.classList.remove('bg-gray-800', 'text-white');
                            btn.classList.add('bg-white', 'text-gray-700');
                        });
                        this.classList.remove('bg-white', 'text-gray-700');
                        this.classList.add('bg-gray-800', 'text-white');
                        const format = group.dataset.format;
                        const days = this.textContent.trim();
                        console.log(`Set ${format} to ${days}`);
                    });
                });
            });
            
            const historyBtn = document.getElementById('historyToggleBtn');
            const historyStatus = document.getElementById('historyStatus');
            let historyEnabled = true;
            
            historyBtn.addEventListener('click', function() {
                historyEnabled = !historyEnabled;
                if (historyEnabled) {
                    this.textContent = '{{ __("app.hide_history") }}';
                    historyStatus.textContent = `Displaying your history from ${new Date().toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}.`;
                } else {
                    this.textContent = '{{ __("app.show_history") }}';
                    historyStatus.textContent = 'History is currently hidden.';
                }
            });
        });
    </script>
</x-app-layout>
