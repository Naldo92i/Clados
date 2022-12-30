@extends('backend.layouts.app')
@section('title', "CLADOS - Gestion des utilisateurs")
@section('content')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Liste des utilisateurs</h5>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex flex-column-fluid">
        <div class="container col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-toolbar">
                        @permission('utilisateur-créer')
                        <button onclick="createRecord('{{route('users.create')}}')" class="btn px-4 btn-dark mb-1">
                            <i class="fa fa-plus-circle"></i>
                            Ajouter un utilisateur
                        </button>
                        @endpermission
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped bgc-grey-l4 text-100 border-b-1" id="app-datatable">
                        <thead>
                            <tr>
                                <th><strong>NOM & PRENOM</strong></th>
                                <th><strong>CONTACTS</strong></th>
                                <th><strong>ROLE</strong></th>
                                <th><strong>STATUT</strong></th>
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
            ajax: '{!! route('users.datatables') !!}',
            columns: [
                {data: 'id', name: 'id',
                    render: function render(data, type, full, meta) {
                        return  '<span style="width: 250px;">' +
                            '<div class="d-flex align-items-center">'+
                            '<div class="symbol symbol-40 symbol-sm flex-shrink-0">'+
                            '<span class="flaticon-user-settings fa-3x"></span>'+
                            '</div>'+
                            '<div class="ml-4">'+
                            '<div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'+full.firstname+'</div>'+
                            '<a class="text-muted font-weight-bold text-hover-primary">'+full.lastname+'</a>'+
                            '</div>'+
                            '</div>'+
                            '</span>';
                    }
                },
                {data: 'telephone', name: 'telephone',
                    render: function render(data, type, full, meta) {
                        return  '<span style="width: 250px;">' +
                            '<div class="d-flex align-items-center">'+
                            '<div class="ml-0">'+
                            '<div class="text-dark-75 font-weight-bolder font-size-lg mb-0">Tel: '+data+'</div>'+
                            '<a class="text-muted font-weight-bold text-hover-primary">Email: '+full.email+'</a>'+
                            '</div>'+
                            '</div>'+
                            '</span>';
                    }
                },
                {data: 'roles', name: 'roles.display_name'},
                {data: 'status', name: 'status',
                    render: function render(data, type, full, meta) {
                        var status = ' ';
                        var label;
                        var value = data;
                        switch(value) {
                            case "Actif":
                                label = "bg-success";
                                break;
                            case "Inactif":
                                label = "bg-danger";
                                break;
                            default:
                                label = "bg-primary";
                        }

                        if (typeof value === 'undefined') {
                            return value;
                        }
                        status = status + ' ' + '<span class="badge text-white ' + label + ' ">' + value + '</span>';

                        return status;

                    }
                },
                {data: 'action', name: 'action',width:100},
            ],
            columnDefs: [{
                targets: -3,
                render: function render(data, type, full, meta) {
                    var roles = ' ';
                    for(var keys in data){
                        var label;
                        var value = data[keys].display_name;
                        switch(value) {
                            case "Superadministrateur":
                                label = "bg-danger";
                                break;
                            case "Administrateur":
                                label = "bg-success";
                                break;
                            case "Agent-relai":
                                label = "bg-info";
                                break;
                            default:
                                label = "bg-warning";
                        }

                        if (typeof value === 'undefined') {
                            return value;
                        }
                        roles = roles + ' ' + '<span class="badge text-white ' + label + ' ">' + value + '</span>';
                    }
                    return roles;

                }
            }],
        });
    </script>
@endsection
