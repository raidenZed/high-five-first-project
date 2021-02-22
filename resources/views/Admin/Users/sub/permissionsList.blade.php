@foreach($permission as $group => $permissionList)
    @foreach ($permissionList as $index => $row_list)
        @if($loop->first)
            <div class="mainParent">
                <div class='parentDiv'>
                    <div class='m-checkbox parent_checkbox'>
                        <label class='m-checkbox m-checkbox--solid m-checkbox--state-success'>
                            <input type='checkbox' name="permission[]" class="parentCheckVal" title="{{ $group }}" value="{{ $row_list->name }}" @if($permissionNames) @if(in_array($row_list->name, $permissionNames))  checked @endif @endif> {{ $row_list->name_ar }}
                            <span></span>
                            </label>
                        </div>
                </div>
                <div class='m-checkbox-inline chiled_checkbox row'>
                @else
    {{--            @break--}}

    {{--                    @continue--}}
                        <label class='m-checkbox m-checkbox--solid m-checkbox--state-success col-sm-3'>
                            <input type='checkbox' name="permission[]" class="childCheckVal" title="{{ $group }}" @if($permissionNames) @foreach($permissionNames as $row_check_permission) @if($row_check_permission === $row_list->name) checked @endif  @endforeach @endif value="{{ $row_list->name }}">{{ $row_list->name_ar }}
                            <span></span>
                        </label>

                @endif

        @endforeach
                    </div>
                </div>
            </div>


@endforeach
