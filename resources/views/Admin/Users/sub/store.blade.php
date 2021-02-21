<div class="modal fade" id="m_user_store_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">

            <form class="m-form" id="formUserStore">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة مستخدم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">



                    <div class="form-group m-form__group pb-0 pt-0">
                        <label class="form-control-label" for="name">الإسم بالكامل </label>
                        <input type="text" class="form-control m-input" name="name" id="name" placeholder="أدخل الإسم بالكامل">
{{--                        <div class="form-control-feedback"></div>--}}
                        <span class="m-form__help"></span>
                    </div>
                    <div class="form-group m-form__group  pb-0 pt-0">
                        <label class="form-control-label" for="name">إسم المستخدم</label>
                        <input type="text" class="form-control m-input" name="user_name" id="user_name" placeholder="أدخل إسم المستخدم">
{{--                        <div class="form-control-feedback"></div>--}}
                        <span class="m-form__help"></span>
                    </div>
                    <div class="form-group m-form__group  pb-0 pt-0">
                        <label class="form-control-label" for="name">البريد الإلكتروني</label>
                        <input type="text" class="form-control m-input" name="email" id="email" placeholder="أدخل البريد الإلكتروني">
{{--                        <div class="form-control-feedback"></div>--}}
                        <span class="m-form__help"></span>
                    </div>

                    <div class="form-group m-form__group  pb-0 pt-0">
                        <label class="form-control-label" for="name">رقم الهاتف</label>
                        <input type="text" class="form-control m-input" name="mobile" id="mobile"  placeholder="أدخل رقم الهاتف"  onkeypress="return isNumberKey(event)">
{{--                        <div class="form-control-feedback"></div>--}}
                        <span class="m-form__help"></span>
                    </div>
                    <div class="form-group m-form__group  pb-0 pt-0">
                        <label class="form-control-label" for="name">كلمة المرور</label>
                        <input type="password" class="form-control m-input" name="password" id="password" placeholder="أدخل كلمة المرور">
{{--                        <div class="form-control-feedback"></div>--}}
                        <span class="m-form__help"></span>
                    </div>
                    <div class="form-group m-form__group  pb-0 pt-0">
                        <label class="form-control-label" for="name">تأكيد كلمة المرور</label>
                        <input type="password" class="form-control m-input" name="cpassword" placeholder="أدخل تأكيد كلمة المرور">
{{--                        <div class="form-control-feedback"></div>--}}
                        <span class="m-form__help"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="user_id" value="0">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-success m-loader--light m-loader--left" id="submitUserStore">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
