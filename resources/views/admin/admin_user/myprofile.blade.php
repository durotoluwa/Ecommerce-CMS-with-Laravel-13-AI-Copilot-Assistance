
<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>
@include('admin.include.headelink')
	
<style>


.profile-contentimg {
    position: relative;
    width: 50%;
    height: 100%;
    margin: 0 auto;
}

.profile-contentimg img {
    width: 150px;
    height:150px;
    object-fit: cover;
    border-radius: 50%; /* makes it circular */
    border: 3px solid #ddd; /* subtle border */
    box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* soft shadow */
    transition: transform 0.3s ease;
}

.profile-contentimg img:hover {
    transform: scale(1.05); /* slight zoom on hover */
}

.profileupload {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: #fff;
    border-radius: 50%;
    padding: 6px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.profileupload input[type="file"] {
    display: none; /* hide default file input */
}

.profileupload a img {
    width: 20px;
    height: 20px;
    cursor: pointer;
}



    </style>
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

<div id="product-page">
<div class="page-wrapper">
<div class="content">

 <div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
							 <h4>My Profile</h4>
       
							 
							</div>
						</div>
 </div>	 

  @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
					               

<div class="row">

<div class="card">
<div class="card-body">
 

<form action="{{ route('adminupdateprofile', $profileview->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')


 
       <div class="row" style="margin-bottom: 30px;">  
  <div class="profile-contentimg">
    <!-- Current profile image -->
    <img src="{{ asset('user/' . auth()->user()->image) }}" alt="img" id="blah">

    
    <!-- File input directly under the image -->
    <div class="profile-fileinput">
        <label for="imgInp" class="form-label">Upload New Image</label>
        <input type="file" id="imgInp" name="image" accept="image/*" class="form-control">
    </div>
</div>
       </div><!---end of row---->


 
  
    <div class="row">
    <div class="col-lg-6 col-sm-12">
    <div class="input-blocks">
    <label class="form-label">First Name</label>
    <input type="text" class="form-control" value="{{$profileview->first_name}}" name="first_name">
    </div>
    </div>
    <div class="col-lg-6 col-sm-12">
    <div class="input-blocks">
    <label class="form-label">Last Name</label>
    <input type="text" class="form-control" value="{{$profileview->last_name}}" name="last_name">
    </div>
    </div>

   <div class="col-lg-12 col-sm-12">
    <div class="input-blocks">
    <label class="form-label">Username</label>
    <input type="text" class="form-control" value="{{$profileview->username}}" name="username">
    </div>
    </div>



    <div class="col-lg-6 col-sm-12">
    <div class="input-blocks">
    <label>Email</label>
    <input type="email" class="form-control" value="{{$profileview->email}}" name="email">
    </div>
    </div>
    <div class="col-lg-6 col-sm-12">
    <div class="input-blocks">
    <label class="form-label">Phone</label>
    <input class="form-control" type="text" value="{{$profileview->phone}}" name="phone">
    </div>
    </div>
 
    
    <div class="col-12">
        <button type="submit" class="btn btn-submit me-2">Update</button>
     
   
    </div>
</form>

</div></div> <!----end of card-body--->
</div><!--====== end of roe =========--->

 

     
	@include('admin.include.footer')
 

</body>
</html>