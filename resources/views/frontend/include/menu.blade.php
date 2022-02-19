<ul class="navbar__menu">
    @foreach ($menu as $data)
        @php
            $id = $data->id;
        @endphp
        @if ($data->sub_page_id == null)
            @php
                $value = $data->children($id);
            @endphp

            @if ($data->urlcontrol == 1)
                <li><a href="{{ $data->slug == '#' ? '#' : route($data->slug) }}">{{ $data->name }}
                        @if (count($value) >= 1) <i class="fa fa-angle-down"></i> @endif</a>
                @else
                <li><a href="{{ $data->slug == '#' ? '#' : route('allPage', $data->slug) }}">{{ $data->name }}
                        <i class="fa fa-angle-down"></i></a>
            @endif

            @if (count($value) > 0)
                <div class="navbar-dropdown navbar-dropdown-single">
                    <div class="navbar-box">
                        <div class="box-2">
                            <div class="box clearfix">
                                <ul class="navbar__submenu">
                                    @foreach ($value as $child)
                                        @if ($child->urlcontrol == 1)
                                            <li class="navbar__submenu-item"><a class="navbar__submenu-link"
                                                    href="{{ $child->slug == '#' ? '#' : route($child->slug) }}">{{ $child->name }}</a>
                                            </li>
                                        @else
                                            <li class="navbar__submenu-item"><a class="navbar__submenu-link"
                                                    href="{{ $child->slug == '#' ? '#' : route('allPage', $child->slug) }}">{{ $child->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            </li>
        @endif
    @endforeach
</ul>
