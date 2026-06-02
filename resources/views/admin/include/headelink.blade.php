<!-- Meta Tags -->
	<meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <meta name="description" content="{{$websiteConfig->description}}">
    <meta name="keywords" content="{{$websiteConfig->keywords}}">
    <meta name="author" content="{{$websiteConfig->companyName}}">
    <meta name="robots" content="index, follow">  
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!--========= Open Graph (Facebook) Meta Tags ====================-->
    <meta property="og:title" content="{{$websiteConfig->companyName}}">
    <meta property="og:description" content="{{$websiteConfig->description}}">
    <meta property="og:type" content="website"> 
    <meta property="og:url" content="{{$websiteConfig->website_url}}">
    <meta property="og:image" content="{{ asset($websiteConfig->seo_image) }}">  
    <meta property="og:site_name" content="{{$websiteConfig->companyName}}">
    <meta property="og:locale" content="en_US">  

    <!--================ X Card Meta Tags ============================-->
    <meta name="twitter:card" content="summary_large_image">  
    <meta name="twitter:site" content="@YourTwitterHandle">  
    <meta name="twitter:title" content="{{$websiteConfig->companyName}}">
    <meta name="twitter:description" content="{{$websiteConfig->description}}">
    <meta name="twitter:image" content="{{ asset($websiteConfig->seo_image) }}"> 

          <!--========== title  =================-->
    <title>{{$websiteConfig->companyName}} - {{$websiteConfig->tagline}}</title>
	<script src="assets/js/theme-script.js" type="43f886112157b1b3b6c54490-text/javascript"></script>	

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
<!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css" integrity="sha512-M5Kq4YVQrjg5c2wsZSn27Dkfm/2ALfxmun0vUE3mPiJyK53hQBHYCVAtvMYEC7ZXmYLg8DVG4tF8gD27WmDbsg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Tabler Icon CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.34.0/tabler-icons.min.css" integrity="sha512-MsO/oEO313SeWk87bUIzVZBnm8v7BK0/02G6e1YaJd6D1/yM7+rLASTnKpnbV8Qf9mrOxVN+o5REX2ix85FyJw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	 
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href=" {{ asset('admin/assets/css/bootstrap.min.css') }}">

<!-- Datatable CSS -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap5.min.css') }} ">


	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href=" {{ asset('admin/assets/css/bootstrap-datetimepicker.min.css') }}">

	<!-- animation CSS -->
	<link rel="stylesheet" href=" {{ asset('admin/assets/css/animate.css') }}">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href=" {{ asset('admin/assets/css/select2.min.css') }}">

	<!-- Daterangepikcer CSS -->
	<link rel="stylesheet" href=" {{ asset('admin/assets/css/daterangepicker.css') }}">



	<!-- Color Picker Css -->
	<link rel="stylesheet" href=" {{ asset('admin/assets/css/nano.min.css') }}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}" >
    <!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right", // or toast-bottom-right, etc.
    };
</script>