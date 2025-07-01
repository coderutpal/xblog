<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .email-header h1 {
            color: #333333;
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
        }

        .reset-button {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999999;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .email-container {
                padding: 15px;
            }

            .reset-button {
                padding: 10px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Password Reset Request</h1>
        </div>
        <div class="email-body">
            <p>Hello, {{ $user->name }}</p>
            <p>We received a request to reset your password. Click the button below to reset it.</p>
            <p style="text-align: center;">
                <a href="{{ $actionLink }}" target="_blank" class="reset-button">Reset
                    Password</a>
            </p>
            <p>This link will expire after 15 minutes</p>
            <p>If you did not request a password reset, please ignore this email.</p>
            <p>Thank you,<br>Xblog</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('y') }} Xblog. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
