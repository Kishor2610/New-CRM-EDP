<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <p>Hello,</p>

    <p>We received a request to reset your password. If you didn't make this request, you can ignore this email.</p>

    <p>To reset your password, please click the following link:</p>

    <a href="{{ route('password.reset', ['token' => $token]) }}">Reset Your Password</a>

    <p>This password reset link will expire in 30 minutes.</p>

    <p>Thank you!</p>
</body>
</html>