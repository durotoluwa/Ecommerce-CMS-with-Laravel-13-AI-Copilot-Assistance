
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
 <form action="{{ route('menu-items.store', $menu) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Item Title</label>
                    <input type="text" name="title" id="title" 
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" placeholder="Enter item title">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">Item URL</label>
                    <input type="text" name="url" id="url" 
                           class="form-control @error('url') is-invalid @enderror"
                           value="{{ old('url') }}" placeholder="/link-or-route">
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent Item (optional)</label>
               <select name="parent_id" id="parent_id" class="form-select">
    <option value="">-- None --</option>
    @foreach($parents as $parent)
        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
            {{ $parent->title }}
        </option>
    @endforeach
</select>

                </div>

                <div class="mb-3">
                    <label for="extra" class="form-label">Extra (Mega Menu JSON)</label>
                    <textarea name="extra" id="extra" class="form-control" rows="3"
                              placeholder='{"description":"Shown in mega menu"}'>{{ old('extra') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Save Item
                </button>
            </form>

</div>


</div></div> <!----end of card-body--->
</div><!--====== end of roe =========--->






	</div></div></div>
    <!--=======end of content and page-wrapper========-->

 
 
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

	@include('admin.include.footer')

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

</body>
</html>