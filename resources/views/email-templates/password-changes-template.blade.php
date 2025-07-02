<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .content {
            font-size: 16px;
            line-height: 1.5;
        }

        .credentials {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 4px;
            margin-top: 15px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #888888;
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Password Changed Successfully</h2>
        </div>
        <div class="content">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>
            <p>Your password has been changed successfully.</p>
            <p>Here are your updated login credentials:</p>

            <div class="credentials">
                <p><strong>Username/Email:</strong> {{ $user->username }} or {{ $user->email }}</p>
                <p><strong>New Password:</strong> {{ $new_password }}</p>
            </div>

            <p>If you did not request this change, please contact support immediately.</p>

            <p>Thank you,<br>Xblog Team</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Xblog. All rights reserved.
        </div>
    </div>
</body>

</html>
