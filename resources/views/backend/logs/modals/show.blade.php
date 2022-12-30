<div class="modal hide fade" id="modal" data-backdrop="static" data-backdrop-bg="bgc-grey-tp4" data-blur="true" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width: 1000px">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header">
                <h5 class="modal-title text-primary-d2" id="exampleModal2Label">
                    Détails du log <i class="fa fa-terminal"></i>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-scroll">
                <div class="form-group row">
                    <div class="form-group col-md-6">
                        <label for=""><strong>NOM</strong></label>
                        <input type="text" class="form-control" readonly value="{{$log->log_name}}" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">DESCRIPTION</label>
                        <input type="text" class="form-control" readonly value="{{$log->description}}" id="id-form-field-1">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">DÉCLENCHEUR</label>
                        <input type="text" class="form-control" readonly value="{{$log->full_name}}" id="id-form-field-1">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">DATE</label>
                        <input type="text" class="form-control" readonly value="{{$log->created_at}}" id="id-form-field-1">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">OBJET IMPACTÉ</label>
                        <input type="text" class="form-control" readonly value="{{$log->subject_type}}" id="id-form-field-1">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">ID OBJET</label>
                        <input type="text" class="form-control" readonly value="{{$log->subject_id}}" id="id-form-field-1">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">DÉTAILS</label>
                        <code>
                            <textarea name="description" readonly class="form-control" id="">{{$log->properties}}</textarea>
                        </code>
                    </div>
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
