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

    @foreach($data as $row)
        <tr>
            <th scope="row">{{ $row->id }}</th>
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
