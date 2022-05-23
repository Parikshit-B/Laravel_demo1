<!DOCTYPE html>
<html>
<head>
    <title>Laravel Demo</title>
</head>
<body>
    <p>Hi, {{ $details['name'] }}</p>

    <p>Your password has been updated successfully</p>
    <p>Email Id : <b>{{$details['email']}}</b>
    <p>New Password : <b>{{ $details['password'] }}</b></p>
   
    <p>
        Thank you,<br/>
        Regards - Lravel Demo1<br/>
        (Author - Parikshit B.)
    </p>
</body>
</html>