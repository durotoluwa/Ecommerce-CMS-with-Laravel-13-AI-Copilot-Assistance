
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
								<h4 class="fw-bold">Assign Permissions</h4>
								<h6>Manage your User permissions</h6>
							</div>
						</div>
					 
			 
					</div>               

                    
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">

				<form method="GET" action="{{ route('user_permissions.index') }}">
        <div class="mb-3">
            <label>Select User</label>
            <select name="user_id" class="form-control" onchange="this.form.submit()">
                <option value="">-- Choose User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }} - ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- If User Selected -->
    @if($selectedUser)
        <form method="POST" action="{{ route('user_permissions.store') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $selectedUser->id }}">

            <div class="mb-3">
                <label>Assign Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    class="form-check-input" id="perm_{{ $permission->id }}"
                                    {{ $selectedUser->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary rounded-pill mt-3">Update Permissions</button>
        </form>
    @endif
                           
                                    







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
                      <button type="submit" class="btn btn-primary rounded-pill rounded-pill">Save Permission</button>
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