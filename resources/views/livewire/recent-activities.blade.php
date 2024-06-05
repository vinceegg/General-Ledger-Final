<div>
    @foreach ($activity_logs as $activity_log)
        <ul>
            @php
                $user = $this->getUser($activity_log->causer_id);
                $tableRoute = url('/' . $this->formatRoute($activity_log->description));
            @endphp

            <div class="recent-activities bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-4 ">
                <div class="flex">
                    <!-- First Column -->
                    <div class="w-full">
                        <h5 class="mb-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $user->email ?? 'N/A'}}</h5>
                    </div>

                    <!-- Second Column -->
                    <div class="w-full text-right">
                        <span class="inline-flex items-right bg-blue-100 text-blue-800 font-small inline-flex items-center px-1 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                            </svg>
                            {{ $activity_log->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{ $activity_log->log_name }} {{ $activity_log->description }}</p>
            </div>
        @endforeach
    </div>
