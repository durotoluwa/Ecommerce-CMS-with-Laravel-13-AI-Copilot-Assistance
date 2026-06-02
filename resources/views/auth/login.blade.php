@extends('layouts.app')

@section('content')
<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper login-new">
                    <div class="row w-100">
                        <div class="col-lg-5 mx-auto">
                            <div class="login-content user-login">
                                <div class="login-logo">
@if(!empty($websiteConfig->main_logo) && file_exists(public_path($websiteConfig->main_logo)))
    <img src="{{ asset($websiteConfig->main_logo) }}" alt="Img" width="150">
    <a href="/" class="login-logo logo-white">
        <img src="{{ asset($websiteConfig->main_logo) }}" alt="Img">
    </a>
@else
    <img src="{{ asset('admin/assets/image/logo.png') }}" alt="Img" width="50">
    <a href="/" class="login-logo logo-white">
        <img src="{{ asset('admin/assets/image/logo.png') }}" alt="Img">
    </a>
@endif

                                </div>
<form method="POST" action="{{ route('login') }}" class="mx-auto" style="max-width: 400px;">
@csrf
<div class="card">
<div class="card-body p-5">
<div class="login-userheading">
<h3>Sign In</h3>
                                                                         

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

 
</div>
<div class="mb-3">
                                                <label class="form-label">Username <span class="text-danger"> *</span></label>
                                                <div class="input-group">
                              <input type="text" name="username" class="form-control border-end-0">
                                                    
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                  
                                                <label class="form-label">Password <span class="text-danger"> *</span></label>
                                                <div class="pass-group">
                                                     <input name="password" type="password" class="pass-input form-control">
                                                  
                                                    <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                                                </div>
                                            </div>
                                            <div class="form-login authentication-check">
                                                <div class="row">
                                                    <div class="col-12 d-flex align-items-center justify-content-between">
                                                        <div class="custom-control custom-checkbox">
                                                            <label class="checkboxs ps-4 mb-0 pb-0 line-height-1 fs-16 text-gray-6">
                                                                <input type="checkbox" class="form-control">
                                                                <span class="checkmarks"></span>Remember me
                                                            </label>
                                                        </div>
                                                        <div class="text-end">
                                                            <a class="text-orange fs-16 fw-medium" href="forgot-password-3.html">Forgot Password?</a>
                                                        </div>
                                                    </div>                                    
                                                </div>
                                            </div>
                                            <div class="form-login">
                                                <button type="submit" class="btn btn-primary w-100">Sign In</button>
                                            </div>
                                         
                                          
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                           <p>Copyright &copy; {{ now()->year }} {{ $websiteConfig->companyName }}. All rights reserved.</p>

                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </div>
		<!-- /Main Wrapper -->
@endsection
