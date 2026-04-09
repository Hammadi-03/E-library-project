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
                    <div class="absolute top-6 right-6 bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm">
                        <i class="fa-solid fa-book-bookmark text-base"></i>
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
                    <div class="absolute top-6 right-6 bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm">
                        <i class="fa-solid fa-file-invoice text-base"></i>
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
                    <div class="absolute top-6 right-6 bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm">
                        <i class="fa-solid fa-book-open-reader text-base"></i>
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
                    <div class="absolute top-6 right-6 bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm">
                        <i class="fa-solid fa-hourglass-half text-base"></i>
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
                        
                        {{-- Analytics Chart Integrated --}}
                        <div id="loan-statistics-root" 
                             class="md:col-span-2"
                             data-title="{{ __('app.loan_statistics') }}"
                             data-value="{{ $stats['total_loans'] }}"
                             data-description="Total activities recorded in the library system."
                             data-chart="{{ json_encode($days) }}">
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
                            
                            {{-- Project Progress (Donut Chart Integrated) --}}
                            <div id="loan-status-chart-root" 
                                 data-active="{{ $stats['active_loans'] }}" 
                                 data-overdue="{{ $stats['overdue_loans'] }}" 
                                 data-total="{{ $stats['total_loans'] }}"
                                 class="w-full">
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
   
          
      </div>
    </div>
   
</div>

