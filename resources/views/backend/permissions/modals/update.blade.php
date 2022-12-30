<div class="modal hide fade" id="modal" data-backdrop="static" data-backdrop-bg="bgc-grey-tp4" data-blur="true" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header">
                <h5 class="modal-title text-primary-d2" id="exampleModal2Label">
                    Modifier une permission
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-scroll">
                <form action="{{route('permissions.update', $permission->id)}}" method="POST" id="app-edit-record-form">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="form-group">
                        <label for=""><strong>CODE</strong></label>
                        <input name="name" value="{{$permission->name}}" type="text" class="form-control " id="id-form-field-1">
                        <span class="name_err error text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">LIBELLE</label>
                        <input name="display_name" value="{{$permission->display_name}}" type="text" class="form-control " id="id-form-field-1">
                        <span class="display_name_err error text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">MOT DE PASSE</label>
                        <textarea name="description" class="form-control" id="">{{$permission->description}}</textarea>
                        <span class="description_err error text-danger"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer bgc-default-l5">
                <button type="button" id="sender" class="btn btn-primary" onclick="updateRecord();">
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
