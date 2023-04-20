@if (session()->has('warning'))
    <div class="rounded-lg bg-warning-100 p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-warning-800 shrink-0 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm font-semibold text-warning-800">
                {{ session('warning') }}
            </span>
        </div>
    </div>
@endif
