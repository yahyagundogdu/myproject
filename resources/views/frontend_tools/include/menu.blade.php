<nav id="menu" class="menu">
    <ul class="dropdown">
        @foreach ($menu as $data)
            @php
                $id = $data->id;
            @endphp
            @if ($data->sub_page_id == null)
                @php
                    $value = $data->children($id);
                @endphp

                @if ($data->urlcontrol == 1)
                    <li><a href="{{ $data->slug == '#' ? '#' : route($data->slug) }}">{{ $data->name }} @if (count($value)>=1) <i class="fas fa-chevron-down pl-1"></i> @endif</a>
                    @else
                    <li><a href="{{ $data->slug == '#' ? '#' : route('allPage', $data->slug) }}">{{ $data->name }} <i class="fas fa-chevron-down pl-1"></i></a>
                @endif


                @if (count($value) > 0)
                    <ul>
                        @foreach ($value as $child)
                            @if ($data->urlcontrol == 1)
                                <li><a
                                        href="{{ $child->slug == '#' ? '#' : route($child->slug) }}">{{ $child->name }}</a>
                                </li>
                            @else
                                <li><a
                                        href="{{ $child->slug == '#' ? '#' : route('allPage', $child->slug) }}">{{ $child->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                </li>
            @endif
        @endforeach
    </ul>
</nav>




</nav>
