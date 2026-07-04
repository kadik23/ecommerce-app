@props(['fullname', 'email', 'revenue', 'country', 'profileImage' => null])

<div class="grid grid-cols-5 min-w-[600px] text-xs lg:text-base text-center items-center py-4 border-b border-gray-100 dark:border-gray-700">
    <div class="flex justify-center">
        @if($profileImage)
            <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('assets/images/profiles/' . $profileImage) }}" alt="{{ $fullname }}">
        @else
            <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-gray-700 flex items-center justify-center text-regal-brown font-bold text-sm">
                {{ strtoupper(substr($fullname ?: $email, 0, 2)) }}
            </div>
        @endif
    </div>
    <span class="truncate px-2 text-gray-900 dark:text-white font-medium">{{ $fullname ?: 'N/A' }}</span>
    <span class="truncate px-2 text-gray-500 dark:text-gray-400">{{ $email }}</span>
    <span class="font-semibold text-gray-900 dark:text-white">${{ number_format($revenue ?? 0, 2) }}</span>
    <span class="text-gray-500 dark:text-gray-400">{{ $country ?: 'N/A' }}</span>
</div>
