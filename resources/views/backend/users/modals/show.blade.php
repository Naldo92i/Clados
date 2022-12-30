<div class="modal fade" id="modal" data-backdrop="static" data-backdrop-bg="bgc-grey-tp4" data-blur="true" style="display: none;" n="truearia-hidde">
    <div class="modal-dialog modal-dialog-centered" style="width: 1000px" role="document">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header">
                <h5 class="modal-title text-primary-d2" id="exampleModal2Label">
                    Détails de l'utilisateur
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-scroll">
                <div class="form-group ">
                    <label for="">NOM</label>
                    <input disabled name="firstname" value="{{$user->firstname}}" type="text" class="form-control " id="id-form-field-1">
                    <span class="firstname_err error text-danger"></span>
                </div>
                <div class="form-group ">
                    <label for="">PRENOM</label>
                    <input disabled name="lastname" type="text" value="{{$user->lastname}}" class="form-control " id="id-form-field-1">
                    <span class="lastname_err error text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">TELEPHONE</label>
                    <input disabled name="telephone" type="text" value="{{$user->telephone}}" class="form-control " id="id-form-field-1">
                    <span class="telephone_err error text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="">ADRESSE EMAIL</label>
                    <input disabled name="email" type="text" value="{{$user->email}}" class="form-control " id="id-form-field-1">
                    <span class="email_err error text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="">ROLE</label>
                    <select disabled class="form-control select2" name="role" id="mySelect2">
                        <option value="">--Veuillez choisir--</option>
                        @foreach($roles as $item)
                            <option {{ $user->hasRole($item->name)? "selected":"" }} value="{{$item->id}}">{{$item->display_name}}</option>
                        @endforeach
                    </select>
                    <span class="role_err error text-danger"></span>
                </div>
            </div>

            <div class="modal-footer bgc-default-l5">
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
