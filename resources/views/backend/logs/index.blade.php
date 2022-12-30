@extends('backend.layouts.app')
@section('title', 'CLADOS - Liste des logs')
@section('content')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Liste des logs</h5>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex flex-column-fluid">
        <div class="container col-md-12">
            <div class="card card-custom">

                <div class="card-body">
                    <table id="app-datatable" class="table dt-responsive text-black table-bordered table-striped bgc-grey-l4 text-100 border-b-1" >
                        <thead style="border-color:#2a80c8">
                        <tr>
                            <th><strong>NOM</strong></th>
                            <th><strong>DESCRIPTION</strong></th>
                            <th><strong>OBJECT IMPACTÉ</strong></th>
                            <th><strong>ID OBJECT</strong></th>
                            <th><strong>DÉCLENCHEUR</strong></th>
                            <th><strong>DATE</strong></th>
                            <th><strong>ACTIONS</strong></th>
                        </tr>
                        </thead>
                    </table>
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
    <script>
        $('#app-datatable').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'serverSide': false,

            language: {
                processing: "Traitement en cours...",
                search: "Recherche &nbsp; :",
                lengthMenu:     "Afficher _MENU_ &eacute;l&eacute;ments",
                info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                loadingRecords: "Chargement en cours...",
                zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable:     "Aucune donnée disponible dans le tableau",
                paginate: {
                    first: "<<",
                    previous: "Précédent",
                    next: "Suivant",
                    last: ">>"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            },
            ajax: '{!! route('logs.datatables') !!}',
            columns: [
                {data: 'log_name', name: 'log_name'},
                {data: 'description', name: 'description'},
                {data: 'subject_type', name: 'subject_type'},
                {data: 'subject_id', name: 'subject_id'},
                {data: 'full_name', name: 'full_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action',width:80},
            ]
        });
    </script>
@endsection
