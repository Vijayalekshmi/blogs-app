<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
        }
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #666;
            margin-bottom: 20px;
        }
        a {
            color: #00b0ff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $post->user->name }}, you have a new {{ $activity }}!</h1>
        <p>You have received a new {{ $activity }} from {{ $doneByUser->name }} on your Post!</p>
        @if($details) <p>{{ $details }}</p> @endif
        <p>Thank you for using our application!</p>
        <p>Best regards,</p>
        <p>The {{ config('app.name') }} Team</p>
    </div>
</body>
</html>
