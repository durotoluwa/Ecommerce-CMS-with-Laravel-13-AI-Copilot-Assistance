
<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">

<head>
@include('admin.include.headelink')
	
<style>


.image-frame2 {
    width: 200px;
    height: 200px;
    padding: 20px;
    border:2px dotted #dde0de;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0;
    position: relative;
    cursor: pointer;
}

.image-frame2 img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.image-frame2 input[type="file"] {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
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
							 <h4 class="fw-bold">Manage Items for: {{ $menu->name }}</h4>
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
<a href="{{ route('menu-items.create', $menu) }}" class="btn btn-primary mb-3"> <i class="bi bi-plus-circle"></i> Add Item</a>
<div class="table-responsive product-list">
    <ul id="menu-list" class="list-group">
                @foreach($items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $item->id }}">
                        <div>
                            <strong>{{ $item->title }}</strong>
                            <small class="text-muted ms-2">{{ $item->url }}</small>
                        </div>
                        <div>
                            <a href="{{ route('menu-items.edit', $item) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('menu-items.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
</div>

</div>


</div></div> <!----end of card-body--->
</div><!--====== end of roe =========--->






	</div></div></div>
    <!--=======end of content and page-wrapper========-->

 
 


	@include('admin.include.footer')

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>


    <script>
    new Sortable(document.getElementById('menu-list'), {
        animation: 150,
        onEnd: function () {
            let order = [];
            document.querySelectorAll('#menu-list li').forEach((el, index) => {
                order.push({id: el.dataset.id, order: index});
            });
            fetch('{{ route('menu-items.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(order)
            });
        }
    });
</script>
</body>
</html>