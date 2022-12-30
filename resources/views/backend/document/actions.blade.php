
<div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn-sm btn btn-dark font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="flaticon2-gear"></span>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        @permission('document-modifier')
        <a class="dropdown-item btn" onclick="editRecord('{{route('document.edit', $documents->uuid)}}')"><span class="flaticon-edit-1 mr-2"></span> Modifier</a>
        @endpermission

        @permission('document-supprimer')
        <a class="dropdown-item btn" onclick="deleteRecordConfirm('{{route('document.destroy', $documents->uuid)}}')" ><span class="flaticon2-trash mr-2"></span> Supprimer</a>
        @endpermission
        @isset($documents->fichier)
            <a class="dropdown-item btn" target="_blank" href="{{ url('/custom/documents/'.$documents->fichier) }}"><span class="flaticon2-eye mr-2"></span> Voir fichier</a>
        @endisset
    </div>
</div>