<li class="list-group-item mb-2"
    data-id="{{ $menu->id }}">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <span class="drag-handle"
                  style="cursor:pointer;">

                ☰

            </span>

            <strong>
                {{ $menu->title }}
            </strong>

            @if($menu->is_mega)

                <span class="badge bg-primary">
                    Mega Menu
                </span>

            @endif

        </div>

        <div class="d-flex gap-2">

               <a class="me-2 p-2   toggleEdit" >
            <i data-bs-toggle="tooltip"  title="Edit Menu" data-feather="edit" class="feather-edit"></i>
            </a>
            
             <a class="me-2 p-2 deleteMenu"
                    data-id="{{ $menu->id }}"  >
            <i data-bs-toggle="tooltip"  title="Delete Menu" data-feather="trash-2" class="feather-trash-2"></i>
            </a>

            

        </div>

    </div>

    <!-- EDIT AREA -->

    <div class="editArea mt-3"
         style="display:none;">

        <form class="updateMenuForm"
              data-id="{{ $menu->id }}">

            <div class="mb-2">

                <label>
                    Menu Title
                </label>

                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ $menu->title }}">

            </div>

            <div class="mb-2">

                <label>
                    URL
                </label>

                <input type="text"
                       name="url"
                       class="form-control"
                       value="{{ $menu->url }}">

            </div>

            <div class="mb-2">

                <label>
                    Parent Menu
                </label>

                <select name="parent_id"
                        class="form-control">

                    <option value="">
                        Main Menu
                    </option>

                    @foreach(
                        \App\Models\Menu::where('id', '!=', $menu->id)->get()
                        as $parent
                    )

                        <option value="{{ $parent->id }}"
                            {{ $menu->parent_id == $parent->id ? 'selected' : '' }}>

                            {{ $parent->title }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-check mb-2">

                <input type="checkbox"
                       class="form-check-input"
                       name="is_mega"
                       value="1"
                       {{ $menu->is_mega ? 'checked' : '' }}>

                <label class="form-check-label">
                    Mega Menu
                </label>

            </div>

            <div class="mb-2">

                <label>
                    Mega Columns
                </label>

                <select name="mega_columns"
                        class="form-control">

                    @for($i = 2; $i <= 6; $i++)

                        <option value="{{ $i }}"
                            {{ $menu->mega_columns == $i ? 'selected' : '' }}>

                            {{ $i }} Columns

                        </option>

                    @endfor

                </select>

            </div>

            <button type="submit"
                    class="btn btn-success btn-sm">

                Save Changes

            </button>

        </form>

    </div>

    <!-- CHILDREN -->

    @if($menu->children->count())

        <ul class="list-group mt-2 nested-sortable">

            @foreach($menu->children as $child)

                @include(
                    'admin.menus.partials.menu-item',
                    ['menu' => $child]
                )

            @endforeach

        </ul>

    @endif

</li>