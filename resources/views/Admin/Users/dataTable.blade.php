<table class="table table-bordered m-table">
    <thead>
    <tr>
        <th>#</th>
        <th>الإسم الكامل</th>
        <th>إسم المستخدم</th>
        <th>البريد الإلكتروني</th>
        <th>تعديل</th>
        <th>حذف</th>
    </tr>
    </thead>
    <tbody>


{{--    @if($counter > 0)--}}
{{--        @php $counter = $counter; @endphp--}}

{{--    @elseif($counter == 0)--}}
{{--        @php $counter = 0; @endphp--}}

{{--    @endif--}}

    @php $counter = 0; @endphp

    @foreach($data as $row)

{{--        @if($newPage > $currentPage)--}}
        @php $counter = $counter+1; @endphp

{{--        @endif--}}

{{--        @if($newPage < $currentPage)--}}
{{--            @php $counter = $counter+1; @endphp--}}

{{--        @else--}}
{{--            @php $counter = $counter+1; @endphp--}}
{{--            @endif--}}
        <tr>
            <th scope="row">{{ $counter }}</th>
            <td>{{ $row->name }}</td>
            <td>{{ $row->user_name }}</td>
            <td>{{ $row->email }}</td>
            <td>
                <a href="#" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air userEdit" id="{{ $row->id }}">
                    <i class="la la-edit"></i>
                </a>

            </td>
            <td>
                <a href="#" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air userDelete" id="{{ $row->id }}">
                    <i class="la la-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach



    </tbody>
</table>
{{--<input type="text" id="generalCounter" value="{{ $counter }}">--}}
{{--<input type="hidden" id="generalPage" value="{{ $newPage }}">--}}

<div class="row d-flex justify-content-center">
    <div class="col-xs-12">
        {!! $data->links() !!}
    </div>
</div>
