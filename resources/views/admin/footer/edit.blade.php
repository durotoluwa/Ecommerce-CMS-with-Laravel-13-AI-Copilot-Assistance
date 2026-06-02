
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
								<h4 class="fw-bold">Footer Settings</h4>
							 
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
  <form action="{{ route('admin.footer.update') }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Column 1 --}}
    <div class="mb-4">
        <label>Column 1 Headline</label>
        <input type="text" name="footer_colunm1_headline" value="{{ $footer->footer_colunm1_headline }}" class="form-control mb-2">

        <label>Column 1 Links</label>
        <div id="col1-links">
            @foreach($footer->footer_colunm1 ?? [] as $i => $link)
                <div class="d-flex mb-2">
                    <input type="text" name="footer_colunm1[{{ $i }}][label]" value="{{ $link['label'] }}" placeholder="Label" class="form-control me-2">
                    <input type="text" name="footer_colunm1[{{ $i }}][url]" value="{{ $link['url'] }}" placeholder="URL" class="form-control me-2">
                    <button type="button" class="btn btn-danger remove-link">X</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary add-link" data-target="col1-links" data-name="footer_colunm1">+ Add Link</button>
    </div>

    {{-- Column 2 --}}
    <div class="mb-4">
        <label>Column 2 Headline</label>
        <input type="text" name="footer_colunm2_headline" value="{{ $footer->footer_colunm2_headline }}" class="form-control mb-2">

        <label>Column 2 Links</label>
        <div id="col2-links">
            @foreach($footer->footer_colunm2 ?? [] as $i => $link)
                <div class="d-flex mb-2">
                    <input type="text" name="footer_colunm2[{{ $i }}][label]" value="{{ $link['label'] }}" placeholder="Label" class="form-control me-2">
                    <input type="text" name="footer_colunm2[{{ $i }}][url]" value="{{ $link['url'] }}" placeholder="URL" class="form-control me-2">
                    <button type="button" class="btn btn-danger remove-link">X</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary add-link" data-target="col2-links" data-name="footer_colunm2">+ Add Link</button>
    </div>

    {{-- Column 3 --}}
    <div class="mb-4">
        <label>Column 3 Headline</label>
        <input type="text" name="footer_colunm3_headline" value="{{ $footer->footer_colunm3_headline }}" class="form-control mb-2">

        <label>Column 3 Links</label>
        <div id="col3-links">
            @foreach($footer->footer_colunm3 ?? [] as $i => $link)
                <div class="d-flex mb-2">
                    <input type="text" name="footer_colunm3[{{ $i }}][label]" value="{{ $link['label'] }}" placeholder="Label" class="form-control me-2">
                    <input type="text" name="footer_colunm3[{{ $i }}][url]" value="{{ $link['url'] }}" placeholder="URL" class="form-control me-2">
                    <button type="button" class="btn btn-danger remove-link">X</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary add-link" data-target="col3-links" data-name="footer_colunm3">+ Add Link</button>
    </div>

    {{-- Column 4 --}}
    <div class="mb-4">
        <label>Column 4 Headline</label>
        <input type="text" name="footer_colunm4_headline" value="{{ $footer->footer_colunm4_headline }}" class="form-control mb-2">

        <label>Column 4 Links</label>
        <div id="col4-links">
            @foreach($footer->footer_colunm4 ?? [] as $i => $link)
                <div class="d-flex mb-2">
                    <input type="text" name="footer_colunm4[{{ $i }}][label]" value="{{ $link['label'] }}" placeholder="Label" class="form-control me-2">
                    <input type="text" name="footer_colunm4[{{ $i }}][url]" value="{{ $link['url'] }}" placeholder="URL" class="form-control me-2">
                    <button type="button" class="btn btn-danger remove-link">X</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-secondary add-link" data-target="col4-links" data-name="footer_colunm4">+ Add Link</button>
    </div>

    <button type="submit" class="btn btn-primary">Save Footer</button>
</form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-link').forEach(btn => {
        btn.addEventListener('click', function() {
            const target = document.getElementById(this.dataset.target);
            const name = this.dataset.name;
            const index = target.children.length;
            const div = document.createElement('div');
            div.classList.add('d-flex','mb-2');
            div.innerHTML = `
                <input type="text" name="${name}[${index}][label]" placeholder="Label" class="form-control me-2">
                <input type="text" name="${name}[${index}][url]" placeholder="URL" class="form-control me-2">
                <button type="button" class="btn btn-danger remove-link">X</button>
            `;
            target.appendChild(div);
        });
    });

    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-link')) {
            e.target.parentElement.remove();
        }
    });
});
</script>

</div>


</div></div> <!----end of card-body--->
</div><!--====== end of roe =========--->






	</div></div></div>
    <!--=======end of content and page-wrapper========-->

    

<script>
function previewThumbnail(event) {
    const preview = document.getElementById('thumbnail-preview');
    preview.innerHTML = '';
    const file = event.target.files[0];
    if (file) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.style.maxWidth = '100%';
        img.style.maxHeight = '100%';
        preview.appendChild(img);
    }
}
</script>


<script>
$(document).ready(function () {

    // Toggle attribute terms block
    $('.toggle-terms').on('click', function (e) {
        e.preventDefault();
        let target = $(this).data('target');
        $(target).toggleClass('d-none');
    });

    // Select all
    $('.select-all').on('click', function () {
        let target = $(this).data('target');
        $(target).find('input[type="checkbox"]').prop('checked', true);
    });

    // Select none
    $('.select-none').on('click', function () {
        let target = $(this).data('target');
        $(target).find('input[type="checkbox"]').prop('checked', false);
    });

    // Create new attribute term
    $('.create-value').on('click', function(e) {
        e.preventDefault();

        let attributeId = $(this).data('attribute');
        let newValue = prompt("Enter new value:");
        if (!newValue) return;

        $.ajax({
            url: `/admin/attributes/${attributeId}/terms`,
            type: 'POST',
            data: {
                name: newValue,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
success: function (term) {
    let termHtml = `
        <div class="form-check me-3">
            <input class="form-check-input"
                   type="checkbox"
                   name="attribute_terms[${attributeId}][]"
                   value="${term.id}"
                   id="term-${term.id}">
            <label class="form-check-label" for="term-${term.id}">
                ${term.name}
            </label>
        </div>`;

    $(`#attribute-${attributeId} .term-list`).append(termHtml);
},
            error: function (xhr) {
                console.log(xhr.responseText);
                alert('Server error while creating term');
            }
        });
    });

});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const scheduleRadio = document.getElementById('publish-schedule');
    const nowRadio = document.getElementById('publish-now');
    const dateWrapper = document.getElementById('publish-date-wrapper');

    function toggleDate() {
        if (scheduleRadio.checked) {
            dateWrapper.classList.remove('d-none');
        } else {
            dateWrapper.classList.add('d-none');
        }
    }

    scheduleRadio.addEventListener('change', toggleDate);
    nowRadio.addEventListener('change', toggleDate);
});
</script>



 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const preview = document.getElementById('product-gallery-preview');

    // Enable drag & drop reordering
    new Sortable(preview, {
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: function (evt) {
            // Capture new order if needed
            const order = Array.from(preview.children).map(li => li.dataset.index);
            console.log('New order:', order);
            // You can send `order` back to your backend via AJAX
        }
    });

    // Remove image
    preview.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-image')) {
            e.target.closest('li').remove();
        }
    });
});
</script>


<script>

document.querySelectorAll('.toggle-featured').forEach(el => {
    el.addEventListener('click', function() {
        let productId = this.dataset.id;

        fetch(`/admin/products/${productId}/toggle-featured`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (data.featured) {
                    this.innerHTML = '<i class="fas fa-star text-warning"></i>';
                } else {
                    this.innerHTML = '<i class="far fa-star text-muted"></i>';
                }
            }
        });
    });
});

</script>




	@include('admin.include.footer')

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

</body>
</html>