<li class="{{ $item->submenus->count() ? 'dropdown' : '' }}">
    <a href="{{ url($item->link ?? '#') }}"
       @if($item->submenus->count()) class="dropdown-toggle" data-toggle="dropdown" @endif>
        {{ $item->label }}
    </a>

    @if($item->submenus->count())
        <ul class="dropdown-menu">
            @foreach($item->submenus as $child)
                <li>
                    <a href="{{ url($child->link ?? '#') }}">
                        {{ $child->label }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
