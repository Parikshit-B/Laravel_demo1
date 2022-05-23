<html>
    <head>
        <title></title>
        
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
        

        <div class="container" style="border:double; margin-top: 8%;">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form class="needs-validation ml-auto" novalidate method="POST" enctype="multipart/form-data" action="<?php echo e(route('submit')); ?>">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fname">First Name : </label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="lname">Last Name : </label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="pswd">Password : </label>
                        <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Password">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="re_pswd">Re-Enter Password : </label>
                        <input type="password" class="form-control" id="re_pswd" name="re_pswd" placeholder="Re-Enter Password">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email_id">Email Id : </label>
                        <input type="email" class="form-control" id="email_id" name="email_id" placeholder="Email">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="mobile_no">Mobile No : </label>
                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
    </body>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html><?php /**PATH C:\xampp\htdocs\laravel_demo1\resources\views/add_users.blade.php ENDPATH**/ ?>