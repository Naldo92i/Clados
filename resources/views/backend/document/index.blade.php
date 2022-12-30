@extends('backend.layouts.app')
@section('title', "Gestion des classeurs")
@section('content')

    <div class="d-flex flex-column-fluid">
        <div class="container col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-toolbar">
                        <div class="row">
                            <div class="col">
                                <h5 class="text-dark font-weight-bold my-1 mr-5">Liste des Documents</h5>
                            </div>
                            @permission('document-créer')
                            <div class="col">
                                <button onclick="createRecord('{{route('document.create')}}')" class="btn btn-dark btn-flat">
                                    <i class="fa fa-plus-circle"></i><strong> Ajouter</strong>
                                </button>
                            </div>
                            @endpermission
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped bgc-grey-l4 text-100 border-b-1" id="app-datatable">
                        <thead>
                        <tr>
                            <th><strong>LOCAL</strong></th>
                            <th><strong>N° ETAGERE</strong></th>
                            <th><strong>N° NIVEAU</strong></th>
                            <th><strong>N° CLASSEUR</strong></th>
                            <th><strong>TITRE CLASSEUR</strong></th>
                            <th><strong>TITRE DOCUMENT</strong></th>
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
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,

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
            ajax: '{!! route('document.datatables') !!}',
            columns: [
                {data: 'title_local', name: 'title_local',width:100},
                {data: 'number_etagere', name: 'number_etagere',width:100},
                {data: 'number_niveau', name: 'number_niveau',width:100},
                {data: 'number_classeur', name: 'number_classeur',width:100},
                {data: 'title_classeur', name: 'title_classeur',width:100},
                {data: 'title_document', name: 'title_document',width:100},
                {data: 'action', name: 'action',width:100},
            ],
        });
    </script>
@endsection
