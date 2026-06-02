
<!DOCTYPE html>
<html class="no-js" lang="en">


@include('headerlink')
<body>
@include('head')
<main class="main">
     <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Pages
                    <span></span> Login / Register
                </div>
            </div>
        </div>


         <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
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
                            <div class="col-lg-5">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Login</h3>
                                        </div>
                                       <form method="POST" action="{{ route('user.login.post') }}">
                                                 @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="username" required placeholder="Your Username">
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-muted" href="#">Forgot password?</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Log in</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Create an Account</h3>
                                        </div>
                                        <p class="mb-50 font-sm">
                                            Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy
                                        </p>
<form method="POST" action="{{ route('user.register') }}">
    @csrf

    <div class="form-group">
        <input type="text" name="first_name" required placeholder="First Name">
    </div>

    <div class="form-group">
        <input type="text" name="last_name" required placeholder="Last Name">
    </div>

    <div class="form-group">
        <input type="text" name="username" required placeholder="Username">
    </div>

    <div class="form-group">
        <input type="email" name="email" required placeholder="Email">
    </div>

    <div class="form-group">
        <input type="text" name="phone" required placeholder="Phone Number">
    </div>

    <div class="form-group">
        <input type="password" name="password" required placeholder="Password">
    </div>

    <div class="form-group">
        <input type="password" name="password_confirmation" required placeholder="Confirm Password">
    </div>

    <div class="login_footer form-group">
        <div class="chek-form">
            <div class="custome-checkbox">
                <input class="form-check-input" type="checkbox" name="terms" id="exampleCheckbox12" required>
                <label class="form-check-label" for="exampleCheckbox12">
                    <span>I agree to terms &amp; Policy.</span>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-fill-out btn-block hover-up">Submit & Register</button>
    </div>
</form>

                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


</main>

@include('footer')
 </body>

</html>