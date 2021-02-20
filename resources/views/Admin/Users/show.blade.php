@extends('layouts.dashboard')

@section('contents')

    @include('Admin.Users.sub.store')
    @include('Admin.Users.sub.update')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

{{--    {{ str_replace('_', '-', app()->getLocale()) }}--}}

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">المستخدمين</h3>
                </div>
                <div>

                    <button type="button" class="btn m-btn--square  btn-success" id="openUserAddModal">إضافة مستخدم</button>
{{--								<span class="m-subheader__daterange" id="m_dashboard_daterangepicker">--}}
{{--									<span class="m-subheader__daterange-label">--}}
{{--										<span class="m-subheader__daterange-title"></span>--}}
{{--										<span class="m-subheader__daterange-date m--font-brand"></span>--}}
{{--									</span>--}}
{{--									<a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">--}}
{{--										<i class="la la-angle-down"></i>--}}
{{--									</a>--}}
{{--								</span>--}}
                </div>
            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-content">

            <!--Begin::Section-->
            <div class="row">

                <div class="col-xl-12">
                    <div class="table-responsive" id="tableBody">
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
                    </div>
                </div>



            </div>

            <!--End::Section-->

            <!--Begin::Section-->


            <!--End::Section-->

            <!--Begin::Section-->


            <!--End::Section-->
        </div>
    </div>
    @endsection

    @section('js')

        <script>
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            var FormUserStore = {
                init: function () {


                    $("#submitUserStore").click(function (e) {
                        e.preventDefault();
                        let form = $(this).closest("form"), accct=form.attr('action') ,  t=$(this);
                        // var table = $("#m_table_1").DataTable()

                        form.validate({
                            rules: {
                                name: {
                                    required: !0
                                },

                                user_name: {
                                    required: !0
                                },


                                email: {
                                    required: !0,
                                    email:!0
                                },

                                mobile: {
                                    required: !0,
                                },

                                password: {
                                    required: !0,
                                    min:8
                                },
                                cpassword:{
                                    required:!0,
                                    equalTo:"#password"
                                },



                            },
                            messages: {
                                name: {
                                    required: "هذا الحقل مطلوب",
                                },

                                user_name: {
                                    required: "هذا الحقل مطلوب",
                                },


                                mobile: {
                                    required: "هذا الحقل مطلوب",
                                },

                                email: {
                                    required: "هذا الحقل مطلوب",
                                    email:":الرجاء إدخال الصيغد الصحيحد للبريد الإلكتروني"
                                },

                                password: {
                                    required: "هذا الحقل مطلوب",
                                    min: "كلمة المرور أقل شئ 8"
                                },
                                cpassword: {
                                    required: "هذا الحقل مطلوب",
                                    equalTo: "يجب أن يكون نفس كلمة المرور"
                                },

                            },
                            invalidHandler: function (e,r) {

                                toastr.error("خطأ عام");


                            }
                        });
                        if(form.valid()) {
                            form.ajaxSubmit({
                                url:"{{ route("user.store") }}",
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                                },
                                beforeSend: function ( xhr ) {

                                    t.addClass('m-loader');




                                },
                                success: function (data) {

                                    console.log(data);
                                    t.removeClass('m-loader');

                                    $("#m_user_store_modal").modal("hide");


                                    $("#tableBody").empty().append(data);
                                    form.clearForm(),form.validate().resetForm();
                                    // toastr.success("");
                                    //
                                    // toastr.error(data.errorMessage);


                                },error: function (response) {
                                    // console.log(response.responseJSON.errors);
                                    console.log(response.responseJSON)
                                    if(response.responseJSON.errors.first_name) {
                                        toastr.error(response.responseJSON.errors.first_name);
                                    }else if(response.responseJSON.errors.father_name) {
                                        toastr.error(response.responseJSON.errors.first_name);
                                    }else if(response.responseJSON.errors.family_name) {
                                        toastr.error(response.responseJSON.errors.family_name);
                                    }else if(response.responseJSON.errors.email) {
                                        toastr.error(response.responseJSON.errors.email);
                                    }else if(response.responseJSON.errors.password) {
                                        toastr.error(response.responseJSON.errors.password);
                                    }

                                    mApp.unblock("#m_blockui_4_4_modal .modal-content");
                                }
                            });
                        }

                    });

                }
            };
            $(document).ready(() => {

                FormUserStore.init();




                $(document).on('click' , '#openUserAddModal' , e => {
                    e.preventDefault();


                    $("#m_user_store_modal").modal("show");
                });

                $(document).on('click' , '.userEdit' , e => {
                    e.preventDefault();
                    var $this = $(e.currentTarget);
                    let id = $this.attr('id');
                    $.ajax({
                        url: "{{ route('fetch.user.by.id.data') }}",
                        data: {id: id},
                        type: 'get',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                        },
                        beforeSend: function ( xhr ) {
                            mApp.block("#tableBody .table" , {
                                overlayColor:"#000000",
                                type:"loader",
                                state:"success",
                                message:"Please wait..."
                            });
                        },
                        success: function (data) {
                            console.log(data);

                            $("#m_user_update_modal").modal("show");

                            $("#name_edit").val(data.name);
                            $("#user_name_edit").val(data.user_name);
                            $("#email_edit").val(data.email);
                            $("#mobile_edit").val(data.mobile);
                            $("#user_id").val(data.id);



                            mApp.unblock("#tableBody .table");

                        },error: function (data) {
                            console.log(data)
                            toastr.error(data.responseJSON.errors);
                            mApp.unblock("#tableBody .table");
                        }

                    });
                });


            });

            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
        </script>



        @endsection
