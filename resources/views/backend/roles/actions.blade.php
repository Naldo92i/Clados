<button onclick="editRecord('{{route('roles.show', $roles->id)}}')" title="Détails"  class="btn btn-sm btn-outline-primary"><span class="flaticon-eye"></span></button>

@permission('role-modifier')
<button onclick="editRecord('{{route('roles.edit', $roles->id)}}')" title="Modifier" class="btn btn-sm btn-outline-warning"><span class="flaticon-edit"></span></button>
@endpermission

@permission('role-supprimer')
<button onclick="deleteRecordConfirm('{{route('roles.destroy', $roles->id)}}')" title="Supprimer"  class="btn btn-outline-danger btn-sm"><span class="flaticon2-trash"></span></button>
@endpermission
