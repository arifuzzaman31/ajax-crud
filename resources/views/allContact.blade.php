<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    {{-- dataTables --}}
       <link href="{{ asset('public/assets/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

      {{-- SweetAlert2 --}}
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{--   <link href="{{ asset('public/assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"> --}}
       <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
       <link href="{{ asset('public/assets/bootstrap/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

      <!-- Custom styles for this template -->
       <link href="{{ asset('public/assets/bootstrap/css/navbar-fixed-top.css') }}" rel="stylesheet">

       <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
       <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
      <script src="{{ asset('public/assets/bootstrap/js/ie-emulation-modes-warning.js') }}"></script>
    <title>Ajax Crud</title>
  </head>
  <body>
<div class="container">
	<h1>Ajax Crud Operation</h1>
	<div class="row">
		<div class="col-lg-12">
		<a onclick="addForm()" class="btn btn-sm btn-success pull-right">Add New</a>
			<table id="contact-table" class="table table-striped">
			  <thead>
			    <tr>
			      <th>ID</th>
			      <th>Name</th>
			      <th>Phone</th>
			      <th>Email</th>
			      <th>Religion</th>
			      <th>Action</th>
			    </tr>
			  </thead>
			  <tbody>
			    
			  </tbody>
			</table>
		</div>
	</div>
	@include('form');
</div>



    <!-- Optional JavaScript -->
  <!-- Optional JavaScript -->
    {{-- <script src="{{ asset('public/assets/jquery/jquery-1.12.4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/assets/bootstrap/js/bootstrap.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    {{-- dataTables --}}
    <script src="{{ asset('public/assets/dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

    {{-- Validator --}}
    <script src="{{ asset('public/assets/validator/validator.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('public/assets/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>

    <script type="text/javascript">
    	var table1=$('#contact-table').DataTable({
    		processing:true,
    		serverSide:true,
    		 ajax: "{{ route('all.contact') }}",
    	  columns: [
    		{data:'id', name:'id'},
    		{data:'name', name:'name'},
    		{data:'phone', name:'phone'},
    		{data:'email', name:'email'},
    		{data:'religion', name:'religion'},
    		{data:'action',name:'action',orderable:false,searchable:false}
    			]
    	});

    	function addForm(){
    		save_method = 'add';
    		$('input[name_method]').val('POST');
    		$('#form-modal').modal('show');
    		$('#form-modal form')[0].reset();
    		$('.modal-title').text('Add Contact');
    		$('#insertbotton').text('Add Contact');
    	}

//Insert data by Ajax
    	$(function(){
    		$('#form-modal form').validator().on('submit', function(e){
    			if (!e.isDefaultPrevented()){
    				var id = $('#id').val();
    				if (save_method == 'add') url = "{{ url('contact') }}";
    				else url = "{{ url('contact').'/' }}" + id;
    				$.ajax({
    					url: url,
    					type: "POST",
    					data: new FormData($("#form-modal form")[0]),
    					contentType: false,
    					processData: false,
    					success : function(data){
    						$('#form-modal').modal('hide');
    						table1.ajax.reload();
    						swal({
    							title: "Good job!",
    							text: "You click the Botton!",
    							icon: "success",
    							button: "Great!",
    						});
    					},
    					error : function(data){
    						swal({
    							title: 'Opss....',
    							text: data.message,
    							type: 'error',
    							timer: '1500'
    						});
    					}
    				})
    				return false;
    			}
    		});
    	});

    //Edit Funtion
    function editForm(id)
    {
    	save_method = 'edit';
    	$('input[name=_method').val('PATCH');
    	$('#form-modal form')[0].reset();
    	$.ajax({
    		url: "{{ url('contact')}}" + '/' + id + "/edit",
    		type: "GET",
    		dataType: "JSON",
    		success: function(data){
    			$('#form-modal').modal('show');
    			$('.modal title').text('Edit Contact');
    			$('#insertbotton').text('Update Contact');
    			$('#id').val(data.id);
    			$('#name').val(data.name);
    			$('#phone').val(data.phone);
    			$('#email').val(data.email);
    			$('#religion').val(data.religion);
    		},
    		error: function(){
    			alert("Nothing Data");
    		}

    	});
    }

//Delete Data
    function deleteData(id){
       
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url: "{{ url('contact') }}" + '/' + id,
                    type: "POST",
                    data: { '_method': 'DELETE','_token': csrf_token },
                    success: function(data){
                       table1.ajax.reload(); 
                        swal("Poof! Your imaginary file has been deleted!",{
                            title: "Delete Done!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Done",
                        });
                    },
                    error: function(data){
                         swal({ 
                          title: 'Oops...',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      })
                    }
                });
              } 
              else {
                swal("Your imaginary file is safe!");
              }
            });
    }

    // Show single Data
    function showData(id){
        $.ajax({
            url: "{{ url('contact') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#single-data').modal('show');
                $('.modal-title').text(data.name + ' ' +'Information' );
                $('#contactid').text(data.id);
                $('#fullname').text(data.name);
                $('#contactemail').text(data.email);
                $('#contactnumber').text(data.phone);
                $('#creligion').text(data.religion);
            },
            error: function(){
                alert('Gorar Dim');
            }
        });
    }
    </script>
 
</body>
</html>