<li class="menu-item" data-id="{{ $item->id }}">
    <div class="menu-handle d-flex justify-content-between align-items-center">
        <span>
            {{ $item->label }}
            <span style="color:#888;">({{ $item->link }})</span>
        </span>

        <!-- Delete button -->
        <button type="button"
                class="btn btn-sm btn-danger delete-menu-item"
                data-id="{{ $item->id }}">
           <i class="fa-solid fa-trash"></i>
        </button>
    </div>

    @if($item->children->count())
        <ul>
            @foreach($item->children as $child)
                @include('admin.menu.partials.menu-item', ['item' => $child])
            @endforeach
        </ul>
    @endif
</li>
