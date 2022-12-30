<div class="modal fade" id="modal" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow radius-1">
            <div class="modal-header">
                <h5 class="modal-title text-primary-d2" id="exampleModal2Label">
                    Détails du rôle
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-body modal-scroll">
                <form action="{{route('roles.update', $role->id)}}" method="post" id="app-edit-record-form">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-custom" style="border: solid; border-color: black">
                                <div class="card-header">
                                    <h5 class="card-title text-primary"><i class="fas fa-shield-alt"></i> Rôle</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for=""><strong>CODE</strong></label>
                                        <input value="{{$role->name}}" name="name" type="text" class="form-control " id="id-form-field-1">
                                        <span class="name_err error text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">LIBELLE</label>
                                        <input value="{{$role->display_name}}" name="display_name" type="text" class="form-control " id="id-form-field-1">
                                        <span class="display_name_err error text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">DESCRPTION</label>
                                        <textarea class="form-control" name="description" id="">{{$role->description}}</textarea>
                                        <span class="description_err error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="card card-custom" style="border: solid; border-color: black">
                                <div class="card-header">
                                    <h5 class="card-title text-primary"><i class="fas fa-fingerprint"></i> Droits d'accès</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th></th>
                                            <th>Créer</th>
                                            <th>Lire</th>
                                            <th>Modifier</th>
                                            <th>Supprimer</th>
                                        </tr>
                                        @foreach($modules as $module)
                                            <tr>
                                                <th>{{ ucfirst($module)}}</th>
                                                <td>
                                                    @if (array_key_exists($module.'-créer',$permissions))
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox checkbox-lg">
                                                                <input name="permissions[]"  type="checkbox" {{ ($role->hasPermission($module.'-creer') ? 'checked' : '') }} name="permissions[]" value="{{ $module.'-creer' }}" >
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (array_key_exists($module.'-lire',$permissions))
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox checkbox-lg">
                                                                <input name="permissions[]" type="checkbox" {{ ($role->hasPermission($module.'-lire') ? 'checked' : '') }} name="permissions[]" value="{{ $module.'-lire' }}" >
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (array_key_exists($module.'-modifier',$permissions))
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox checkbox-lg">
                                                                <input name="permissions[]"  type="checkbox" {{ ($role->hasPermission($module.'-modifier') ? 'checked' : '') }} name="permissions[]" value="{{ $module.'-modifier' }}" >
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (array_key_exists($module.'-supprimer',$permissions))
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox checkbox-lg">
                                                                <input name="permissions[]" type="checkbox" {{ ($role->hasPermission($module.'-supprimer') ? 'checked' : '') }} name="permissions[]" value="{{ $module.'-supprimer' }}">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
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
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>
