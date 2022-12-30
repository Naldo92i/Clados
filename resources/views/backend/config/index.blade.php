@extends('backend.layouts.app')
@section('title', 'CLADOS - Configurations')
@section('content')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Configurations de la plateforme</h5>
                </div>
            </div>
        </div>
    </div>




    <div class="d-flex flex-column-fluid">
        <div class="container col-md-12">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card card-custom">
                        <div class="card-header">
                            <span class="card-title">Informations sur la structure</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('config.update')}}" method="POST" id="app-create-record-form">
                                @csrf
                            <div class="form-group form-row">
                                <div class="col">
                                    <label >Nom de l'entreprise</label>
                                    <input name="name" class="form-control form-control" value="{{$configs->name}}" placeholder="Nom de l'entreprise">
                                    <span class="name_err error text-danger"></span>
                                </div>

                                <div class="col">
                                    <label for="">Numéro de téléphonne</label>
                                    <input name="telephone" value="{{$configs->number}}" class="form-control form-control" placeholder="Numero">
                                    <span class="telephone_err error text-danger"></span>
                                </div>

                                <div class="col">
                                    <label for="">Code du numéro</label>
                                    <input name="code" value="{{$configs->code}}" class="form-control form-control" placeholder="Code">
                                    <span class="code_err error text-danger"></span>
                                </div>
                            </div>

                            <hr />
                            <div class="form-row ">
                                <div class="col">
                                    <img src="{{asset('custom/configs/'.$configs->logo)}}" alt="" style="width: 170px">
                                </div>
                                <div class="col">
                                    <label >Logo </label>
                                    <input type="file" name="image" class="form-control form-control">
                                    <span class="image_err error text-danger"></span>
                                </div>
                                <div class="col"></div>
                            </div>

                            <div class="form-row ">
                                <div class="col">
                                    <label >Adresse </label>
                                    <textarea name="address" class="form-control" id="">{{$configs->address}}</textarea>
                                    <span class="address_err error text-danger"></span>
                                </div>
                            </div>
                        </form>
                        </div>
                        @permission('config-modifier')
                        <div class="card-footer">
                            <button type="button" id="sender" class="btn btn-primary" onclick="configStoreRecord();">
                                <span id="btn-load" class="spinner-border d-none spinner-border-sm" role="status" aria-hidden="true"> </span>
                                <b id="text-load" class="text-hide">Veuillez patienter</b>
                                <b id="text-fix">Enregistrer</b>
                            </button>
                        </div>
                        @endpermission
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="app-modal-container"></div>
    <form>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    </form>
@endsection

@section('js')
<script src="{{asset('backend/js/script.js')}}"></script>
@endsection
