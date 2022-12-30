<div class="modal fade" id="modal" data-backdrop="static" data-backdrop-bg="bgc-grey-tp4" data-blur="true" style="display: none;" n="truearia-hidde">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 800px" role="document">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header">
                <h5 class="modal-title text-primary-d2" id="exampleModal2Label">
                    Changer mon avatar
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-scroll">
                <form action="{{ route('avatar.change') }}" method="POST" id="app-create-record-form">
                    @csrf
                    <div class="p-3">
                        <div class="offset-sm-4 offset-xl-3 col-sm-8 col-lg-6">
                            <label class="ace-file-input ace-file-multiple">
                                <input name="image" type="file" class="form-control" id="id-field0" accept=".gif,.jpg,.jpeg,.png,.webp,.svg">
                                <span class="image_err error text-danger"></span>
                                <a title="" class="remove position-tr bgc-white text-danger mt-n25 mr-n25 w-4 h-4 text-center pt-2px radius-round border-2 brc-grey-m4 brc-h-danger-m3" href="#">
                                    <i class="fa fa-times"></i>
                                </a>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer bgc-default-l5">
                <button type="button" id="sender" class="btn btn-primary" onclick="profileStoreRecord();">
                    <span id="btn-load" class="spinner-border d-none spinner-border-sm" role="status" aria-hidden="true"> </span>
                    <b id="text-load" class="text-hide">Veuillez patienter</b>
                    <b id="text-fix">Enregistrer</b>
                </button>
                <button type="button" class="btn btn-lighter-grey px-4" data-dismiss="modal">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(function($) {
        var bodyContainer = document.querySelector('#modal')
        bodyContainer.style.overflow = 'visible'
        $('#id-field0').aceFileInput({
            style: 'drop',
            droppable: true,
            dropdownParent: $("#modal"),
            container: 'border-1 border-dashed brc-grey-m4 brc-h-warning-m1',
            placeholderClass: 'text-125 text-600 text-grey-l1 my-2',
            placeholderText: 'Drop profile image or click to choose',
            placeholderIcon: '<i class="fa fa-user fa-3x text-green-m3 my-2"></i>',
            thumbnail: 'large',
            allowExt: 'gif|jpg|jpeg|png|webp|svg'
        })
    })
</script>
