<div>
    @foreach ($activity_logs as $activity_log)
        <ul>
             @php
                $user = $this->getUser($activity_log->causer_id);
                $tableRoute = url('/' . $this->formatRoute($activity_log->description));
            @endphp

            <li>
                {{ $user->employee_id }}  {{ $activity_log->log_name }} {{ $activity_log->description }} at {{ $activity_log->created_at->diffForHumans() }}
            </li>

            </li>
            <a href="{{ $tableRoute }}" target="_blank">{{ $activity_log->description }}</a>
        </ul>
    @endforeach
</div>