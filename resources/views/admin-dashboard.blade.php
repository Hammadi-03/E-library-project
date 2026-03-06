<div class="bg-[#f8f9fa] min-h-screen py-8 px-4 sm:px-6 lg:px-8 font-sans">
        
        {{-- Header Area: Dashboard Title & Buttons --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 max-w-7xl mx-auto">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ __('app.dashboard') }}</h1>
                <p class="text-gray-500 text-sm mt-1">{{ __('app.manage_desc') }}</p>
            </div>
            <div class="flex gap-3 mt-4 md:mt-0">
                <a href="{{ route('books') }}" class="inline-flex items-center gap-2 bg-[#1b5b3e] text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-[#13442e] transition shadow-sm">
                    <i class="fa-solid fa-plus"></i> {{ __('app.add_new_book') }}
                </a>
                <a href="{{ route('loans') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-gray-50 transition shadow-sm">
                    {{ __('app.import_data') }}
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto space-y-6">

            {{-- 1. TOP CARDS ROW (4 cols) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Card 1: Total Books (Dark Green) --}}
                <div class="bg-[#1b5b3e] rounded-[24px] p-6 text-white relative shadow-sm flex flex-col justify-between min-h-[160px]">
                    <div>
                        <div class="text-white/90 font-medium text-sm mb-1">{{ __('app.total_books') }}</div>
                        <div class="text-[2.5rem] leading-none font-bold mt-2">{{ $stats['total_books'] }}</div>
                    </div>
                    <div class="absolute top-6 right-6 bg-white w-8 h-8 rounded-full flex items-center justify-center text-[#1b5b3e] shadow-sm">
                        <i class="fa-solid fa-arrow-up-right text-sm"></i>
                    </div>
                    <div class="mt-8 flex items-center gap-2 text-[11px] text-white bg-white/10 w-fit px-3 py-1 rounded-md font-medium">
                        <i class="fa-solid fa-book text-[10px]"></i> {{ __('app.available_in_library') }}
                    </div>
                </div>

                {{-- Card 2: Total Peminjaman (Yellow) --}}
                <div class="bg-yellow-500 rounded-[24px] p-6 text-white relative shadow-sm flex flex-col justify-between min-h-[160px]">
                    <div>
                        <div class="text-white/90 font-semibold text-sm mb-1">{{ __('app.total_loans') }}</div>
                        <div class="text-[2.5rem] leading-none font-bold mt-2">{{ $stats['total_loans'] }}</div>
                    </div>
                    <div class="absolute top-6 right-6 border border-white/20 bg-white/10 w-8 h-8 rounded-full flex items-center justify-center text-white">
                        <i class="fa-solid fa-arrow-up-right text-sm"></i>
                    </div>
                    <div class="mt-8 flex items-center gap-2 text-[11px] text-white bg-white/20 w-fit px-3 py-1 rounded-md font-medium">
                        <i class="fa-solid fa-clipboard-list text-[10px]"></i> {{ __('app.all_transactions_recorded') }}
                    </div>
                </div>

                {{-- Card 3: Sedang Dipinjam (Blue) --}}
                <div class="bg-blue-600 rounded-[24px] p-6 text-white relative shadow-sm flex flex-col justify-between min-h-[160px]">
                    <div>
                        <div class="text-white/90 font-semibold text-sm mb-1">{{ __('app.active_loans') }}</div>
                        <div class="text-[2.5rem] leading-none font-bold mt-2">{{ $stats['active_loans'] }}</div>
                    </div>
                    <div class="absolute top-6 right-6 border border-white/20 bg-white/10 w-8 h-8 rounded-full flex items-center justify-center text-white">
                        <i class="fa-solid fa-arrow-up-right text-sm"></i>
                    </div>
                    <div class="mt-8 flex items-center gap-2 text-[11px] text-white bg-white/20 w-fit px-3 py-1 rounded-md font-medium">
                        <i class="fa-solid fa-book-reader text-[10px]"></i> {{ __('app.active_borrowing') }}
                    </div>
                </div>

                {{-- Card 4: Terlambat / Overdue (Red-900) --}}
                <div class="bg-red-900 rounded-[24px] p-6 text-white relative shadow-sm flex flex-col justify-between min-h-[160px]">
                    <div>
                        <div class="text-white/90 font-semibold text-sm mb-1">{{ __('app.overdue_books') }}</div>
                        <div class="text-[2.5rem] leading-none font-bold mt-2">{{ $stats['overdue_loans'] }}</div>
                    </div>
                    <div class="absolute top-6 right-6 border border-white/20 bg-white/10 w-8 h-8 rounded-full flex items-center justify-center text-white">
                        <i class="fa-solid fa-arrow-up-right text-sm"></i>
                    </div>
                    <div class="mt-8 flex items-center gap-2 text-[11px] text-white bg-white/10 w-fit px-3 py-1 rounded-md font-medium">
                        <i class="fa-solid fa-triangle-exclamation text-[10px]"></i> {{ __('app.take_action_soon') }}
                    </div>
                </div>

            </div>

            {{-- 2. MIDDLE ROW --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                
                {{-- Col 1 & 2: Analytics & Reminders --}}
                <div class="xl:col-span-2 space-y-6">
                    
                    {{-- Row Split: Analytics (2/3) + Reminders (1/3) --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        {{-- Analytics Chart Placeholder --}}
                        <div class="md:col-span-2 bg-white border border-gray-100 rounded-[24px] p-6 shadow-sm">
                            <h3 class="text-gray-900 font-bold mb-8 text-base tracking-tight">{{ __('app.loan_statistics') }}</h3>
                            
                            {{-- Fake Bar Chart using Flex --}}
                            <div class="flex items-end justify-between h-40 gap-2 px-1">
                                <div class="flex flex-col items-center w-full group">
                                    <div class="w-full relative h-[60%] flex flex-col justify-end">
                                        <div class="w-full bg-[repeating-linear-gradient(45deg,transparent,transparent_2px,#e5e7eb_2px,#e5e7eb_4px)] rounded-full h-full"></div>
                                    </div>
                                    <span class="text-xs text-gray-400 mt-4 font-medium">S</span>
                                </div>
                                <div class="flex flex-col items-center w-full group">
                                    <div class="w-full relative h-[70%] flex flex-col justify-end">
                                        <div class="w-full bg-[#1b5b3e] rounded-full h-full relative group-hover:bg-[#13442e] transition"></div>
                                    </div>
                                    <span class="text-xs text-gray-400 mt-4 font-medium">M</span>
                                </div>
                                <div class="flex flex-col items-center w-full group">
                                    <div class="w-full relative h-[65%] flex flex-col justify-end items-center">
                                        {{-- Tooltip pop --}}
                                        <div class="bg-white shadow-sm border border-gray-100 text-[10px] text-gray-600 font-bold rounded-full px-2 py-0.5 absolute -top-8 z-10 whitespace-nowrap">74%</div>
                                        <div class="w-full bg-[#52b788] rounded-full h-full relative group-hover:bg-[#40916c] transition"></div>
                                    </div>
                                    <span class="text-xs text-gray-900 mt-4 font-bold">T</span>
                                </div>
                                <div class="flex flex-col items-center w-full group">
                                    <div class="w-full relative h-[90%] flex flex-col justify-end">
                                        <div class="w-full bg-[#1b5b3e] rounded-full h-full group-hover:bg-[#13442e] transition"></div>
                                    </div>
                                    <span class="text-xs text-gray-400 mt-4 font-medium">W</span>
                                </div>
                                <div class="flex flex-col items-center w-full group">
                                    <div class="w-full relative h-[50%] flex flex-col justify-end">
                                        <div class="w-full bg-[repeating-linear-gradient(45deg,transparent,transparent_2px,#e5e7eb_2px,#e5e7eb_4px)] rounded-full h-full"></div>
                                    </div>
                                    <span class="text-xs text-gray-400 mt-4 font-medium">T</span>
                                </div>
                                <div class="flex flex-col items-center w-full group">
                                    <div class="w-full relative h-[45%] flex flex-col justify-end">
                                         <div class="w-full bg-[repeating-linear-gradient(45deg,transparent,transparent_2px,#e5e7eb_2px,#e5e7eb_4px)] rounded-full h-full"></div>
                                    </div>
                                    <span class="text-xs text-gray-400 mt-4 font-medium">F</span>
                                </div>
                                <div class="flex flex-col items-center w-full group">
                                    <div class="w-full relative h-[60%] flex flex-col justify-end">
                                         <div class="w-full bg-[repeating-linear-gradient(45deg,transparent,transparent_2px,#e5e7eb_2px,#e5e7eb_4px)] rounded-full h-full"></div>
                                    </div>
                                    <span class="text-xs text-gray-400 mt-4 font-medium">S</span>
                                </div>
                            </div>
                        </div>

                        {{-- Reminders Card --}}
                        <div class="bg-white border border-gray-100 rounded-[24px] p-6 shadow-sm flex flex-col justify-between">
                            <div>
                                <h3 class="text-gray-900 font-bold mb-4 tracking-tight">{{ __('app.oldest_overdue_book') }}</h3>
                                
                                @if($overdueLoans->count() > 0)
                                    <div class="text-[#1b5b3e] text-[20px] font-bold leading-tight mb-2 tracking-tight">
                                        {{ Str::limit($overdueLoans[0]->book->title, 40) }}
                                    </div>
                                    <div class="text-gray-500 text-xs mb-6 flex flex-col gap-1.5 font-medium">
                                        <span><i class="fa-regular fa-user mr-1"></i> {{ $overdueLoans[0]->user->name ?? 'User' }}</span>
                                        <span><i class="fa-regular fa-calendar-xmark mr-1"></i> {{ __('app.overdue_since') }} {{ $overdueLoans[0]->due_date->format('d M, Y') }}</span>
                                    </div>
                                @else
                                    <div class="text-[#1b5b3e] text-xl font-bold leading-tight mb-2">
                                        {{ __('app.no_overdue_books') }}
                                    </div>
                                    <div class="text-gray-500 text-sm mb-6 flex items-center gap-1">
                                        <i class="fa-regular fa-clock"></i> {{ now()->format('d M, Y H:i') }}
                                    </div>
                                @endif
                            </div>
                            
                            <a href="{{ route('loans', ['status' => 'overdue']) }}" class="w-full py-3.5 bg-[#1b5b3e] text-white text-center rounded-[14px] font-semibold hover:bg-[#13442e] transition text-sm flex justify-center items-center gap-2 shadow-sm">
                                <i class="fa-solid fa-list-check"></i> {{ __('app.manage_overdue') }}
                            </a>
                        </div>
                    </div>

                    {{-- BOTTOM ROW (Under Analytics) --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        {{-- Team Collaboration --}}
                        <div class="md:col-span-2 bg-white border border-gray-100 rounded-[24px] p-6 shadow-sm">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-gray-900 font-bold tracking-tight">{{ __('app.recent_users') }}</h3>
                                <a href="#" class="px-3.5 py-1.5 border border-gray-200 text-gray-600 rounded-full text-xs font-semibold hover:bg-gray-50 transition">
                                    <i class="fa-solid fa-plus mr-1"></i> {{ __('app.add_user') }}
                                </a>
                            </div>

                            <div class="space-y-4">
                                @forelse($recentUsers as $user)
                                <div class="flex items-center justify-between pb-4 @if(!$loop->last) border-b border-gray-100 @endif">
                                    <div class="flex items-center gap-3">
                                        {{-- Avatar Placeholder --}}
                                        <div class="w-10 h-10 rounded-full bg-[#f1edeb] flex items-center justify-center text-gray-500 font-bold overflow-hidden shadow-sm shrink-0">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="text-gray-900 font-semibold text-sm">{{ $user->name }}</div>
                                            <div class="text-gray-500 text-[11px] font-medium mt-0.5">{{ __('app.joined_on') }} <span class="text-gray-900">{{ $user->created_at->format('M d, Y') }}</span></div>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="px-2.5 py-1 bg-emerald-50 text-[#1b5b3e] rounded-[6px] text-[10px] font-bold tracking-wide">{{ __('app.registered') }}</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-gray-400 text-xs italic text-center py-4">{{ __('app.no_regular_users') }}</div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Project Progress (Donut Chart Idea) --}}
                        <div class="bg-white border border-gray-100 rounded-[24px] p-6 shadow-sm flex flex-col items-center">
                            <h3 class="text-gray-900 font-bold w-full text-left mb-6 tracking-tight">{{ __('app.loan_status') }}</h3>
                            
                            {{-- Fake Donut SVG --}}
                            <div class="relative w-36 h-36 mb-6">
                                <svg class="w-full h-full transform -rotate-20" viewBox="0 0 36 36">
                                    {{-- Background Track (Light Pattern or color) --}}
                                    <path class="text-gray-100" stroke-width="5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" stroke-linecap="round"/>
                                    
                                    {{-- Colored Progress --}}
                                    <path class="text-[#1b5b3e]" stroke-dasharray="20, 100" stroke-width="5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" stroke-linecap="round"/>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-3xl font-extrabold text-[#1b5b3e] tracking-tighter">
                                        @php
                                            $total = $stats['total_loans'] > 0 ? $stats['total_loans'] : 1;
                                            $percent = round(($stats['active_loans'] / $total) * 100);
                                        @endphp
                                        {{ $percent }}%
                                    </span>
                                    <span class="text-[10px] text-gray-500 font-medium tracking-tight">{{ __('app.books_borrowed') }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-4 text-[11px] font-semibold mt-auto w-full justify-center">
                                <div class="flex items-center gap-1.5 text-[#1b5b3e]"><div class="w-2.5 h-2.5 rounded-full bg-[#1b5b3e]"></div> {{ __('app.books_borrowed') }}</div>
                                <div class="flex items-center gap-1.5 text-gray-400"><div class="w-2.5 h-2.5 rounded-full bg-[repeating-linear-gradient(45deg,rgba(0,0,0,0.1),rgba(0,0,0,0.1)_1px,transparent_1px,transparent_3px)]"></div> {{ __('app.returned') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN (Projects/Loans Sidebar) --}}
                <div class="xl:col-span-1 space-y-6">
                    
                    {{-- Projects List --}}
                    <div class="bg-white border border-gray-100 rounded-[24px] p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-gray-900 font-bold tracking-tight">{{ __('app.recent_loans') }}</h3>
                            <a href="{{ route('loans') }}" class="px-2.5 py-1 border border-gray-200 text-gray-600 rounded-full text-[11px] font-semibold hover:bg-gray-50 flex items-center gap-1">
                                <i class="fa-solid fa-plus"></i> {{ __('app.new') }}
                            </a>
                        </div>
                        
                        <div class="space-y-5">
                            @forelse($recentLoans as $loan)
                                <div class="flex gap-4 group cursor-pointer hover:bg-gray-50 p-2 -mx-2 rounded-xl transition">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 
                                                @if($loan->status == 'borrowed') bg-[#1b5b3e]/10 text-[#1b5b3e]
                                                @elseif($loan->status == 'overdue') bg-gray-100 text-gray-500
                                                @else bg-gray-100 text-gray-500 @endif leading-none text-lg overflow-hidden relative">
                                        
                                        @if($loan->status == 'borrowed') <i class="fa-solid fa-book-open text-[14px]"></i>
                                        @elseif($loan->status == 'overdue') <i class="fa-solid fa-triangle-exclamation text-[14px]"></i>
                                        @else <i class="fa-solid fa-check text-[14px]"></i> @endif
                                        
                                        {{-- decorative slash --}}
                                        <div class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_2px,rgba(255,255,255,0.3)_2px,rgba(255,255,255,0.3)_4px)] opacity-30"></div>
                                    </div>
                                    
                                    <div class="overflow-hidden w-full flex flex-col justify-center">
                                        <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $loan->book->title ?? __('app.book_deleted') }}</h4>
                                        <p class="text-[11px] text-gray-500 mt-0.5 truncate font-medium">
                                            {{ __('app.due_time') }} {{ $loan->due_date ? $loan->due_date->format('M d, Y') : '-' }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-gray-400 text-sm py-10">{{ __('app.no_loan_transactions') }}</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <!-- Hero Section  -->
    <div class="bg-emerald-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-8 md:mb-0 md:w-1/2">
                    <div class="flex items-center gap-2 mb-4 text-emerald-200 uppercase tracking-wide text-sm font-bold">
                        <span>🌙</span> <span>{{ __('app.ramadan_reads') }}</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                        {{ __('app.welcome_back') }} {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-emerald-100 text-lg mb-8 max-w-lg">
                        Continue your reading journey. You have 2 {{ __('app.books_due_soon') }}
                    </p>
                    <div class="flex gap-4">
                         <a href="#" class="inline-block px-8 py-3 bg-white text-emerald-900 font-bold rounded-full hover:bg-emerald-50 transition">
                            {{ __('app.browse_collection') }}
                        </a>
                        <a href="{{ route('profile.edit') }}" class="inline-block px-8 py-3 border-2 border-white text-white font-bold rounded-full hover:bg-white/10 transition">
                            {{ __('app.my_account') }}
                        </a>
                    </div>
                </div>
                <!-- Hero Image Placeholder -->
                <div class="md:w-1/2 flex justify-center">
                     <div class="grid grid-cols-3 gap-4 transform rotate-3">
                         <div class="bg-white/10 p-2 rounded shadow-lg w-32 h-48"></div>
                         <div class="bg-white/20 p-2 rounded shadow-lg w-32 h-48 -mt-8"></div>
                         <div class="bg-white/10 p-2 rounded shadow-lg w-32 h-48"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- My Loans (Simulated) -->
             <section>
                <div class="flex justify-between items-end mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <span class="text-indigo-600">📖</span> {{ __('app.your_loans') }}
                    </h2>
                     <a href="#" class="text-sm font-semibold text-black hover:text-red-900">{{ __('app.view_all') }}</a>
                </div>
                
                 <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @for ($i = 0; $i < 3; $i++)
                    <div class="group">
                        <div class="aspect-[2/3] bg-gray-200 shadow-sm overflow-hidden mb-3 relative group-hover:shadow-md transition">
                            <div class="w-full h-full bg-gradient-to-br from-indigo-50 to-indigo-100 flex items-center justify-center text-indigo-300">
                                Cover
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-yellow-600/90 text-white text-xs font-bold py-1 text-center">
                                {{ __('app.due_in_days', ['days' => 2]) }}
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-1 truncate">Borrowed Book {{ $i+1 }}</h3>
                         <button class="text-xs text-black hover:text-red-900 font-medium">{{ __('app.renew') }}</button>
                    </div>
                    @endfor
                </div>
            </section>

          
      </div>
    </div>
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 border-t border-gray-800 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                     <div class="flex items-center gap-2 mb-4 text-white">
                        <img src="{{ asset('svgviewer-png-output.png') }}" class="h-14 w-auto" alt="Qatar National Library">
                    </div>
                    <p class="text-sm text-gray-400 max-w-sm">
                        {{ __('app.footer_desc') }}
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">{{ __('app.my_account') }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">{{ __('app.sign_in') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('app.need_card') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">{{ __('app.support') }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">{{ __('app.help') }}</a></li>
                        <li><a href="#" class="hover:text-white">{{ __('app.get_support') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Qatar National Library. {{ __('app.all_rights') }}
            </div>
        </div>
    </footer>
</div>

