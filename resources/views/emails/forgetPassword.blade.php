<!DOCTYPE html>
<html>
<head>
    <title>Laravel Demo</title>
</head>
<body>
    <p>Hi, {{ $details['name'] }}</p>

    <p>Please login with the new temporary password.</p>
    <p>New Password : <b>{{ $details['password'] }}</b></p>
    <p>*Note: Please change your password once you login </p>
   
    <p>
        Thank you,<br/>
        Regards - Lravel Demo1<br/>
        (Author - Parikshit B.)
    </p>
</body>
</html>