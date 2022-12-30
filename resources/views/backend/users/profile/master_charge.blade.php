<div class="modal fade" id="modal" data-backdrop="static" data-backdrop-bg="bgc-grey-tp4" data-blur="true" style="display: none;" n="truearia-hidde">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 800px" role="document">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header">
                <h5 class="modal-title text-primary-d2" id="exampleModal2Label">
                    Chargement de compte :<span class="m-1 badge bgc-white border-1 border-l-4 brc-primary-m2 btn-text-primary">Master</span>
                    depuis la banque <i class="fa fa-building"></i>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-scroll">
                <form action="{{route('master.charge.store')}}" method="POST" id="app-edit-record-form">
                    @method('PATCH')
                    @csrf
                    <div class="p-3">
                        <div class="form-row">
                            <div class="col">
                                <label for="">MONTANT ACTUEL</label>
                                <h4 class="@if($amount->amount == 0) text-danger @else text-success @endif text-160"><strong>{{number_format($amount->amount,0, '.',' ')}} Fcfa</strong></h4>
                            </div>
                            <div class="col">
                                <label for="">SOMME À CHARGER</label>
                                <input type="text" class="form-control" name="somme" placeholder="SOMME">
                                <span class="somme_err error text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="form-row">
                            <div class="col">
                                <label for="">NOM DE LA BANQUE</label>
                                <input type="text" class="form-control" name="name" placeholder="BANQUE">
                                <span class="name_err error text-danger"></span>
                            </div>
                            <div class="col">
                                <label for="">NUMERO DE L'OPÉRATION</label>
                                <input type="text" class="form-control" name="number" placeholder="NUMERO">
                                <span class="number_err error text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="form-row">
                            <div class="col">
                                <label for="">COMMENTAIRE</label>
                                <textarea name="comment" id="" class="form-control"></textarea>
                                <span class="comment_err error text-danger"></span>
                            </div>
                        </div>
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
        $("#mySelect1").select2({
            dropdownParent: $("#modal"),
            width: '100%',
        });
    });
</script>
