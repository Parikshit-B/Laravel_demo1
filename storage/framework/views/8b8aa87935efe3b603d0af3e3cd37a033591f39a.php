<!DOCTPE html>
<html>
    <head>
        <title>View Student Records</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<!-- DataTable -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo e(asset('fonts/style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>">
        
        <style>
            .dataTables_filter {
                margin-right: 10px;
            }
        </style>

    </head>
    
    <body>
		<div class="content">
			<div class="container">
				<h2 class="mb-5">Users Details</h2>
				<div class="table-responsive">
					<table id="users_lists" class="table custom-table">
						<thead>
							<tr>
								<th scope="col">Id</th>
								<th scope="col">First Name</th>
								<th scope="col">Last Name</th>
								<th scope="col">Email Id</th>
                                <th scope="col">Mobile No</th>
								<th scope="col">Created At</th>
                                <th scope="col">Action</th>
							</tr>
						</thead>

						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="update_password">
                    <div class="form-group">
                        <input type="hidden" name="user_id" id="user_id" class="form-control">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label id="error_msg" style="color:red;"></label>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" id="btn_submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
    </body>

    <script>

        function show_modal($id) {
            $('#user_id').val($id);
            $('#exampleModal').modal('show');
        }
        $(document).ready(function() {
            $('#users_lists').DataTable({
                'processing': false,
                'serverSide': true,
                "bLengthChange": false,
                'ajax': {
                    'url'  :'<?php echo e(route("users_list")); ?>',
                    'type' : 'POST',
                    'data' : {"_token":"<?php echo e(csrf_token()); ?>"},
                },
            });

            $('#btn_submit').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type:'POST',
                    url:"<?php echo e(route('update')); ?>",
                    data:$('#update_password').serialize(),
                    dataType:"JSON",
                    success:function(resp) {
                        if( resp.status == 504) $('#error_msg').text(resp.msg);
                        else if(resp.status == 200) {
                            $('#error_msg').text("");
                            alert(resp.msg);
                            $('#exampleModal').modal('hide');
                        } else {
                            alert(resp.msg);
                        }
                    }
                })
            })
        });
    </script>

</html><?php /**PATH C:\xampp\htdocs\laravel_demo1\resources\views/auth/auth_list.blade.php ENDPATH**/ ?>