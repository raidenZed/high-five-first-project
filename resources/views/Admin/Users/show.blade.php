@extends('layouts.dashboard')

@section('contents')

    @include('Admin.Users.sub.store')
    @include('Admin.Users.sub.permissions')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

{{--    {{ str_replace('_', '-', app()->getLocale()) }}--}}

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">المستخدمين</h3>
                </div>
                <div>
                    @can('add_users')
                    <button type="button" class="btn m-btn--square  btn-success" id="openUserAddModal">إضافة مستخدم</button>
                    @endcan
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
                    <div class="" id="tableBody">
                        @include('admin.users.dataTable')
                        @if(false)
                        <table class="table table-bordered m-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الإسم الكامل</th>
                                <th>إسم المستخدم</th>
                                <th>البريد الإلكتروني</th>
                                @can('edit_users')
                                <th>تعديل</th>
                                @endcan
                                @can('privileges_users')
                                <th>الصلاحيات</th>
                                @endcan
                                @can('delete_users')
                                <th>حذف</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @php $counter = 0; @endphp
                            @foreach($data as $row)
                                @php $counter = $counter+1; @endphp
                                <tr>
                                    <th scope="row">{{ $counter }}</th>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->user_name }}</td>
                                    <td>{{ $row->email }}</td>
                                    @can('edit_users')
                                    <td>

                                        <a href="#" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air userEdit" id="{{ $row->id }}">
                                            <i class="la la-edit"></i>
                                        </a>


                                    </td>
                                    @endcan
                                    @can('privileges_users')
                                    <td>

                                        <a href="#" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air userPrivileges" id="{{ $row->id }}">
                                            <i class="la la-user"></i>
                                        </a>
                                    </td>
                                    @endcan
                                    @can('delete_users')
                                    <td>

                                        <a href="#" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air userDelete" id="{{ $row->id }}">
                                            <i class="la la-trash"></i>
                                        </a>

                                    </td>
                                    @endcan
                                </tr>
                            @endforeach



                            </tbody>
                        </table>

{{--                        <input type="hidden" id="generalCounter" value="{{ $counter }}">--}}
                        <input type="hidden" id="generalPage" value="1">


                        <div class="row d-flex justify-content-center">
                            <div class="col-xs-12">
                                {!! $data->links() !!}
                            </div>
                        </div>
                        @endif
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

@section('style')

    <style>
        #permissionView .parentDiv {
            border-bottom: 1px solid #e9ecef;
        }

        #permissionView .parent_checkbox {
            padding-right: 0px;
            /*margin-bottom: 5px;*/
        }

        #permissionView .chiled_checkbox {
            margin-top: 18px;
            padding-right: 15px;
        }

        .m-checkbox-inline .m-checkbox, .m-checkbox-inline .m-radio, .m-radio-inline .m-checkbox, .m-radio-inline .m-radio {
            margin-bottom: 10px;
            margin-left: 0px;
        }

        #permissionView .mainParent {
            margin-bottom: 30px;
        }

        @media (min-width: 992px) {
            .modal-lg {
                max-width: 900px;
            }
        }

    </style>
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

            var generalUserUrl = "{{ route('user.index') }}";


            var FormUserStore = {
                init: function () {

                    $("#submitUserStore").click(function (e) {
                        e.preventDefault();


                         $('.addNewpageForm').on('submit', function(e){
                            e.preventDefault();
                            var formData = new FormData(this);
                            $.ajax({
                                url: "/personal_data/add",
                                type: "post",
                                cache:false,
                                contentType: false,
                                processData: false,
                                data: formData,
                                success: function (data) {
                                    $('#loading').hide();
                                    if (data["status"] == true) {
                                        swal({
                                            title: "",
                                            text: data["data"],
                                            type: "success",
                                            showCancelButton: false,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "{{trans('lang.ok')}}",
                                            cancelButtonText: "{{trans('lang.cancel')}}",
                                            closeOnConfirm: true,
                                            closeOnCancel: true
                                        });
                                        var url = $(this).attr('href');
                                        getData(url);
                                        /*$(".addNewpageForm .full_name").val('');
                                        $('#addNewpageForm').find('.rowIdUpdate').val(0);
                                        $('.addNewpageForm .notes').val('');
                                        $('.addNewpageForm .birth_city').val('');
                                        $(".addNewpageForm .mobile1").val('');*/
                                        $("#add_page").modal("hide");
                                    } else {
                                        swal({
                                            title: "",
                                            text: data["data"],
                                            type: "error",
                                            showCancelButton: false,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "{{trans('lang.ok')}}",
                                            cancelButtonText: "{{trans('lang.cancel')}}",
                                            closeOnConfirm: true,
                                            closeOnCancel: true
                                        });

                                    }
                                }
                });
                        })
                        
                        
                        
                        // $("#m_form_1_msg").addClass("m--hide")
                        var form = $(this).closest("form"), accct=form.attr('action') ,  t=$(this);


                        // var table = $("#m_table_1").DataTable()
                        let userId = $("#user_id").val();

                        let urlAjax = "";

                        if(userId == 0) {
                            console.log("hello");
                            urlAjax = "{{ route("user.store") }}";

                        }else {
                            urlAjax = m_url+"/Dashboard/Users/update/"+userId;

                        }




                        {{--                            urlAjax = "{{ route("user.store") }}";--}}
                        //                             console.log(userId)
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
                                    required: () => {
                                        return $("#user_id").val() == 0;

                                    },
                                    minlength:8
                                },
                                cpassword:{
                                    required: () => {
                                        return $("#user_id").val() == 0;
                                    },
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
                                    minlength: "كلمة المرور أقل شئ 8"
                                },
                                cpassword: {
                                    required: "هذا الحقل مطلوب",
                                    equalTo: "يجب أن يكون نفس كلمة المرور"
                                },

                            },
                            invalidHandler: function (e,r) {

                                // toastr.error("خطأ عام");


                            }
                        });


                        if(form.valid()) {
                            form.ajaxSubmit({
                                url:urlAjax,
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

                                    if(data.status == true) {

                                        $("#m_user_store_modal").modal("hide");

                                        getData(generalUserUrl);

                                        swal({title: "تمت العملية بنجاح" , text:data.msg , type: "success" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});

                                    }





                                    form.clearForm(),form.validate().resetForm();
                                    // toastr.success("");
                                    //
                                    // toastr.error(data.errorMessage);


                                },error: function (response) {
                                    // console.log(response.responseJSON.errors);
                                    console.log(response.responseJSON);

                                    t.removeClass('m-loader');


                                    if(response.status == 422) {

                                        // $("#m_form_1_msg").removeClass("m--hide");

                                        let ul = "<ul>";
                                        for(let i in response.responseJSON.errors) {
                                            ul += "<li>"+response.responseJSON.errors[i]+"</li>";
                                        }

                                        ul += "</ul>";

                                        swal({title: "الرجاء التأكد من البيانات" , html:ul , type: "error" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});


                                        // i(l,"danger","");
                                    }
                                    // if(response.responseJSON.errors.name) {
                                    //     toastr.error(response.responseJSON.errors.name);
                                    // }else if(response.responseJSON.errors.user_name) {
                                    //     toastr.error(response.responseJSON.errors.user_name);
                                    // }else if(response.responseJSON.errors.mobile) {
                                    //     toastr.error(response.responseJSON.errors.mobile);
                                    // }else if(response.responseJSON.errors.email) {
                                    //     toastr.error(response.responseJSON.errors.email);
                                    // }else if(response.responseJSON.errors.password) {
                                    //     toastr.error(response.responseJSON.errors.password);
                                    // }

                                    mApp.unblock("#m_blockui_4_4_modal .modal-content");
                                }
                            });
                        }

                    });


                }
            };
            var FormUserPermission = {
                init: function () {


                    $("#submitUserPermission").click(function (e) {
                        e.preventDefault();



                        // $("#m_form_1_msg").addClass("m--hide")
                        var form = $(this).closest("form"), accct=form.attr('action') ,  t=$(this);









                        {{--                            urlAjax = "{{ route("user.store") }}";--}}
                        //                             console.log(userId)
                        form.validate({
                            rules: {
                                "permission[]": {
                                    required: !0
                                },





                            },
                            messages: {
                                "permission[]": {
                                    required: "",
                                },



                            },
                            invalidHandler: function (e,r) {

                                // toastr.error("خطأ عام");

                                swal({title: "الرجاء التأكد من البيانات" , text:"قم بتحديد صلاحية واحدة على الأقل" , type: "error" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});



                            }
                        });


                        if(form.valid()) {
                            form.ajaxSubmit({
                                url:"{{ route("change.user.permissions") }}",
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

                                    if(data.status == true) {

                                        $("#m_user_permissions_modal").modal("hide");

                                        // getData(generalUserUrl);

                                        swal({title: "تمت العملية بنجاح" , text:data.msg , type: "success" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});

                                    }else {
                                        swal({title: "خطأ عام" , text:data.msg , type: "error" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});

                                    }





                                    form.clearForm(),form.validate().resetForm();
                                    // toastr.success("");
                                    //
                                    // toastr.error(data.errorMessage);


                                },error: function (response) {
                                    // console.log(response.responseJSON.errors);
                                    console.log(response.responseJSON);

                                    t.removeClass('m-loader');


                                    if(response.status == 422) {

                                        // $("#m_form_1_msg").removeClass("m--hide");

                                        let ul = "<ul>";
                                        for(let i in response.responseJSON.errors) {
                                            ul += "<li>"+response.responseJSON.errors[i]+"</li>";
                                        }

                                        ul += "</ul>";

                                        swal({title: "الرجاء التأكد من البيانات" , html:ul , type: "error" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});


                                        // i(l,"danger","");
                                    }
                                    // if(response.responseJSON.errors.name) {
                                    //     toastr.error(response.responseJSON.errors.name);
                                    // }else if(response.responseJSON.errors.user_name) {
                                    //     toastr.error(response.responseJSON.errors.user_name);
                                    // }else if(response.responseJSON.errors.mobile) {
                                    //     toastr.error(response.responseJSON.errors.mobile);
                                    // }else if(response.responseJSON.errors.email) {
                                    //     toastr.error(response.responseJSON.errors.email);
                                    // }else if(response.responseJSON.errors.password) {
                                    //     toastr.error(response.responseJSON.errors.password);
                                    // }

                                    mApp.unblock("#m_blockui_4_4_modal .modal-content");
                                }
                            });
                        }

                    });

                }
            };
            $(document).ready(() => {


                FormUserStore.init();
                FormUserPermission.init();





                $(document).on('click' , '#openUserAddModal' , e => {
                    e.preventDefault();
                    $("#formUserStore").clearForm();

                    $("#user_id").val(0);
                    $("#exampleModalLabel").text("إضافة مستخدم");
                    $("#submitUserUpdate").attr("id" , "submitUserStore");
                    $("#m_user_store_modal").modal("show");
                });

                $(document).on('click' , '.userEdit' , e => {
                    e.preventDefault();
                    var $this = $(e.currentTarget);
                    let id = $this.attr('id');

                    $("#formUserStore").clearForm();

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
                            $("#exampleModalLabel").text("تعديل المستخدم");

                            $("#m_user_store_modal").modal("show");

                            $("#name").val(data.name);
                            $("#user_name").val(data.user_name);
                            $("#email").val(data.email);
                            $("#mobile").val(data.mobile);
                            $("#user_id").val(data.id);



                            mApp.unblock("#tableBody .table");

                        },error: function (response) {
                            console.log(response)

                            if(response.status == 422) {


                                let ul = "<ul>";
                                for(let i in response.responseJSON.errors) {
                                    ul += "<li>"+response.responseJSON.errors[i]+"</li>";
                                }

                                ul += "</ul>";

                                swal({title: "خطأ عام" , html:ul , type: "error" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});


                            }
                            mApp.unblock("#tableBody .table");


                        }

                    });
                });
                $(document).on('click' , '.userDelete' , e => {
                    e.preventDefault();
                    var $this = $(e.currentTarget);
                    let id = $this.attr('id');

                    $.ajax({
                        url: "{{ route('delete.user.by.id.data') }}",
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


                           if(data.status === true) {
                               getData();
                               swal({title: "تمت العملية بنجاح" , text:data.msg , type: "success" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});

                           }



                            mApp.unblock("#tableBody .table");

                        },error: function (response) {
                            console.log(response)

                            if(response.status == 422) {


                                let ul = "<ul>";
                                for(let i in response.responseJSON.errors) {
                                    ul += "<li>"+response.responseJSON.errors[i]+"</li>";
                                }

                                ul += "</ul>";

                                swal({title: "خطأ عام" , html:ul , type: "error" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});


                            }
                            mApp.unblock("#tableBody .table");


                        }

                    });
                });

                $(document).on('click' , '.pagination a' , e => {

                    e.preventDefault();
                    var $this = $(e.currentTarget);
                    var page = $this.attr('href').split('page=')[1];

                    let generalCounter = $("#generalCounter").val();
                    let generalPage = $("#generalPage").val();
                    let newPage = page;

                    let paginateUserUrl = "{{ route('user.index') }}?page="+page;
                    getData(paginateUserUrl , generalCounter , generalPage , newPage);

                });

                $(document).on('click' , '.userPrivileges' , e => {
                    e.preventDefault();
                    var $this = $(e.currentTarget);
                    let id = $this.attr('id');
                    $("#user_id_permission").val(id);

                    $.ajax({
                        url: "{{ route('get.user.permissions') }}",
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
                            // console.log(data);

                            $("#m_user_permissions_modal").modal("show");

                            $("#permissionView").empty().html(data);


                            mApp.unblock("#tableBody .table");

                        },error: function (response) {
                            // console.log(response)

                            if(response.status == 422) {


                                let ul = "<ul>";
                                for(let i in response.responseJSON.errors) {
                                    ul += "<li>"+response.responseJSON.errors[i]+"</li>";
                                }

                                ul += "</ul>";

                                swal({title: "خطأ عام" , html:ul , type: "error" , confirmButtonText:"تم" , confirmButtonClass: "swal2-confirm btn btn-success m-btn m-btn--custom"});


                            }
                            mApp.unblock("#tableBody .table");


                        }

                    });
                });

                $(document).on('change' , '.parentCheckVal' , e => {
                    var $this = $(e.currentTarget);
                    let group = $this.attr('title');
                    if($this.is(":checked")) {

                        $(".childCheckVal:input[title="+group+"]").prop("checked" , true);

                    }else {

                        $(".childCheckVal:input[title="+group+"]").prop("checked" , false);

                    }


                });

                $(document).on('change' , '.childCheckVal' , e => {
                    let $this = $(e.currentTarget);
                    let group = $this.attr("title");
                    let checkChildren = $(".childCheckVal:input[title="+group+"]:checked");

                    if(checkChildren.length > 0) {
                        checkChildren.parent().parent().parent().find(".parentDiv").find(".parentCheckVal").prop("checked" , true);

                    }else {
                        $this.parent().parent().parent().find(".parentDiv").find(".parentCheckVal").prop("checked" , false);

                    }
                    // $(".childCheckVal:").each((index , element) => {
                    //
                    // });

                });
            });



            function getData(url , counter , currentPage , newPage) {
             var newPage = $('#newPage').val();
             var currentPage = $('#currentPage').val();
             var newPage = $('#counter').val();
             
                $.ajax({
                    url: url,
                    data: {counter: counter , currentPage: currentPage , newPage: newPage},
                    type: 'get',
                   
                    beforeSend: function ( xhr ) {
                        mApp.block("#tableBody .table" , {
                            overlayColor:"#000000",
                            type:"loader",
                            state:"success",
                            message:"Please wait..."
                        });
                    },
                    success: function (data) {

                        $("#tableBody").empty().append(data);



                        mApp.unblock("#tableBody .table");

                    },error: function (data) {
                        console.log(data)
                        toastr.error(data.responseJSON.errors);
                        mApp.unblock("#tableBody .table");
                    }

                });
            }

            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
        </script>



        @endsection
