<div class="header">
			<div class="main-header">
				<!-- Logo -->
				<div class="header-left active">
					<a href="" class="logo logo-normal">
						<img src="{{ asset($websiteConfig->main_logo) }}" alt="Img">
					</a>
					<a href="" class="logo logo-white">
						<img src="assets/img/logo-white.svg" alt="Img">
					</a>
					<a href="" class="logo-small">
						<img src="{{ asset($websiteConfig->main_logo) }}" alt="Img">
					</a>
					<a href="" class="logo-small-white">
						<img src="assets/img/logo-small-white.png" alt="Img">
					</a>
				</div>
				<!-- /Logo -->
				<a id="mobile_btn" class="mobile_btn" href="#sidebar">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>

				<!-- Header Menu -->
				<ul class="nav user-menu">

					<!-- Search ---->
					<li class="nav-item nav-searchinputs">
						<div class="top-nav-search">
							 
							 
						</div>
					</li>
					<!-- /Search  --->
 
					<li class="nav-item dropdown link-nav">
						<a href="javascript:void(0);" class="btn btn-primary btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
							<i class="ti ti-circle-plus me-1"></i>Add New
						</a>
						<div class="dropdown-menu dropdown-xl dropdown-menu-center">
							<div class="row g-2">

								@can('product section')
								<div class="col-md-4">
									<a href="{{ route('admin.product_categories.index') }}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-brand-codepen"></i>
										</span>
										<p>Category</p>
									</a>
								</div>
								<div class="col-md-4">
									<a href="{{ route('admin.products.create') }}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-square-plus"></i>
										</span>
										<p>Product</p>
									</a>
								</div>
								<div class="col-md-4">
									<a href="{{ route('admin.brands.index') }}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-shopping-bag"></i>
										</span>
										<p>Brands</p>
									</a>
								</div>


									<div class="col-md-4">
									<a href="{{ route('admin.attributes.index') }}" class="link-item">
										<span class="link-icon">
										<i class="ti ti-progress-alert fs-16 me-2"></i>
										</span>
										<p>Attributes</p>
									</a>
								</div>
@endcan
								 
@can('user management')	
								<div class="col-md-4">
									<a href="{{ route('admin.users.index') }}" class="link-item">
										<span class="link-icon">
											<i class="ti ti-user"></i>
										</span>
										<p>Admin User</p>
									</a>
								</div>
@endcan
							 
								 @can('view order')
							
								<div class="col-md-4">
									<a href="customers.html" class="link-item">
										<span class="link-icon">
											<i class="ti ti-users"></i>
										</span>
										<p>Customer</p>
									</a>
								</div>
						@endcan	 
							 
								 
							</div>
						</div>
					</li>
					
					 

					<!-- Flag  
					<li class="nav-item dropdown has-arrow flag-nav nav-item-box">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);"
							role="button">
							<img src="assets/img/flags/us-flag.svg" alt="Language" class="img-fluid">
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets/img/flags/english.svg" alt="Img" height="16">English
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets/img/flags/arabic.svg" alt="Img" height="16">Arabic
							</a>
						</div>
					</li>
					<!-- /Flag ---->

					<li class="nav-item nav-item-box">
						<a href="javascript:void(0);" id="btnFullscreen">
							<i class="ti ti-maximize"></i>
						</a>
					</li>
					 
					<!-- Notifications ------>
					<li class="nav-item dropdown nav-item-box">
						<a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<i class="ti ti-bell"></i>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<h5 class="notification-title">Notifications</h5>
								<a href="javascript:void(0)" class="clear-noti">Mark all as read</a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">

<!----
									<li class="notification-message">
										<a href="activities.html">
											<div class="media d-flex">
												<span class="avatar flex-shrink-0">
													<img alt="Img" src="assets/img/profiles/avatar-13.jpg">
												</span>
												<div class="flex-grow-1">
													<p class="noti-details"><span class="noti-title">James Kirwin</span> confirmed his order.  Order No: #78901.Estimated delivery: 2 days</p>
													<p class="noti-time">4 mins ago</p>
												</div>
											</div>
										</a>
									</li>-->
								 
								 
								 
								</ul>
							</div>
							<div class="topnav-dropdown-footer d-flex align-items-center gap-3">
								<a href="#" class="btn btn-secondary btn-md w-100">Cancel</a>
								<a href="activities.html" class="btn btn-primary btn-md w-100">View all</a>
							</div>
						</div>
					</li>
					<!-- /Notifications ---> 

					
					<li class="nav-item dropdown has-arrow main-drop profile-nav">
						<a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
							<span class="user-info p-0">
								<span class="user-letter">
@if(auth()->user()->image)
    <img src="{{ asset('user/' . auth()->user()->image) }}" alt="Img"  >
@else
    <img src="{{ asset($websiteConfig->main_logo) }}" alt="Img" class="img-fluid">
@endif

								</span>
							</span>
						</a>
						<div class="dropdown-menu menu-drop-user">
							<div class="profileset d-flex align-items-center">
								<span class="user-img me-2">
									@if(auth()->user()->image)
    <img src="{{ asset('user/' . auth()->user()->image) }}" alt="Img" >
@else
    <img src="{{ asset($websiteConfig->main_logo) }}" alt="Img"  >
@endif
								</span>
								<div>
									<h6 class="fw-medium">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
									<p>Admin</p>
								</div>
							</div>
							<a class="dropdown-item" href="{{ route('admin.admin_user.myprofile', Auth::id()) }}"><i class="ti ti-user-circle me-2"></i>MyProfile</a>
							 
							<a class="dropdown-item" href=""><i class="ti ti-settings-2 me-2"></i>Change Password</a>
							<hr class="my-2">
<a href="#" onclick="event.preventDefault();
    fetch('{{ route('logout') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    }).then(() => window.location.href='{{ route('login') }}');">
    <i class="ti ti-logout fs-16 me-2"></i><span>Logout</span>
</a>

						</div>
					</li>
				</ul>
				<!-- /Header Menu -->

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
						aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{ route('admin.admin_user.myprofile', Auth::id()) }}">My Profile</a>
						<a class="dropdown-item" href=" ">Change Password</a>
						<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
			</div>
		</div>