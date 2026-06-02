
<!DOCTYPE html>
<html lang="en">
 @include('admin.headerlink')

<body>
  <style>
 
    #menu-items {
      list-style: none;
      padding-left: 0;
    }
    .menu-item {
      margin: 8px 0;
      border: 1px solid #dcdcdc;
      background: #f8f9fa;
    }
    .menu-handle {
      padding: 12px;
      font-weight: 600;
      cursor: move;
      user-select: none;
    }
    .menu-item > ul {
      list-style: none;
      margin-left: 18px;
      padding-left: 12px;
      border-left: 2px dashed #ccc;
    }
    .sortable-placeholder {
      border: 2px dashed #999;
      height: 40px;
      margin: 8px 0;
      background: #f0f0f0;
    }
  </style>
 

	<div id="main-wrapper">
<!--================--Nav header start ================-->
@include('admin.navheader')


 <!--================--Header end ================-->
        <!----------================--Sidebar start ================-->
@include('admin.sidebar')
        <!-------================--Sidebar end ================-->
<!--============== Container starts=================-->
 <div class="content-body">
  <div class="container-fluid">
  
    <!--=====================  Page Title Start Here =====================-->
    <div class="page-titles">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="">Create Parent Menu</a>
          </li>
        </ol>
      </div>
      <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @elseif(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
 <!--=====================  end Page Title Start Here =====================-->
 
<div class="row">


<div class="col-xl-3">
<div class="card h-auto">
<div class="card-body">
<h5>Property Page Link</h5>
<p>To create a Porperty page menu, you can use the following link. 
   </p>

<ul style="list-style-type: circle; padding-left: 0; line-heiqht: 1.8;">
  @foreach ($propertyType as $data)
<li><i class="fa-solid fa-square" style="color: red; padding-right:20px;"></i>property_page/{{$data->slug}}</li>
  @endforeach 
</ul>
</div></div></div>


<div class="col-xl-3">
<div class="card h-auto">
<div class="card-body">
<h5>Service Page Link</h5>
<p>To create a service page menu, you can use the following link. 
   </p>

<ul style="list-style-type: circle; padding-left: 0; line-heiqht: 1.8;">
  @foreach ($services as $service)
<li><i class="fa-solid fa-square" style="color: red; padding-right:20px;"></i>service_page/{{$service->slug}}</li>
  @endforeach 
</ul>
</div></div></div>


<div class="col-xl-3">
<div class="card h-auto">
<div class="card-body">
<h5>Custom Page Link</h5>
<p>To create a custom page menu, you can use the following link. 
 </p>
<ul style="list-style-type: circle; padding-left: 0; line-heiqht: 1.8;">
  @foreach ($custompages as $page)
<li><i class="fa-solid fa-square" style="color: red; padding-right:20px;"></i>custom_page/{{$page->slug}}</li>
  @endforeach 
</ul>
</div></div></div>




<div class="col-xl-3">
<div class="card h-auto">
<div class="card-body">
<h5>Other Page Link</h5>
<p>To create a other page menu, you can use the following link:</p>
<ul style="list-style-type: circle; padding-left: 0; line-heiqht: 1.8;">
  
  <li><i class="fa-solid fa-square" style="color: red; padding-right:20px;"></i>blog_post</li>

<li><i class="fa-solid fa-square" style="color: red; padding-right:20px;"></i>faq_page</li>

 <li><i class="fa-solid fa-square" style="color: red; padding-right:20px;"></i>our_team</li>
  <li><i class="fa-solid fa-square" style="color: red; padding-right:20px;"></i>contact</li>
  <!---
  <li><i class="fa-solid fa-square" style="color: red; padding-right:20px;"></i>industry_we_serve</li>
  <li><i class="fa-solid fa-square" style="color: red; padding-right:20px;"></i>career_page</li>-->
</ul>
</div></div></div>

</div><!---end of row ----->



 <div class="row">
<div class="col-xl-12">
<div class="card h-auto">
<div class="card-body">
 <form method="POST" action="{{ route('menu.items.store') }}">
    @csrf


<div class="row">
<div class="col-md-6">
<div class="mb-3">
    <label class="form-label">Menu Title</label>
       <input class="form-control"  type="text" name="label" id="label" required>
</div></div>

    <div class="col-md-6">
<div class="mb-3">
    <label class="form-label">Menu Link</label>
    <input class="form-control" type="text" name="link" id="link" required>
   </div></div>

 </div><!--===== Row Ends =====-->

  <button type="submit" class="btn btn-sm btn-primary mb-4 open">Create Menu</button>
</form>

<ul id="menu-items">
    @foreach($menuItems as $item)
        @include('admin.menu.partials.menu-item', ['item' => $item])
    @endforeach
</ul>


  <button id="save-order" class="btn btn-sm btn-primary mb-4 open">Save Menu</button>
</div><!--=== Card Body Ends ====-->
</div><!--==== Card Ends =======-->
</div><!--===== Col Ends =====-->
</div><!--===== Row Ends =====-->
        


</div><!--==== Container-fluid Ends ======-->
</div> <!--========= Container Ends ========-->
<script src="{{asset('assets/js/global.min.js')}}"></script>
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI (must come after jQuery) -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- ✅ Correct nestedSortable plugin -->

<script src="{{asset('assets/js/jquery.mjs.nestedSortable.js')}}"></script>
<script>
$(function() {
  if (typeof $.fn.nestedSortable === 'undefined') {
    alert('nestedSortable did not load');
    return;
  }

  // Initialize nestedSortable
  $('#menu-items').nestedSortable({
    handle: '.menu-handle',
    items: 'li',
    listType: 'ul',
    toleranceElement: '> .menu-handle',
    maxLevels: 5,
    isTree: true,
    expandOnHover: 700,
    startCollapsed: false,
    forcePlaceholderSize: true,
    placeholder: 'sortable-placeholder',
    opacity: 0.9,
    revert: 200
  });

  // Save order
  $('#save-order').on('click', function () {
    const order = [];
    $('#menu-items li').each(function (index) {
      order.push({
        id: $(this).data('id'),
        parent: $(this).parent().closest('li').data('id') || null,
        sort: index + 1
      });
    });

    $.post("{{ route('menu.items.reorder') }}", {
      _token: "{{ csrf_token() }}",
      order: order
    }).done(function () {
      alert('Menu order saved!');
    });
  });

  // Delete item
  $(document).on('click', '.delete-menu-item', function () {
    const itemId = $(this).data('id');

    if (confirm('Are you sure you want to delete this menu item?')) {
$.ajax({
  url: "{{ url('menu/items') }}/" + itemId,
  type: 'DELETE',
  data: {
    _token: "{{ csrf_token() }}"
  },
  success: function () {
    $('li[data-id="' + itemId + '"]').remove();
    alert('Menu item deleted!');
  },
  error: function () {
    alert('Failed to delete menu item.');
  }
});

    }
  });
});
</script>

 
<script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>

 <script src="{{asset('assets/js/apexchart.js')}}"></script>
<script src="{{asset('assets/js/chart.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.peity.min.js')}}"></script>
	 
 <script src="{{asset('assets/js/dashboard-1.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/custom.min.js')}}"></script>
<script src="{{asset('assets/js/dlabnav-init.js')}}"></script>
<script src="{{asset('assets/js/demo.js')}}"></script>

	 
</body>

</html>