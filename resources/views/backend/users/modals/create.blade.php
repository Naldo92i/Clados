<div class="modal fade" id="modal" data-backdrop="static" data-backdrop-bg="bgc-grey-tp4" data-blur="true" style="display: none;" n="truearia-hidde">
    <div class="modal-dialog modal-dialog-centered" style="width: 1000px" role="document">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header">
                <h5 class="modal-title text-primary-d2" id="exampleModal2Label">
                    Ajouter un utilisateur
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-scroll">
                <form action="{{route('users.store')}}" method="POST" id="app-record-form-datatable">
                    @csrf
                    <div class="form-group ">
                        <label for=""><strong>NOM</strong></label>
                        <input name="firstname" type="text" class="form-control " id="id-form-field-1">
                        <span class="firstname_err error text-danger"></span>
                    </div>
                    <div class="form-group ">
                        <label for="">PRENOM</label>
                        <input name="lastname" type="text" class="form-control " id="id-form-field-1">
                        <span class="lastname_err error text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">TELEPHONE</label>
                        <input name="telephone" type="text" class="form-control " id="id-form-field-1">
                        <span class="telephone_err error text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="">ADRESSE EMAIL</label>
                        <input name="email" type="text" class="form-control " id="id-form-field-1">
                        <span class="email_err error text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="">ROLE</label>
                        <select class="form-control select2" name="role" id="mySelect2">
                            <option value="">--Veuillez choisir--</option>
                            @foreach($roles as $item)
                                <option value="{{$item->id}}">{{$item->display_name}}</option>
                            @endforeach
                        </select>
                        <span class="role_err error text-danger"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer bgc-default-l5">
                <button type="button" id="sender" class="btn btn-primary" onclick="storeRecord();">
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
        $("#mySelect2").select2({
            dropdownParent: $("#modal"),
            width: '100%',
        });
    });
</script>
