
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
								<h4 class="fw-bold">Media Library</h4>
							 
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
						<div class="col-sm-12">

 <!-- Filters -->
    <div class="d-flex mb-3">
        <form method="GET" action="{{ route('admin.media.index') }}" class="d-flex w-100">
            <select name="type" class="form-select me-2">
                <option value="">All media items</option>
                <option value="image">Images</option>
                <option value="video">Videos</option>
                <option value="pdf">Documents</option>
            </select>

            <select name="date" class="form-select me-2">
                <option value="">All dates</option>
                @foreach($dates as $date)
                    <option value="{{ $date }}">{{ $date }}</option>
                @endforeach
            </select>

            <input type="text" name="search" class="form-control me-2" placeholder="Search media">
            <button class="btn btn-primary">Filter</button>
        </form>
    </div>

    <!-- Bulk select -->
    <form method="POST" action="{{ route('admin.media.bulkDelete') }}">
        @csrf
        <button type="submit" class="btn btn-danger mb-3">Delete Selected</button>

        <!-- Media Grid -->
        <div class="row">
            @foreach($mediaItems as $media)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <input type="checkbox" name="selected[]" value="{{ $media->id }}" class="form-check-input m-2">
                        <img src="{{ $media->getUrl() }}" class="card-img-top" alt="media">
                        <div class="card-body">
                            <p class="card-text">{{ $media->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </form>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $mediaItems->links() }}
    </div>
</div>





                        </div></div>





	</div></div></div>
    <!--=======end of content and page-wrapper========-->

    

  


	@include('admin.include.footer')

    
</body>
</html>