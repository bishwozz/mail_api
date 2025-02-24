<!DOCTYPE html>
<html>

<head>
    <title>{{ $subject ?? 'No Subject' }}</title>
</head>

<body>
    <p>
        @if (is_array(json_decode($message_ht, true)))
            @foreach (json_decode($message_ht, true) as $key => $msg)
                <strong>{{ ucfirst($key) }}:</strong> {{ $msg }}<br>
            @endforeach
        @else
            {{ $message_ht }}
        @endif
    </p>
</body>

</html>
