<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
  <!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Dreams POS is a powerful Bootstrap based Inventory Management Admin Template designed for businesses, offering seamless invoicing, project tracking, and estimates.">
	<meta name="keywords" content="inventory management, admin dashboard, bootstrap template, invoicing, estimates, business management, responsive admin, POS system">
	<meta name="author" content="Dreams Technologies">
	<meta name="robots" content="index, follow">
	<title>Dreams POS - Inventory Management & Admin Dashboard Template</title>

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

    </head>
    <body class="font-sans antialiased">
	 
<div id="main-wrapper">
        <div class="min-h-screen bg-gray-100">
       
            <!-- Page Content -->
            <main>
             @yield('content')
            </main>
        </div></div>



	<!-- jQuery -->
	<script src=" {{ asset('admin/assets/js/jquery-3.7.1.min.js') }}" ></script>

	<!-- Feather Icon JS -->
	<script src="{{ asset('admin/assets/js/feather.min.js') }}" ></script>

	<!-- Slimscroll JS -->
	<script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}" ></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}" ></script>

	<!-- ApexChart JS -->
	<script src="{{ asset('admin/assets/js/apexcharts.min.js') }}" ></script>
	<script src="{{ asset('admin/assets/js/chart-data.js') }}" ></script>

	<!-- Chart JS -->
	<script src="{{ asset('admin/assets/js/chart.min.js') }}" ></script>
	<script src="{{ asset('admin/assets/js/chart-data.js') }}" ></script>

  <!-- Datatable JS -->
        <script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }} " ></script>
        <script src="{{ asset('admin/assets/js/dataTables.bootstrap5.min.js') }}" ></script>


	<!-- Daterangepikcer JS -->
	<script src="{{ asset('admin/assets/js/moment.min.js') }}" ></script>
	<script src="{{ asset('admin/assets/js/daterangepicker.js') }}" ></script>

	<!-- Select2 JS -->
	<script src="{{ asset('admin/assets/js/select2.min.js') }}" ></script>

	<!-- Color Picker JS -->
	<script src="{{ asset('admin/assets/js/pickr.es5.min.js') }}" ></script>

	<!-- Custom JS -->
	<script src="{{ asset('admin/assets/js/theme-colorpicker.js') }}" ></script>
	<script src="{{ asset('admin/assets/js/script.js') }}" ></script>

<script src="{{ asset('admin/assets/js/rocket-loader.min.js') }}" ></script></body>


    </body>
</html>
