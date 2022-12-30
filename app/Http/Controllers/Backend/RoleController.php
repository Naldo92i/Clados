<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laratrust\Models\LaratrustRole;

class RoleController extends Controller
{
    public function datatables(){
        $roles = Role::all();
        return datatables()->of($roles)
            ->addColumn('action', function ($roles){
                return view('backend.roles.actions', ['roles'=>$roles]);
            })->toJson();
    }


    public function index(){
        $configs = DB::table('configs')->latest('id')->first();
        return view('backend.roles.index', compact('configs'));
    }


    public function create(){
        $permissions= Permission::all()->pluck('id','name')->toArray();
        $modules=config('clados.acl_models');
        return view('backend.roles.modals.create', ['permissions'=>$permissions,'modules'=>$modules]);
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => 'required|unique:roles,name,NULL,id',
            'display_name'=>'required',
            'permissions'=>'required'
        ],
            [
                'permissions.required'=>'Choisissez au moins une permissions.'
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $roles = new Role();
        $roles->name = $request->name;
        $roles->display_name = $request->display_name;
        $roles->description = $request->description;
        $roles->save();
        $roles->attachPermissions($request->permissions);

        activity("Audit")
            ->causedBy(Auth::user())
            ->performedOn($roles)
            ->withProperties([
                'Role' =>$roles
            ])
            ->log("Création de role: $roles->name ");
        return response()->json(['type' => 'success', 'message' => "Le rôle a été créé avec succès"]);

    }


    public function show($id){
        $role = Role::find($id);
        $modules=config('clados.acl_models');
        $permissions= Permission::all()->pluck('id','name')->toArray();
        return view('backend.roles.modals.view', ['role'=>$role,'permissions'=>$permissions,'modules'=>$modules]);
    }


    public function edit($id){
        $role = Role::find($id);
        $modules=config('clados.acl_models');
        $permissions= Permission::all()->pluck('id','name')->toArray();
        return view('backend.roles.modals.update',['role'=>$role,'permissions'=>$permissions,'modules'=>$modules]);
    }


    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "name" => 'required|unique:roles,name,'.$id.',id',
            'display_name'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $roles = Role::find($id);
        $roles->name =  $request->get('name');
        $roles->display_name = $request->get('display_name');
        $roles->description = $request->get('description');
        $roles->save();
        $roles->syncPermissions($request->permissions);

        activity("Audit")
            ->causedBy(Auth::user())
            ->performedOn($roles)
            ->withProperties([
                'Role' =>$roles
            ])
            ->log("Modification de role: $roles->name ");

        return response()->json(['type' => 'success', 'message' => "Le rôle a été modifié avec succès"]);
    }


    public function destroy($id){
        $role = Role::find($id);
        $log = ['Role' => $role];
        if($role){
            $role->delete();
            activity("Sécurité")
                ->causedBy(Auth::user())
                ->performedOn($role)
                ->withProperties([
                    'Role' =>$log
                ])
                ->log("Suppression de role: $role->name");
            return response()->json(['type' => 'success', 'message' => "Le rôle a été supprimé avec succès !"]);
        }else{
            return response()->json(['type' => 'error', 'message' => "Une erreur s'est produite !"]);
        }
    }
}
