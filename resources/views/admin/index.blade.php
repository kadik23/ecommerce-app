@extends('layouts.dashboard')

@section('content1')

<x-admin.titleCard :title="$indexTitle" />


<div class="flex flex-wrap lg:flex-nowrap justify-between">

    <div class=" m-3 w-full lg:w-2/3 ">
        <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <script>
                window.userStatsInitialData = @json($userStats['chart_data']);
                window.userStatsInitialLabels = @json($userStats['chart_labels']);
            </script>
            <h5 class="inline-block text-sm lg:text-xl font-bold my-3 text-gray-900 dark:text-white">{{ t('admin.dashboard.users_statistic') }}</h5> 
            <div class="flex justify-between">
                <div>
                    <h5 class="leading-none text-xl lg:text-3xl font-bold text-gray-900 dark:text-white pb-2" id="stat-count">
                        {{ number_format($userStats['count']) }}
                    </h5>
                    <p class="text-sm lg:text-base font-normal text-gray-500 dark:text-gray-400" id="stat-range-label">
                        {{ $userStats['range_label'] }}
                    </p>
                </div>
                <div class="flex items-center px-2.5 py-0.5 text-sm lg:text-base font-semibold {{ $userStats['trend'] === 'up' ? 'text-green-500' : 'text-red-500' }} text-center" id="stat-trend-container">
                    <span id="stat-percentage">{{ $userStats['percentage'] }}%</span>
                    <svg id="stat-trend-icon" class="w-3 h-3 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        @if($userStats['trend'] === 'up')
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                        @else
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v12m0 0L1 9m4 4 4-4"/>
                        @endif
                    </svg>
                </div>
            </div>
            <div id="area-chart"></div>
            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <!-- Dropdown Wrapper -->
                    <div class="relative">
                        <!-- Button -->
                        <button
                            id="dropdownDefaultButton"
                            data-dropdown-toggle="lastDaysdropdown"
                            data-dropdown-placement="bottom"
                            class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                            type="button">
                            <span id="dropdown-selected-label">{{ t('admin.dashboard.last_7_days') }}</span>
                            <svg class="w-2.5 m-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="lastDaysdropdown" class="z-20 hidden absolute left-0 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white range-filter-btn" data-range="yesterday">{{ t('admin.dashboard.yesterday') }}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white range-filter-btn" data-range="today">{{ t('admin.dashboard.today') }}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white range-filter-btn" data-range="7days">{{ t('admin.dashboard.last_7_days') }}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white range-filter-btn" data-range="30days">{{ t('admin.dashboard.last_30_days') }}</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white range-filter-btn" data-range="90days">{{ t('admin.dashboard.last_90_days') }}</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <a
                    href="{{ route('admin.usersReport', ['range' => '7days']) }}"
                    id="users-report-btn"
                    class="uppercase text-xs lg:text-sm font-semibold inline-flex items-center rounded-lg text-regal-brown hover:text-amber-700 dark:hover:text-amber-700  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                    {{ t('admin.dashboard.users_report') }}
                    <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    
    <div class="w-full lg:w-96 flex flex-col gap-2">
        <div class="m-3 p-5 sm:p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-lg font-bold text-gray-900 dark:text-white mb-4">{{ t('admin.dashboard.total_report') }}</h5>
            
            <div class="flex items-center justify-between p-3 my-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div class="flex items-center gap-3">
                    <img class="w-8 h-8 object-contain" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABPklEQVR4nO2WzUrEMBRGbwdN3kz09RTXDQyIP7sRndl0pmVw4ajbvoHaJ6jLI0nXSi2dNDL3wIXQJJS0h+9GRFEU5eChNGdU5pLSvlGaDyr7FcqP/TM/t7GnSX4oKrOksvSsR0kNCrPrfYDC7CQ1cAJ3s1dWxxVrW1OahtK2XZmGja3DnF/jBEkNbrKncIg+dTvbSmpQmOdQi6OC66xmnn3ipA3lx1dZHebW3brkUoE+Ci3/oFDsVGBshWKnAmMrFDsVGF2hyKnAHhQaPxVivo+xf2ns96EK/WOFGNAASUWhoQ2QVFJoaAMkFYWGNkCSUSjyvn0oFHXfNAqNuO9HVKGFKtSoQmgKWU0htJGttJGhd6H5Qd6FnDz0vt7mcj/Vvl/ByQm5XODEn/qdXNpQ3fgFJ+d+zdT7FEVRZHK+AcKVXlXG4vExAAAAAElFTkSuQmCC">
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ t('admin.dashboard.total_profits') }}</span>
                </div>
                <span class="text-base font-bold text-gray-900 dark:text-white">${{ number_format($totalProfits, 2) }}</span>
            </div>

            <div class="flex items-center justify-between p-3 my-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div class="flex items-center gap-3">
                    <img class="w-8 h-8 object-contain" src="data:image/png;base64,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">
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ t('admin.dashboard.revenue') }}</span>
                </div>
                <span class="text-base font-bold text-gray-900 dark:text-white">${{ number_format($totalRevenue, 2) }}</span>
            </div>
        </div>

        <div class="m-3 p-5 sm:p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-lg font-bold text-gray-900 dark:text-white">{{ t('admin.dashboard.latest_customers') }}</h5>
                <a href="{{route('dashboard.Customers')}}" class="text-sm font-medium text-regal-brown hover:underline dark:text-regal-brown">
                    {{ t('admin.dashboard.view_all') }}
                </a>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($latestCustomers as $customer)
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if($customer['profile_image'])
                                        <img class="w-8 h-8 rounded-full object-cover" src="{{ asset('assets/images/profiles/' . $customer['profile_image']) }}" alt="{{ $customer['name'] }}">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 text-regal-brown dark:text-amber-500 flex items-center justify-center font-bold text-xs">
                                            {{ $customer['initials'] }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs lg:text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $customer['name'] }}
                                    </p>
                                    <p class="text-xs lg:text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $customer['email'] }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-xs lg:text-base font-semibold text-gray-900 dark:text-white">
                                    ${{ number_format($customer['revenue'], 2) }}
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-3 sm:py-4 text-center text-gray-500 dark:text-gray-400 text-sm">
                            {{ t('admin.dashboard.no_customers_found') }}
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        let currentRange = '7days';

        // Toggle dropdown display manually to bypass any framework loading delays
        $('#dropdownDefaultButton').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('#lastDaysdropdown').toggleClass('hidden');
        });

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#dropdownDefaultButton').length && !$(e.target).closest('#lastDaysdropdown').length) {
                $('#lastDaysdropdown').addClass('hidden');
            }
        });

        // Listen for filter buttons
        $('.range-filter-btn').on('click', function(e) {
            $('#lastDaysdropdown').addClass('hidden');
            e.preventDefault();
            const range = $(this).data('range');
            const labelText = $(this).text();
            
            currentRange = range;

            // Update dropdown button text
            $('#dropdown-selected-label').text(labelText);

            $.ajax({
                url: "{{ route('admin.userStats') }}",
                type: 'GET',
                data: { range: range },
                dataType: 'json',
                success: function(data) {
                    // Update stats text
                    $('#stat-count').text(new Intl.NumberFormat().format(data.count));
                    $('#stat-range-label').text(data.range_label);
                    $('#stat-percentage').text(data.percentage + '%');

                    // Update trend color and icon
                    const container = $('#stat-trend-container');
                    const icon = $('#stat-trend-icon');
                    
                    if (data.trend === 'up') {
                        container.removeClass('text-red-500').addClass('text-green-500');
                        icon.html('<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>');
                    } else {
                        container.removeClass('text-green-500').addClass('text-red-500');
                        icon.html('<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v12m0 0L1 9m4 4 4-4"/>');
                    }

                    // Update report link range parameter
                    const reportUrl = "{{ route('admin.usersReport') }}?range=" + range;
                    $('#users-report-btn').attr('href', reportUrl);

                    // Update the ApexChart dynamically
                    if (window.userStatsChart) {
                        window.userStatsChart.updateSeries([{
                            name: "New users",
                            data: data.chart_data,
                            color: "#b17b4f"
                        }]);
                        window.userStatsChart.updateOptions({
                            xaxis: {
                                categories: data.chart_labels
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Failed to load statistics:", error);
                }
            });
        });
    });
</script>
@endsection
