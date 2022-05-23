<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
    </head>

    <body>
        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header">
                        <h3>Sign In</h3>
                        <div class="d-flex justify-content-end social_icon">
                            <span><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-square"></i></a></span>
                            <span><a href="https://myaccount.google.com/profile" target="_blank"><i class="fab fa-google-plus-square"></i></a></span>
                            <span><a href="https://twitter.com/login" target="_blank"><i class="fab fa-twitter-square"></i></a></span>
                        </div>
                    </div>

                    <div id="login_forms" style="display: block;">
                        <div class="card-body">
                            <form id="login_form" class="needs-validation ml-auto" novalidate enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <label id="error_msg" style="color:red;"> </label>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="email" name="email_id" id="email_id" class="form-control" placeholder="Email Id">
                                    
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="row align-items-center remember">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Login" class="btn float-right login_btn">
                                </div>
                            </form>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                Don't have an account?<a href="<?php echo e(route('add')); ?>">Sign Up</a>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="#" onclick="show_forget_password();">Forgot your password?</a>
                            </div>
                        </div>
                    </div>
                    
                    <div id="forget_passwrd" style="display: none;">
                        <div class="card-body">
                            <form id="forget_password" class="needs-validation ml-auto" novalidate enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <label id="reset_error_msg" style="color:red;"></label>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="email" name="email_id" id="email_id" class="form-control" placeholder="Email Id">
                                </div>
                                
                                <div class="row align-items-center">
                                    <label id="reset_msg" style="color: red;"></label><br/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn justify login_btn" style="min-width: 100% !important;">Reset Password</button>
                                </div>
                                <label><a href="#" onclick="hide_forget_password();" >&lt;&lt;&lt;Go back</a></label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script>
        function show_forget_password() {
            $('#login_forms').css('display', 'none');
            $('#forget_passwrd').css('display', 'block');
            $('.card-header').find('h3').text("Reset Password");
        }
        
        function hide_forget_password() {
            $('#forget_passwrd').css('display', 'none');
            $('#login_forms').css('display', 'block');
            $('.card-header').find('h3').text("Sign In");
        }

        $(document).ready(function() {
            $('#login_form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route("login")); ?>',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success:function(resp) {
                        if(resp.status == 404) {
                            alert(resp.msg);
                            $('#error_msg').html(" ");
                        }
                        else if(resp.status == 504) {
                            $('#error_msg').html(resp.msg);
                        }
                        else {
                            alert (resp.msg);
                            $('#error_msg').html(" ");
                            window.location.href = "<?php echo e(route('list')); ?>";
                        }
                    }
                });
            });

            $('#forget_password').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "<?php echo e(route('forget')); ?>",
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success:function(resp) {
                        if(resp.status == 200) {
                            hide_forget_password();
                            alert(resp.msg);
                            $('#reset_msg').text("Reset Mail sent, Please check you Inbox");
                            $('#reset_error_msg').html(" ");
                        } else {
                            $('#reset_msg').text(" ");
                            $('#reset_error_msg').html(resp.msg);
                        }
                    }
                });
            });
        });
    </script>

</html><?php /**PATH C:\xampp\htdocs\laravel_demo1\resources\views/auth/login.blade.php ENDPATH**/ ?>