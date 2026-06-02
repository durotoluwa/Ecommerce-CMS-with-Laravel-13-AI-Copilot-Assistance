<nav class="main-nav">

    <ul class="menu sf-arrows">

        @foreach(getMenus() as $menu)

            {{-- MEGA MENU --}}
            @if($menu->is_mega)

                <li>

                    <a href="{{ menuUrl($menu) }}"
                       class="sf-with-ul">

                        {{ $menu->title }}

                    </a>

                    <div class="megamenu megamenu-sm">

                        <div class="row no-gutters">

                            @foreach($menu->children as $column)

                                <div class="col-md-{{ 12 / $menu->mega_columns }}">

                                    <div class="menu-col">

                                        <div class="menu-title">

                                            {{ $column->title }}

                                        </div>

                                        <ul>

                                            @foreach($column->children as $child)

                                                <li>

                                                    <a href="{{ menuUrl($child) }}">

                                                        {{ $child->title }}

                                                    </a>

                                                </li>

                                            @endforeach

                                        </ul>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </li>

            {{-- NORMAL DROPDOWN --}}
            @elseif($menu->children->count())

                <li>

                    <a href="{{ menuUrl($menu) }}"
                       class="sf-with-ul">

                        {{ $menu->title }}

                    </a>

                    <ul>

                        @foreach($menu->children as $child)

                            @include(
                                'frontend.partials.dropdown-item',
                                ['menu' => $child]
                            )

                        @endforeach

                    </ul>

                </li>

            {{-- SINGLE MENU --}}
            @else

                <li>

                    <a href="{{ menuUrl($menu) }}">

                        {{ $menu->title }}

                    </a>

                </li>

            @endif

        @endforeach

    </ul>

</nav>