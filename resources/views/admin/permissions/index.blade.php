
<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>
@include('admin.include.headelink')
	
</head>

<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!--========= Header =========-->
		@include('admin.include.header')
		<!--=========== /Header =======-->
	

		<!--====== Sidebar ===========-->
		@include('admin.include.sidebar')
		<!--========= /Sidebar =========-->

	     <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @elseif(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="page-wrapper">
<div class="content">

 <div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4 class="fw-bold">Permission List</h4>
								<h6>Manage your permissions</h6>
							</div>
						</div>
					 
						<div class="page-btn">
<a href="#" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#add-user"><i class="ti ti-circle-plus me-1"></i>Add Permission</a>						</div>	
                        <!---
						<div class="page-btn import">
							<a href="#" class="btn btn-secondary color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
								data-feather="download" class="me-1"></i> dfsfsf</a>
						</div>--->
					</div>               




					<div class="row">
						<div class="col-sm-12">
							<div class="card">
							 
								<div class="card-body">

									<div class="table-responsive no-search">
										<table class="table datatable">
											<thead class="thead-light">
												<tr>
											    <th>Name</th>
                                                <th>created by</th>
                                                <th> Action</th>
												</tr>
											</thead>
											<tbody>
											   @foreach($permissions as $permission)
                  <tr>
                     
                   <td>{{ $permission->name }}</td>
                 <td>{{ $permission->created_at->format('F j, Y g:i A') }}</td>

             
                    <td>
<button data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{ $permission->id }}" type="button" class="btn btn-rounded btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i> Edit Permission</button>
<button data-bs-toggle="modal" data-bs-target="#basicModal{{ $permission->id }}"  type="button" class="btn btn-rounded btn-outline-danger"><i class="fa-solid fa-trash"></i> Delete</button>        

       <!-- Edit Permission -->
              <div class="modal fade" id="exampleModalCenter{{ $permission->id }}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Permission</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                   
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
    @csrf   
    @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input value="{{ $permission->name }}" type="text" name="name" class="form-control" placeholder="Permission Name" required>
        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary rounded-pill">Update Permission</button>
                    </div>
                     </form>
                  </div>
                </div>
              </div>

</td>   

 <!--==== Delete Permission =======-->
            <div class="modal fade" id="basicModal{{$permission->id }}">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Delete permission - {{$permission ->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">Are you sure you want to delete {{$permission ->name}} permission , you cant get it back again, once deleted</div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                     
                      <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" >Delete</button>
                        </form>

                   

                  </div>
                </div>
              </div>


                  </tr>

 @endforeach
											 
												 
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>






	</div></div>
    <!--=======end of content and page-wrapper========-->

    


    <!-- Add Permission -->
		<div class="modal fade" id="add-user">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header">
								<div class="page-title">
									<h4>Add Permission</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							 <form method="POST" action="{{ route('permissions.store') }}">
        @csrf
        <div class="modal-body">
<div class="row">
<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Permission Name<span class="text-danger ms-1">*</span></label>
												<input type="text" class="form-control" name="name" required>
											</div>
										</div>

</div></div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary rounded-pill">Save Permission</button>
                    </div>
                     </form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Permission -->
 
	@include('admin.include.footer')
</html>