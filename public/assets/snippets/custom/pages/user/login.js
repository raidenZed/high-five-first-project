var SnippetLogin=function(){
    var e=$("#m_login"),
        i=function(e,i,a){
        var l= $('<div class="m-alert m-alert--outline alert alert-'+i+' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
        e.find(".alert").remove(),
            l.prependTo(e),mUtil.animateClass(l[0],"fadeIn animated"),l.find("span").html(a)},
        a=function(){e.removeClass("m-login--forget-password"),e.removeClass("m-login--signup"),
            e.addClass("m-login--signin"),
            mUtil.animateClass(e.find(".m-login__signin")[0],"flipInX animated")},
        l=function(){$("#m_login_forget_password").click(function(i){i.preventDefault(),
            e.removeClass("m-login--signin"),e.removeClass("m-login--signup"),
            e.addClass("m-login--forget-password"),
            mUtil.animateClass(e.find(".m-login__forget-password")[0],"flipInX animated")}),
            $("#m_login_forget_password_cancel").click(function(e){e.preventDefault(),a()}),
            $("#m_login_signup").click(function(i){
                i.preventDefault(),
                    e.removeClass("m-login--forget-password"),
                    e.removeClass("m-login--signin"),
                    e.addClass("m-login--signup"),
                    mUtil.animateClass(e.find(".m-login__signup")[0],"flipInX animated")}),
            $("#m_login_signup_cancel").click(function(e){e.preventDefault(),a()})};
    return {init:function(){
            l(), $("#m_login_signin_submit").click(function(e){
                e.preventDefault();
                var a=$(this),
                    l=$(this).closest("form");
                l.validate({
                    rules: {
                        user_name:{required:!0},
                        password:{required:!0}
                    },
                messages: {
                    user_name: {
                            required: "هذا الحقل مطلوب",
                        },
                    password:{
                            required: "هذا الحقل مطلوب"
                    }
                }}),
                l.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled",!0),
                    l.ajaxSubmit({
                        url: m_url+"/attempt/login",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                        },
                        success:function(e,t,r,s){

                            console.log(e , t , r , s)

                            if(e.status == 1) {
                                setTimeout(() => {
                                    a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1);
                                    i(l,"success",e.msg);

                                    window.location = m_url+"/Dashboard";
                                    // a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1);
                                    //     i(l,"danger","Incorrect username or password. Please try again.")
                                },2e3);
                            }else {

                                setTimeout(() => {
                                    a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1);
                                    i(l,"danger",e.msg);
                                    // a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1);
                                    //     i(l,"danger","Incorrect username or password. Please try again.")
                                },2e3);

                            }
                        },error: function (response) {
                            a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1);
                            if(response.status == 422) {
                                if(response.responseJSON.errors.email) {
                                    // toastr.error(response.responseJSON.errors.first_name);
                                    i(l,"danger",response.responseJSON.errors.email);

                                }else if(response.responseJSON.errors.password) {
                                    // toastr.error(response.responseJSON.errors.first_name);
                                    i(l,"danger",response.responseJSON.errors.password);

                                }

                            }
                        }
                    }))
            }),
                $("#m_login_signup_submit").click(function(l){
                    l.preventDefault();
                    var t=$(this),
                        r=$(this).closest("form");
                    r.validate({
                        rules:{
                            name:{required:!0},
                            email:{required:!0,email:!0},
                            password:{required:!0},
                            rpassword:{required:!0},
                            agree:{required:!0}}
                    ,messages: {
                            name:{
                                required: "هذا الحقل مطلوب"
                            },
                            email:{
                                required: "هذا الحقل مطلوب",
                                email: "الرجاء إدخال الصيغد الصحيحد للبريد الإلكتروني"
                            },
                            password:{
                                required:"هذا الحقل مطلوب"
                            },
                            rpassword:{
                                required:"هذا الحقل مطلوب"
                            },
                            agree:{
                                required:"هذا الحقل مطلوب"
                            }

                        }}),
                    r.valid()&&(t.addClass("m-loader m-loader--right m-loader--light").attr("disabled",!0),
                        r.ajaxSubmit({
                            url:m_url+"/register",
                            success:function(l,s,n,o){
                                if(l.status == 1) {
                                    setTimeout(function(){
                                        t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),
                                            r.clearForm(),r.validate().resetForm(), a();
                                        var l=e.find(".m-login__signin form");
                                        l.clearForm(),
                                            l.validate().resetForm(),
                                            i(l,"success",l.msg)},2e3);
                                }else {
                                    setTimeout(() => {
                                        a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1);
                                        i(l,"danger",l.msg);
                                        // a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1);
                                        //     i(l,"danger","Incorrect username or password. Please try again.")
                                    },2e3);
                                }
                                // setTimeout(function(){
                                //     t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),
                                //         r.clearForm(),r.validate().resetForm(), a();
                                //     var l=e.find(".m-login__signin form");
                                //     l.clearForm(),
                                //         l.validate().resetForm(),
                                //         i(l,"success","Thank you. To complete your registration please check your email.")},2e3);
                            },error: function (response) {
                                a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1);
                                if(response.status == 422) {
                                    if(response.responseJSON.errors.name) {
                                        // toastr.error(response.responseJSON.errors.first_name);
                                        i(l,"danger",response.responseJSON.errors.name);

                                    }else if(response.responseJSON.errors.email) {
                                        // toastr.error(response.responseJSON.errors.first_name);
                                        i(l,"danger",response.responseJSON.errors.email);

                                    }else if(response.responseJSON.errors.password) {
                                        // toastr.error(response.responseJSON.errors.first_name);
                                        i(l,"danger",response.responseJSON.errors.password);

                                    }

                                }
                            }
                        }))}),$("#m_login_forget_password_submit").click(function(l){l.preventDefault();var t=$(this),r=$(this).closest("form");r.validate({rules:{email:{required:!0,email:!0}}}),r.valid()&&(t.addClass("m-loader m-loader--right m-loader--light").attr("disabled",!0),r.ajaxSubmit({url:"",success:function(l,s,n,o){setTimeout(function(){t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),r.clearForm(),r.validate().resetForm(),a();var l=e.find(".m-login__signin form");l.clearForm(),l.validate().resetForm(),i(l,"success","Cool! Password recovery instruction has been sent to your email.")},2e3)}}))})}}}();jQuery(document).ready(function(){SnippetLogin.init()});
