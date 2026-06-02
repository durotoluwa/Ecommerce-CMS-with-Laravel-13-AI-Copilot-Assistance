<li>

    <a href="{{ menuUrl($menu) }}"
       class="{{ $menu->children->count() ? 'sf-with-ul' : '' }}">

        {{ $menu->title }}

    </a>

    @if($menu->children->count())

        <ul>

            @foreach($menu->children as $child)

                @include(
                    'frontend.partials.dropdown-item',
                    ['menu' => $child]
                )

            @endforeach

        </ul>

    @endif

</li>