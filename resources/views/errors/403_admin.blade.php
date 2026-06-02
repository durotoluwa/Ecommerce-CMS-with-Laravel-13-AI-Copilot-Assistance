
<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.headerlink')
    
</head>

<body>
<div class="page-wrapper">
<header class="header header-6">
@include('include.headtop')
@include('include.headbottom')    
</header>
<!--========= End .header ============-->
<main class="main">
       
	<div class="error-content text-center" style="background-image: url(assets/images/backgrounds/error-bg.jpg)">
            	<div class="container">
            		<h1 class="error-title">Error 403</h1><!-- End .error-title -->
            		<p>Access Denied</p>
            		<a href="{{ route('login') }}" class="btn btn-outline-primary-2 btn-minwidth-lg">
            			<span>BACK TO ADMIN LOGIN PAGE</span>
            			<i class="icon-long-arrow-right"></i>
            		</a>
            	</div><!-- End .container -->
        	</div><!-- End .error-content text-center -->


   </main><!--End .main-->
@include('footer')   
@include('include.footerlink')
 
</body>
</html>