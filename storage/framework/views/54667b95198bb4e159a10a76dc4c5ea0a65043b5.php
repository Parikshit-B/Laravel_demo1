<!DOCTYPE html>
<html>
<head>
    <title>Laravel Demo</title>
</head>
<body>
    <p>Hi, <?php echo e($details['name']); ?></p>

    <p>Your password has been updated successfully</p>
    <p>Email Id : <b><?php echo e($details['email']); ?></b>
    <p>New Password : <b><?php echo e($details['password']); ?></b></p>
   
    <p>
        Thank you,<br/>
        Regards - Lravel Demo1<br/>
        (Author - Parikshit B.)
    </p>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel_demo1\resources\views/emails/changePassword.blade.php ENDPATH**/ ?>