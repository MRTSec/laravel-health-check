<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Check</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .header {
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        .header-success {
            background-color: #4CAF50;
        }

        .header-failure {
            background-color: #F44336;
        }

        .thumbs-up {
            font-size: 36px;
            margin-right: 10px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .check-item {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .check-item::before {
            content: "✅";
            margin-right: 10px;
        }

        .check-item.failed::before {
            content: "❌";
        }

        .check-time {
            float: right;
            color: #888;
        }

        .thumbs-up {
            font-size: 36px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    @php
        $allPassed = collect($results)->every(fn($check) => $check['status'] === 'passed');
    @endphp
    <div class="header {{ $allPassed ? 'header-success' : 'header-failure' }}">
        <span class="thumbs-up">{{ $allPassed ? '👍' : '👎' }}</span>
        {{ $allPassed ? 'Health Check Passed' : 'We have some issues' }}
    </div>
    <div class="container">
        @foreach ($results as $name => $result)
            <div class="check-item {{ $result['status'] === 'passed' ? '' : 'failed' }}">
                {{ $name }}
                <span class="check-time">[{{ $result['time'] ?? '0.0ms' }}]</span>
            </div>
        @endforeach
    </div>

</body>

</html>
