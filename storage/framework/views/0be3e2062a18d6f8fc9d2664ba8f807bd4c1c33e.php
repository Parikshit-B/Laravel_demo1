<!DOCTPE html>
<html>
    <head>
        <title>View Student Records</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    
    <body>
        <div class="container"style="border:double; margin-top: 8%;">
            <table class="table" border = "1">
                <thead class="thead-dark">
                    <tr>
                        <th> Id </th>
                        <th> First Name </th>
                        <th> Last Name </th>
                        <th> Email </th>
                        <th> Password </th>
                        <th> Mobile No </th>
                        <th> Created At </th>
                    </tr>
                </thead>
                
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($val['id']); ?></td>
                        <td><?php echo e($val['fname']); ?></td>
                        <td><?php echo e($val['lname']); ?></td>
                        <td><?php echo e($val['email_id']); ?></td>
                        <td><?php echo e($val['password']); ?></td>
                        <td><?php echo e($val['mobile_no']); ?></td>
                        <td><?php echo e($val['created_at']); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
        
    </body>
</html><?php /**PATH C:\xampp\htdocs\laravel_demo1\resources\views/list_users.blade.php ENDPATH**/ ?>