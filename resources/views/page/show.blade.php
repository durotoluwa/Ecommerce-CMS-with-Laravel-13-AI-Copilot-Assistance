
<!DOCTYPE html>
<html lang="en">

<head>
    @include('include/headerlink')
    
</head>

<body>
<div class="page-wrapper">
<header class="header header-6">
@include('include/headtop')
@include('include/headbottom')    
</header>
<!--========= End .header ============-->
<main class="main">
          	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">   {{ $page->title }}</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
      <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href=" ">page</a></li>
            <li class="breadcrumb-item active" aria-current="page">
            {{ $page->title }}
            </li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->


<div class="page-content">
<div class="container">
<div class="row">




</div></div></div>

 </main><!--End .main-->
@include('footer')   
@include('include/footerlink')
 
</body>
</html>