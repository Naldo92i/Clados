<div class="modal fade" id="modal" data-backdrop="static" data-backdrop-bg="bgc-grey-tp4" data-blur="true" style="display: none;" n="truearia-hidde">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header">
                <h5 class="modal-title text-primary-d2" id="exampleModal2Label">
                    Changer mon mot de passe
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-scroll">
                <form action="{{route('password.reset', Auth::user()->id)}}" method="POST" id="app-record-form-datatable" >
                    @csrf
                    <div class="form-group">
                        <label for="">ANCIEN MOT DE PASSE</label>
                        <input required class="form-control" name="ancien" id="password" type="password">
                        <span class="ancien_err error text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">NOUVEAU MOT DE PASSE</label>
                        <input required class="form-control" name="nouveau"  id="new_password" type="password">
                        <span class="nouveau_err error text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">CONFIRMER NOUVEAU MOT DE PASSE</label>
                        <input required class="form-control" name="renouveau" id="new_confirm_password" type="password">
                        <span class="renouveau_err error text-danger"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer bgc-default-l5">
                <button type="button" id="sender" class="btn btn-primary" onclick="storeRecord();">
                    <span id="btn-load" class="spinner-border d-none spinner-border-sm" role="status" aria-hidden="true"> </span>
                    <b id="text-load" class="text-hide">Veuillez patienter</b>
                    <b id="text-fix">Enregistrer</b>
                </button>
                <button type="button" class="btn btn-outline-danger px-4" data-dismiss="modal">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

