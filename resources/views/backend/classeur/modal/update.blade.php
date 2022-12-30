<div class="modal fade" id="modal" data-backdrop="static" data-backdrop-bg="bgc-grey-tp4" data-blur="true" style="display: none;" n="truearia-hidde">
    <div class="modal-dialog modal-dialog-centered" style="width: 1000px" role="document">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header">
                <h5 class="modal-title text-primary-d2" id="exampleModal2Label">
                    Détails du classeur
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-scroll">
                <form action="{{route('classeur.update', $classeur->uuid)}}" method="POST" id="app-edit-record-form">
                    @method('PATCH')
                    @csrf
                    <div class="form-group ">
                        <label for=""><strong>TITRE CLASSEUR</strong></label>
                        <input type="text" value="{{ $classeur->title_classeur }}" name="titre" class="form-control " id="id-form-field-1">
                        <span class="titre_err error text-danger"></span>
                    </div>

                    <div class="form-group ">
                        <label for=""><strong>N° ETAGERE</strong></label>
                        <select name="niveau" class="form-control " id="id-form-field-1">
                                <option value="{{$etage->id}}">{{$etage->number_niveau}}</option>
                            @foreach ($niveaux as $niveau)
                                @if ($niveau->id != $etage->id)
                                    <option value="{{$niveau->id}}">{{$niveau->number_niveau}}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="niveau_err error text-danger"></span>
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

<script>
    jQuery(function($) {
        $("#mySelect2").select2({
            dropdownParent: $("#modal"),
            width: '100%',
        });
    });
</script>
