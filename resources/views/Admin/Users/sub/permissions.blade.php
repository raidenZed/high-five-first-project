<div class="modal fade" id="m_user_permissions_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form class="m-form" id="formPermission">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">الصلاحيات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="permissionView">

                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="user_id_permission">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-success m-loader--light m-loader--left" id="submitUserPermission">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
