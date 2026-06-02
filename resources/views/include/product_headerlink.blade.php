 <meta charset="UTF-8">
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

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!--========== title  =================-->
    <title>{{$websiteConfig->companyName}} - {{$websiteConfig->tagline}}</title>
    
    <!-- Plugins CSS File -->
  
   <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/magnific-popup.css')}}">
    <!-- Main CSS File -->
  <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/skin.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/main.css')}}">
     <link rel="stylesheet" href="{{asset('web/css/nouislider.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/custom.css')}}">


<!--====== Google Fonts ======-->
@php
    $fonts = [];
    if(!empty($websiteConfig->heading_font_style)) {
        $fonts[] = 'family=' . urlencode($websiteConfig->heading_font_style);
    }
    if(!empty($websiteConfig->text_font)) {
        $fonts[] = 'family=' . urlencode($websiteConfig->text_font);
    }
    if(!empty($websiteConfig->menu_font)) {
        $fonts[] = 'family=' . urlencode($websiteConfig->menu_font);
    }
@endphp

@if(count($fonts))
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?{{ implode('&', $fonts) }}&display=swap" rel="stylesheet">
@else
    <!-- Default theme font (Poppins with full weights) -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
@endif



  <link rel="stylesheet" href="{{ url('/dynamic.css') }}">