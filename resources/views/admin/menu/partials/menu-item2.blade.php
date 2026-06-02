

<li class="menu-item" data-id="{{ $item->id }}">
    <div class="menu-handle">
        {{ $item->label }}
        <span style="color:#888;">({{ $item->link }})</span>
    </div>

    @if($item->children->count())
        <ul>
            @foreach($item->children as $child)
                @include('admin.menu.partials.menu-item', ['item' => $child])
            @endforeach
        </ul>
    @endif
</li>
