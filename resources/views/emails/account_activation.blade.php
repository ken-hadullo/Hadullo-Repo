<!DOCTYPE html>
<html>
<head>
    <title>Account Activation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <p>Dear <strong>{{ $user->name }}</strong>,</p>
    <p>Welcome to our platform! Please activate your account by clicking the link below:</p>
    <p>
        <a href="{{ route('user.verification', ['code' => $user->verification_code]) }}"
           style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: #ffffff; font-weight: bold; text-decoration: none; border-radius: 5px;">
           Activate Your Account
        </a>
    </p>
    <p>Thanks,<br>The Team</p>
</body>
</html>



