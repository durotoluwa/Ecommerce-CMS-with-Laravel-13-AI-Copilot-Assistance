
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
								<h4 class="fw-bold">Edit {{ old('title', $page->title) }} Page</h4>
							 
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
					               
<form action="{{ route('pages.update', $page->id) }}" method="post" enctype="multipart/form-data">
        @csrf @method('PUT')
<div class="row">
<div class="col-sm-8">

  <!-- Post URL link -->
    <div class="alert alert-info mb-3">
        Public URL: 
        <a href="{{ route('page.show', $page->slug) }}" target="_blank">
            {{ route('page.show', $page->slug) }}
        </a>
    </div>



        <!-- Post Content Card -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Post Title</label>
                        <input class="form-control" type="text" name="title"
                               value="{{ old('title', $page->title) }}" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Post Content</label>
                        <textarea id="editor2" name="content" class="form-control">{{ old('content', $page->content) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Card -->
        <div class="card mb-3">
            <div class="card-header"><strong>SEO</strong></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">SEO Keywords</label>
                    <input type="text" name="seo_keywords" id="seoKeywords" class="form-control"
                           value="{{ old('seo_keywords', $page->seo_keywords) }}"
                           placeholder="e.g. online course, web development">
                    <p class="text-muted small">Comma-separated keywords to help search engines understand your post.</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">SEO Title</label>
                    <input type="text" name="seo_title" id="seoTitle" class="form-control"
                           value="{{ old('seo_title', $page->seo_title ?? $page->title) }}"
                           placeholder="Enter SEO Title">
                    <p class="text-muted small">This title appears in search engine results.</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">SEO Description</label>
                    <textarea maxlength="160" name="seo_description" id="seoDescription" class="form-control" rows="3">{{ old('seo_description', $page->seo_description) }}</textarea>
                    <p class="text-muted small">Keep it under 160 characters for best results.</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Google SEO Web Preview</label>
                    <x-seo-preview 
                        :title="old('seo_title', $page->seo_title ?? $page->title)" 
                        :description="old('seo_description', $page->seo_description)" 
                        :keywords="old('seo_keywords', $page->seo_keywords)" 
                        :slug="$page->id" 
                    />
                </div>
            </div>
        </div>


</div>

	<div class="col-sm-4">
        <!-- Status Card -->
        <div class="card mb-3">
            <div class="card-header"><strong>Status</strong></div>
            <div class="card-body">
                @foreach(['active' => 'Active', 'pending' => 'Pending Review', 'draft' => 'Draft'] as $value => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status-{{ $value }}" value="{{ $value }}"
                               {{ old('status', $page->status) === $value ? 'checked' : '' }}>
                        <label class="form-check-label" for="status-{{ $value }}">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Publish Card -->
        <div class="card mb-3">
            <div class="card-header"><strong>Publish</strong></div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="publish_type" id="publish-now" value="immediately"
                           {{ old('publish_type', $page->publish_type) === 'immediately' ? 'checked' : '' }}>
                    <label class="form-check-label" for="publish-now">Immediately</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="publish_type" id="publish-schedule" value="schedule"
                           {{ old('publish_type', $page->publish_type) === 'schedule' ? 'checked' : '' }}>
                    <label class="form-check-label" for="publish-schedule">Schedule</label>
                </div>

                <div class="mt-2 {{ old('publish_type', $page->publish_type) === 'schedule' ? '' : 'd-none' }}" id="publish-date-wrapper">
                    <label for="publish-date">Publish Date:</label>
                    <input type="datetime-local" class="form-control" name="publish_date" id="publish-date"
                        value="{{ old('publish_date', $page->publish_date ? date('Y-m-d\TH:i', strtotime($page->publish_date)) : '') }}">

                </div>

                <div class="row mt-3">
                    <div class="col-lg-9">
                        <button type="submit" class="btn btn-sm btn-primary mb-4 open">Update Post</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Image Card -->
        <div class="card mb-3">
            <div class="card-header"><strong>Featured Image</strong></div>
            <div class="card-body">
                @if($page->featured_image)
                    <div id="featured-preview" class="mb-2">
                        <img src="{{ $page->featured_image }}" alt="Featured Image" style="max-width:300px;">
                    </div>
                @endif
                <div>
                    <label class="btn btn-link p-0" for="featured_image">Change featured image</label>
                    <input type="file" name="featured_image" id="featured_image" class="d-none" accept=".jpg,.jpeg,.png,.gif">
                </div>
            </div>
        </div>

       
    </form>
</div><!--====== end of row =========--->






	</div></div></div>
    <!--=======end of content and page-wrapper========-->



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    console.log("All scripts initialized");

    /* =====================================
       HELPER
    ===================================== */
    const get = (id) => document.getElementById(id);

    /* =====================================
       THUMBNAIL PREVIEW (GLOBAL)
    ===================================== */
    window.previewThumbnail = function(event) {
        const preview = get('thumbnail-preview');
        if (!preview) return;

        preview.innerHTML = '';
        const file = event.target.files[0];

        if (file) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.maxWidth = '100%';
            img.style.maxHeight = '100%';
            preview.appendChild(img);
        }
    };

    /* =====================================
       FEATURED IMAGE PREVIEW
    ===================================== */
    const featuredInput = get('featured_image');
    const featuredPreview = get('featured-preview');

    if (featuredInput && featuredPreview) {
        featuredInput.addEventListener('change', function (e) {
            featuredPreview.innerHTML = '';

            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.width = 150;
                img.classList.add('me-2','mb-2','border');
                featuredPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }

    
    /* =====================================
       PUBLISH DATE TOGGLE
    ===================================== */
    const scheduleRadio = get('publish-schedule');
    const nowRadio = get('publish-now');
    const dateWrapper = get('publish-date-wrapper');

    if (scheduleRadio && nowRadio && dateWrapper) {

        function toggleDate() {
            dateWrapper.classList.toggle('d-none', !scheduleRadio.checked);
        }

        scheduleRadio.addEventListener('change', toggleDate);
        nowRadio.addEventListener('change', toggleDate);

        toggleDate(); // run on load
    }

    

});
</script>

  
  <script>
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
  </script>

    <script>
    ClassicEditor
      .create(document.querySelector('#editor2'))
      .catch(error => {
        console.error(error);
      });
  </script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('seoTitle');
    const descInput = document.getElementById('seoDescription');
    const keywordsInput = document.getElementById('seoKeywords');

    const previewTitle = document.querySelector('.seo-preview h3');
    const previewDesc = document.querySelector('.seo-preview p');
    const previewKeywords = document.querySelector('.seo-preview small');

    titleInput.addEventListener('input', () => {
        previewTitle.textContent = titleInput.value || 'SEO Title Preview';
    });

    descInput.addEventListener('input', () => {
        previewDesc.textContent = descInput.value || 'SEO description preview will appear here.';
    });

    keywordsInput.addEventListener('input', () => {
        if(previewKeywords){
            previewKeywords.textContent = 'Keywords: ' + keywordsInput.value;
        }
    });
});
</script>


@include('admin.include.footer')


</body>
</html>