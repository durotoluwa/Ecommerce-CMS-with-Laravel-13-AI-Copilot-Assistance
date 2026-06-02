
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
@include('slider') 
@include('actionbox') 
 @include('midbanner') 
@include('productsectionone') 
@include('midbanner2')
@include('producttab')
@include('testimonysection')
@include('blog-section')
</main><!--End .main-->
@include('footer')   
@include('include.footerlink')
 
</body>
</html>