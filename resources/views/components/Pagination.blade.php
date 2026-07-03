@props(['paginator' => null])

@if ($paginator && $paginator instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $paginator->hasPages())
    <nav class="mt-16 ml-10 w-full" aria-label="Page navigation example">
        <ul class="inline-flex -space-x-px text-sm">
            @php
                $links = $paginator->linkCollection();
                $totalLinks = count($links);
            @endphp
            @foreach ($links as $index => $link)
                @php
                    $isFirst = $index === 0;
                    $isLast = $index === $totalLinks - 1;
                    
                    $roundedClass = '';
                    if ($isFirst) {
                        $roundedClass = 'rounded-l-lg';
                    } elseif ($isLast) {
                        $roundedClass = 'rounded-r-lg';
                    }
                @endphp
                
                @if ($link['active'])
                    <li>
                        <span class="flex items-center justify-center px-3 h-8 {{ $roundedClass }} text-regal-brown border border-gray-300 bg-amber-50 dark:border-gray-700 dark:bg-gray-700 dark:text-white font-bold cursor-default">{{ $link['label'] }}</span>
                    </li>
                @elseif ($link['url'] === null)
                    <li>
                        <span class="flex items-center justify-center px-3 h-8 {{ $roundedClass }} text-gray-400 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500 cursor-not-allowed">{!! $link['label'] !!}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $link['url'] }}" class="flex items-center justify-center px-3 h-8 {{ $roundedClass }} leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            {!! $link['label'] !!}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
@else
    {{-- Fallback to static mock design if no paginator is passed --}}
    <nav class="mt-16 ml-10 w-full" aria-label="Page navigation example">
        <ul class="inline-flex -space-x-px text-sm">
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 rounded-l-lg text-regal-brown border border-gray-300 bg-amber-50 hover:bg-amber-600 hover:text-white dark:border-gray-700 dark:bg-gray-700 dark:text-white">1</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">3</a>
            </li>
        </ul>
    </nav>
@endif