<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Register User</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet" media="all">
    </head>

    <style>
        .input--style-4 {
            box-shadow: inset 1px 0px 20px 10px rgb(0 0 0 / 8%);
        }
    </style>

    <body>
        <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
            <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <h2 class="title">User Registration Form</h2>
                        <form id="add_user" method="POST" enctype="multipart/form-data">
                            <h4><label id="error_msg" style="color:red;"></label></h4><br/>
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">first name</label>
                                        <input class="input--style-4" type="text" name="first_name" id="first_name">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">last name</label>
                                        <input class="input--style-4" type="text" name="last_name" id="last_name">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Email</label>
                                        <input class="input--style-4" type="email" name="email" id="email">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Phone Number</label>
                                        <input class="input--style-4" type="text" name="mobile_no" id="mobile_no" maxlength="10" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Password </label>
                                        <input class="input--style-4" type="password" name="password" id="password">
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="p-t-15">
                                <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script>
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
            return true;
        }

        $(document).ready(function() {
            $('#add_user').submit(function(e) {
                e.preventDefault();
                $('#error_msg').text("");
                $.ajax({
                    type:"POST",
                    url:"<?php echo e(route('submit')); ?>",
                    data:$(this).serialize(),
                    dataType:"JSON",
                    success:function(resp) {
                        if(resp.status == 504) $('#error_msg').text(resp.msg);
                        else if(resp.status == 200) {
                            $('#error_msg').text("");
                            alert(resp.msg);
                            window.location.href= "<?php echo e(route('home')); ?>";
                        } else alert(resp.msg);
                    }
                });
            });
        });
    </script>
</html><?php /**PATH C:\xampp\htdocs\laravel_demo1\resources\views/auth/add_users.blade.php ENDPATH**/ ?>