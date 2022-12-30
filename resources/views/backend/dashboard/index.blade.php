@extends('backend.layouts.app')
@section('title', "CLADOS - Tableau de bord")
@section('content')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tableau de bord</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column-fluid">
        <div class="container col-md-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <a class="text-center text-hover-primary font-weight-bold h3 mt-1">Locaux</a>
                            <div class="text-dark font-weight-bolder font-size-h2 mt-0"><span class="fa fa-building fa-2x mr-2"></span> {{number_format($locaux)}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <a class="text-center text-hover-primary font-weight-bold h3 mt-1">Etagères</a>
                            <div class="text-dark font-weight-bolder font-size-h2 mt-0"><span class="fab fa-buffer fa-2x mr-2"></span> {{number_format($etageres)}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <a class="text-center text-hover-primary font-weight-bold h3 mt-1">Classeurs</a>
                            <div class="text-dark font-weight-bolder font-size-h2 mt-0"><span class="fab fa-buromobelexperte fa-2x mr-2"></span> {{number_format($classeurs)}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <a class="text-center text-hover-primary font-weight-bold h3 mt-1">Documents</a>
                            <div class="text-dark font-weight-bolder font-size-h2 mt-0"><span class="fa fa-file fa-2x mr-2"></span> {{number_format($documents)}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <a class="text-center text-hover-primary font-weight-bold h3 mt-1">Utilisateurs</a>
                            <div class="text-dark font-weight-bolder font-size-h2 mt-0"><span class="fa fa-users fa-2x mr-2"></span> {{number_format($users)}}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
