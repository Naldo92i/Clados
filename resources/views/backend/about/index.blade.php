@extends('backend.layouts.app')
@section('title', "Administration - A propos")
@section('content')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Menu A propos</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column-fluid">
        <div class="container col-md-12">
            <div class="card custom-card">

                <div class="card-body">
                    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <div class="d-flex align-items-center flex-wrap mr-1">
                            <div class="d-flex align-items-baseline flex-wrap mr-5">
                                <h5 class="text-dark font-weight-bold my-1 mr-5">Modifier le slider</h5>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <button id="sender" onclick="aboutStoreRecord()" class="btn btn-primary font-weight-bolder">
                                <strong>
                                    <b id="text-load" class="text-hide">Veuillez patienter...</b>
                                    <b id="text-fix"><span class="flaticon-plus"></span> Enregistrer</b>
                                </strong>
                            </button>
                        </div>
                    </div>

    <div class="d-flex flex-column-fluid">
        <div class="container col-md-12">
            <form method="POST" action="{{route('admin.about.update') }}" id="esta-create-record-form">
                @csrf
                <div class="row justify-content-center">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label"><span class="flaticon-information"></span> Détails du menu</h3>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Titre du menu</label>
                                    <input name="titre" type="text" class="form-control" placeholder="Titre du menu">
                                    <span class="error titre_err text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label>Contenu</label>
                                        <textarea id="summernote">
                                          Place <em>some</em> <u>text</u> <strong>here</strong>
                                        </textarea>
                                    <span class="error content_err text-danger"></span>
                                </div>

                            </div>
                        </div>

                </div>
            </form>
        </div>
    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
