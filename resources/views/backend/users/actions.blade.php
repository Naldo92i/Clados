<a onclick="editRecord('{{route('users.show', $users->id)}}')" class="btn btn-outline-info btn-sm"><span class="flaticon-eye"></span></a>

@permission('utilisateur-modifier')
<div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn-sm btn btn-dark font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="flaticon2-gear"></span>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        <a class="dropdown-item btn" onclick="editRecord('{{route('users.edit', $users->id)}}')"><span class="flaticon-edit-1 mr-2"></span> Modifier</a>
        @if(Auth::user()->id != $users->id)
            <a class="dropdown-item btn" onclick="statusConfirm('{{route('users.status', $users->id)}}')"><span class="flaticon2-{{$users->status=='Actif'?'cancel':'check-mark'}} mr-2"></span> {{$users->status=='Actif'?'Désactiver':'Activer'}}</a>
        @endif
    </div>
</div>
@endpermission