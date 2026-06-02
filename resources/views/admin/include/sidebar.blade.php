<div class="sidebar" id="sidebar">
			<!-- Logo -->
			<div class="sidebar-logo active">
				<a href="">
    @if(!empty($websiteConfig->main_logo))
        <img src="{{ asset($websiteConfig->main_logo) }}" alt="Img" width="70px" height="70px">
    @else
        <img src="{{ asset('admin/assets/image/logo.png') }}" alt="Img" width="70px" height="70px">
    @endif
</a>

				<a href="" class="logo logo-white">
				 
				</a>


				<a href="" class="logo-small">
    @if(!empty($websiteConfig->main_logo))
        <img src="{{ asset($websiteConfig->main_logo) }}" alt="Img" width="50px" height="50px">
    @else
        <img src="{{ asset('admin/assets/image/logo.png') }}" alt="Img" width="70px" height="70px">
    @endif
</a>



				<a href="" class="logo-small-white">
				 	 
				</a>
				<a id="toggle_btn" href="javascript:void(0);">
					<i data-feather="chevrons-left" class="feather-16"></i>
				</a>
			</div>
			<!-- /Logo -->
 


<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
	<ul>
<li class="submenu-open">
<h6 class="submenu-hdr">Main</h6>
<ul>
<li><a href="{{ route('admin.dashboard') }}"><i class="ti ti-layout-grid fs-16 me-2"></i><span>Dashboard</span></a></li>
			
		
			
@can('assign role and permission')
<li class="submenu">
    <a href="javascript:void(0);">
        <i class="ti ti-user-edit fs-16 me-2"></i>
        <span>Role & Permission</span>
        <span class="menu-arrow"></span>
    </a>
    <ul>
        <li><a href="{{ route('permissions.index') }}">Permission</a></li>
        <li><a href="{{ route('user_permissions.index') }}">User Permissions</a></li>
		   
    </ul>

</li>
@endcan

@can('payment settings')
		<li class="submenu">
<a href="javascript:void(0);">
 
	<i class="fa-brands fa-cc-stripe fs-16 me-2"></i>
	<span>Payment settings</span><span class="menu-arrow"></span></a>
<ul>
<li><a href="{{ route('admin.payment.paystack') }}">Paysatck Settings</a></li>
<li><a href="{{ route('admin.currencies.index') }}">Currency Switcher</a></li>
</ul>
</li>
@endcan


@can('website configuration')
<li class="submenu">
<a href="javascript:void(0);"><i class="ti ti-brand-apple-arcade fs-16 me-2"></i><span>Configuration</span><span class="menu-arrow"></span></a>
	<ul>
								 
          <li>
            <a href="{{ route('admin.configuration.websiteLogo') }}">Website Logo</a>
          </li>

          <li>
            <a href="{{ route('admin.configuration.websitecolor') }}">Website Color</a>
          </li>

          
          <li>
            <a href="{{ route('admin.configuration.contact') }}"> Contact Information</a>
          </li>
 <li>
            <a href="{{ route('admin.configuration.seopage') }}"> Main SEO</a>
          </li>
          

          <li>
            <a href="{{ route('admin.configuration.footer') }}"> footer</a>
          </li>

		   <li>
            <a href="{{ route('admin.footer.edit') }}"> footer Settings</a>
          </li>

		 
          

          <li>
            <a href="{{ route('admin.configuration.cookie') }}">Cookie Consent</a>
          </li>
          
          <li>
            <a href="{{ route('admin.configuration.errorpage') }}">Error Page</a>
          </li>

          <li>
            <a href="{{ route('admin.configuration.breadcrumb') }}">Breadcrumb Image</a>
          </li>

          <li>
            <a href="{{ route('admin.configuration.avatar') }}">Default Avatar</a>
          </li>

          <li>
            <a href="{{ route('admin.configuration.maintenance') }}">Maintenance mode</a>
          </li>

          <li>
            <a href="{{ route('admin.configuration.tawkto') }}">Tawk Chat</a>
          </li>
			</ul>
	</li>
	@endcan


 
   			 </ul>
			</li>  
<!--========================== end of main ===================--->
@can('homepage section')
<li class="submenu-open">
<h6 class="submenu-hdr">Pages & Posts</h6>
<ul>

<li class="submenu">
<a href="javascript:void(0);">
 
<i class="fa-solid fa-blog fs-16 me-2"></i>
	
	<span>Post </span><span class="menu-arrow"></span></a>
<ul>
 
 <li><a href="{{ route('blog.create') }}">Add Post</a></li>
<li><a href="{{ route('blog.index') }}">All Post</a></li> 
  <li><a href="{{ route('blog_category.index') }}">Post Category</a></li> 
</ul>
</li>


<li class="submenu">
<a href="javascript:void(0);">
 
<i class="fa-brands fa-hive fs-16 me-2"></i>
	
	<span>Pages </span><span class="menu-arrow"></span></a>
<ul>
 
 <li><a href="{{ route('pages.index') }}">All Pages</a></li> 
<li><a href="{{ route('pages.create') }}">Add Page</a></li>
  
</ul>
</li>


<li class="submenu">
<a href="javascript:void(0);">
 
<i class="fa-brands fa-hive fs-16 me-2"></i>
	
	<span>Testimonies </span><span class="menu-arrow"></span></a>
<ul>
 <li><a href="{{ route('testimonies.create') }}">Add New</a></li>
 <li><a href="{{ route('testimonies.index') }}">All Testimonies</a></li> 

  
</ul>
</li>

</ul>
</li>
@endcan	
<!--========================== end of Blog  ===================--->




@can('homepage section')
<li class="submenu-open">
<h6 class="submenu-hdr">Appearance</h6>
<ul>




<li class="submenu">
<a href="javascript:void(0);">
 
<i class="fa-solid fa-image fs-16 me-2"></i>
	<span>Banner Slider </span><span class="menu-arrow"></span></a>
<ul>


<li><a href="{{ route('banner_sliders.create') }}">Create Slide</a></li> 
<li><a href="{{ route('banner_sliders.index') }}">All Slide</a></li>  
 

</ul>
</li>

<li class="submenu">
<a href="javascript:void(0);">
 
<i class="fa-solid fa-laptop fs-16 me-2"></i>
<span>Homepage Section</span><span class="menu-arrow"></span></a>
<ul>
<li><a href="{{ route('admin.homepage.header_top') }}">Header Top</a></li> 
<li><a href="{{ route('menus.index') }}">Menu Settings</a></li> 
<li><a href="{{ route('admin.homepage.actionbox') }}">Action Box Section</a></li> 
<li><a href="{{ route('admin.homepage.sectionbanner') }}">Mid Banner Section</a></li>  
<li><a href="{{ route('admin.homepage.categorysection') }}">Category Section</a></li>  
<li><a href="{{ route('admin.homepage.product_section_one') }}">Product Section 1</a></li> 
<li><a href="{{ route('admin.homepage.sectionbanner2') }}">Card Box Section</a></li> 
<li><a href="{{ route('admin.homepage.producttab') }}">Product Tab Section</a></li>
<li><a href="{{ route('admin.homepage.testimonysection') }}">Testimony Section</a></li>
<li><a href="{{ route('admin.homepage.blogsection') }}">Blog  Section</a></li>

</ul>
</li>

</ul></li>
@endcan
<!--========================== end of Appearance  ===================--->
@can('product section')
<li class="submenu-open">
<h6 class="submenu-hdr">Product</h6>
<ul>
	<li class="submenu">
<a href="javascript:void(0);">
 
<i class="fa-solid fa-basket-shopping fs-16 me-2"></i>
<span>Product</span><span class="menu-arrow"></span></a>
				 
								<ul>
								<li><a href="{{ route('admin.products.index') }}"><i data-feather="box"></i><span>Products</span></a></li>
								<li><a href="{{ route('admin.products.create') }}"><i class="ti ti-table-plus fs-16 me-2"></i><span>Create Product</span></a></li>
								<li><a href="{{ route('admin.products.create') }}"><i class="ti ti-table-plus fs-16 me-2"></i><span>Upload Product</span></a></li>
								<li><a href="{{ route('admin.products.import') }}"><i class="ti ti-table-plus fs-16 me-2"></i><span>Import Product</span></a></li>

								
								<!---
								<li><a href="{{ route('admin.tags.index') }}"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Tags</span></a></li>--->
								<li><a href="{{ route('admin.brands.index') }}"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Brands</span></a></li>
								<li><a href="{{ route('admin.product_categories.index') }}"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Category</span></a></li>
								<li><a href="{{ route('admin.attributes.index') }}"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Attributes</span></a></li>

								<li><a href="{{ route('coupons.create') }}"><i class="ti ti-progress-alert fs-16 me-2"></i><span>Coupon</span></a></li>
						
							</ul>
						</li>


 
</ul>
</li>
@endcan
<!--========================== end of Product  ===================--->


@can('product section')
<li class="submenu-open">
<h6 class="submenu-hdr">Manage Shipping</h6>
<ul>
	<li class="submenu">
<a href="javascript:void(0);">
 
<i class="fa-solid fa-truck-fast fs-16 me-2"></i>
<span>Manage Shipping</span><span class="menu-arrow"></span></a>
				 
								<ul>
								<li><a href="{{ route('admin.zones.index') }}"><i data-feather="box"></i><span> Shipping Zone</span></a></li>
						 
							 
							</ul>
						</li>


 
</ul>
</li>
@endcan
<!--========================== end of Product  ===================--->

@can('view order')
<li class="submenu-open">
<h6 class="submenu-hdr">Customer & order</h6>
<ul>	

 <li class="submenu">
<a href="javascript:void(0);">
 
<i class="fa-solid fa-list fs-16 me-2"></i>
<span>Customer Order</span><span class="menu-arrow"></span></a>
<ul>
<li><a href="{{ route('admin.product_orders.index') }}"><i class="ti ti-stack-3 fs-16 me-2"></i><span>Orders</span></a></li>
<li><a href="{{ route('admin.product_orders.pending_product') }}"><i class="ti ti-stairs-up fs-16 me-2"></i><span>Pending Orders</span></a></li>
<li><a href=" "><i class="ti ti-stack-pop fs-16 me-2"></i><span>Customer List</span></a></li>
</ul>
</li>

</ul>
</li>	
@endcan	
<!--========================== end of Product  ===================--->



<!--========================== end of Product  ===================--->
<li class="submenu-open">
<h6 class="submenu-hdr">Settings</h6>
<ul>	
 			
	@can('user management')	
 
 <li><a href="{{ route('admin.users.index') }}">
<i class="fa-solid fa-users fs-16 me-2"></i>
<span>Admin User</span></a> 
 </li>

@endcan	

 <li>
<a href="{{ route('admin.admin_user.myprofile', Auth::id()) }}">
    <i class="ti ti-stairs-up fs-16 me-2"></i>
    <span>My Profile</span>
</a>							<li>
								 
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
</li>	
<!--========================== end of Product  ===================--->
						 
							 
					</ul>
				</div>
			</div>
		</div>