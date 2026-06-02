
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
								<h4 class="fw-bold">Menu</h4>
							 
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
 
 <div class="row">

        <!-- LEFT SIDE -->
        <div class="col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-header">
                    <h4 class="mb-0">
                        Add Menu Item
                    </h4>
                </div>

                <div class="card-body">

                    <form id="menuForm">

                        <div class="mb-3">
                            <label class="form-label">
                                Menu Title
                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   required>
                        </div>

<div class="mb-3">
    <label class="form-label">
        Menu Type
    </label>

    <select name="type"
            class="form-control"
            id="menuType">

        <option value="custom">Custom Link</option>
        <option value="fixed">Fixed Page</option>
        <option value="page">Custom Page</option>
        <option value="brand">Brand</option>
        <option value="product_category">Product Category</option>
        <option value="product">Product</option>
        <option value="brand_category">Brand + Category</option> <!-- NEW -->
    </select>
</div>


<div class="mb-3 custom-url-field">

    <label class="form-label">
        URL
    </label>

    <input type="text"
           name="url"
           class="form-control">

</div>

<div class="mb-3 reference-field"
     style="display:none;">

    <label class="form-label">
        Select Item
    </label>

    <select name="reference_id"
            class="form-control"
            id="referenceSelect">

    </select>

</div>

                        <div class="mb-3">
                            <label class="form-label">
                                Parent Menu
                            </label>

<select name="parent_id"
        class="form-control">

    <option value="">
        Main Menu
    </option>

    {!! renderMenuOptions($menus) !!}

</select>
                        </div>

                        <div class="form-check mb-3">

                            <input type="checkbox"
                                   class="form-check-input"
                                   name="is_mega"
                                   value="1">

                            <label class="form-check-label">
                                Mega Menu
                            </label>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Mega Columns
                            </label>

                            <select name="mega_columns"
                                    class="form-control">

                                <option value="2">2 Columns</option>
                                <option value="3">3 Columns</option>
                                <option value="4" selected>
                                    4 Columns
                                </option>
                                <option value="5">5 Columns</option>
                                <option value="6">6 Columns</option>

                            </select>

                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100">

                            Add Menu

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="col-md-8">

            <div class="card shadow-sm border-0">

                <div class="card-header d-flex justify-content-between">

                    <h4 class="mb-0">
                        Menu Structure
                    </h4>

                    <button class="btn btn-primary btn-md d-inline-flex align-items-center"
                            id="saveOrder">

                        Save Menu Order

                    </button>

                </div>

                <div class="card-body">

                    <ul id="menuList"
                        class="list-group nested-sortable">

                        @foreach($menus as $menu)

                            @include(
                                'admin.menus.partials.menu-item',
                                ['menu' => $menu]
                            )

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    </div>




</div>


</div></div> <!----end of card-body--->
</div><!--====== end of roe =========--->






	</div></div></div>
    <!--=======end of content and page-wrapper========-->

    

 



	@include('admin.include.footer')

 <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | INIT SORTABLE
    |--------------------------------------------------------------------------
    */

    function initSortable(el)
    {
        new Sortable(el, {

            group: 'nested',

            animation: 150,

            fallbackOnBody: true,

            swapThreshold: 0.65,

            handle: '.drag-handle'

        });

        el.querySelectorAll('.nested-sortable')
            .forEach(child => {

                initSortable(child);

            });
    }

    initSortable(document.getElementById('menuList'));

    /*
    |--------------------------------------------------------------------------
    | STORE MENU
    |--------------------------------------------------------------------------
    */

    $('#menuForm').submit(function(e){

        e.preventDefault();

        $.ajax({

            url: "{{ route('menus.store') }}",

            method: "POST",

            data: $(this).serialize(),

            success: function(response){

                toastr.success(response.message);

                location.reload();

            },

           error: function(xhr){

    if(xhr.responseJSON.message){

        toastr.error(xhr.responseJSON.message);

    } else {

        toastr.error('Error creating menu');

    }

}

        });

    });

    /*
    |--------------------------------------------------------------------------
    | DELETE MENU
    |--------------------------------------------------------------------------
    */

    $(document).on('click', '.deleteMenu', function(){

        if(!confirm('Delete this menu?')) {
            return;
        }

        let id = $(this).data('id');

        $.ajax({

            url: '/admin/menus/delete/' + id,

            method: 'DELETE',

            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response){

                toastr.success(response.message);

                location.reload();

            }

        });

    });


    /*
|--------------------------------------------------------------------------
| TOGGLE EDIT PANEL
|--------------------------------------------------------------------------
*/

$(document).on('click', '.toggleEdit', function(){

    $(this)
        .closest('li')
        .find('.editArea')
        .first()
        .slideToggle();

});


/*
|--------------------------------------------------------------------------
| UPDATE MENU
|--------------------------------------------------------------------------
*/

$(document).on('submit', '.updateMenuForm', function(e){

    e.preventDefault();

    let form = $(this);

    let id = form.data('id');

    $.ajax({

        url: '/admin/menus/update/' + id,

        method: 'POST',

        data: form.serialize(),

        success: function(response){

            toastr.success(response.message);

            location.reload();

        },

        error: function(xhr){

            if(xhr.responseJSON.message){

                toastr.error(xhr.responseJSON.message);

            } else {

                toastr.error('Update failed');

            }

        }

    });

});
$('#menuType').change(function(){

    let type = $(this).val();

    /*
    |--------------------------------------------------------------------------
    | CUSTOM LINK
    |--------------------------------------------------------------------------
    */

    if(type === 'custom'){

        $('.custom-url-field').show();

        $('.reference-field').hide();

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | LOAD REFERENCES
    |--------------------------------------------------------------------------
    */

    $('.custom-url-field').hide();

    $('.reference-field').show();

    $.ajax({

        url: '/admin/menus/references/' + type,

        method: 'GET',

        success: function(response){

            let html = '';

            html += `
                <option value="">
                    Select Item
                </option>
            `;

            response.forEach(function(item){

                /*
                |--------------------------------------------------------------------------
                | FIXED MENU
                |--------------------------------------------------------------------------
                */

                if(type === 'fixed'){

                    html += `

                        <option
                            value="${item.id}"
                            data-url="${item.url}">

                            ${item.label}

                        </option>
                    `;

                }

                /*
                |--------------------------------------------------------------------------
                | BRAND + CATEGORY
                |--------------------------------------------------------------------------
                */

                else if(type === 'brand_category'){

                    html += `

                        <option
                            value="${item.id}"
                            data-brand="${item.brand_slug}"
                            data-category="${item.category_slug}">

                            ${item.label}

                        </option>
                    `;

                }

                /*
                |--------------------------------------------------------------------------
                | NORMAL OPTIONS
                |--------------------------------------------------------------------------
                */

                else{

                    html += `

                        <option value="${item.id}">

                            ${item.label}

                        </option>
                    `;
                }

            });

            $('#referenceSelect').html(html);

        }

    });

});
</script>

</body>
</html>