@section('log')
    <ul>
        @if ($log)
            @foreach($log['action'] as $logged_event)
                <li>
                    {{ $logged_event }}
                </li>
            @endforeach
        @endif
    </ul>
@endsection