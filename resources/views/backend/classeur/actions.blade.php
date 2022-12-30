@permission('classeur-modifier|classeur-supprimer')
<div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn-sm btn btn-dark font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="flaticon2-gear"></span>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        @permission('classeur-modifier')
        <a class="dropdown-item btn" onclick="editRecord('{{route('classeur.edit', $classeurs->uuid)}}')"><span class="flaticon-edit-1 mr-2"></span> Modifier</a>
        @endpermission
        
        @permission('classeur-supprimer')
        <a class="dropdown-item btn" onclick="deleteRecordConfirm('{{route('classeur.destroy', $classeurs->uuid)}}')" ><span class="flaticon2-trash mr-2"></span> Supprimer</a>
        @endpermission
    </div>
</div>
@endpermission