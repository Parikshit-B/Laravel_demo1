<!DOCTYPE html>
<html>
<head>
    <title>Laravel Demo</title>
</head>
<body>
    <p>Hi, <?php echo e($details['name']); ?></p>
    <p>Please login with you new password.</p>
    <p>New Password : <b><?php echo e($details['password']); ?></b></p>
    
    <?php
        if(session::get('email') === null) {
            echo "<p>*Note: Please change your password once you login </p>";
        }
    ?>
   
    <p>
        Thank you,<br/>
        Regards - Lravel Demo1<br/>
        Parikshit B.
    </p>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel_demo1\resources\views/emails/myTestMail.blade.php ENDPATH**/ ?>