<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Doctrine\DBAL\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function datatables(){
        $users = User::with('roles')->with('roles');
        return datatables()->of($users)
            ->addColumn('action', function ($users) {
                return view('backend.users.actions',['users'=>$users]);
            })->toJson();
    }


    public function index(){
        $configs = DB::table('configs')->latest('id')->first();
        return view('backend.users.index', compact('configs'));
    }


    public function create(){
        $roles = Role::all();
        return view('backend.users.modals.create',  ['roles'=>$roles]);
    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            "firstname" => 'required',
            "lastname" => 'required',
            "telephone" => 'required|numeric|unique:users,telephone,NULL,id,deleted_at,NULL',
            "email" => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            "role" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->password = Hash::make('password');
        $user->save();

        $user->attachRole($request->role);
        activity("Audit")
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'Nom' =>$user->firstname,
                'Prenom'  =>$user->lastname,
                'Adresse email'     =>$user->email,
                'Telephone'    =>$user->telephone,
                'Statut' => $user->status
            ])
            ->log("Création de compte utilisateur ".$user->firstname.' '.$user->lastname);

        return response()->json(['type' => 'success', 'message' => "L'utilisateur a été créé avec succès"]);

    }


    public function show($id){
        $user = User::find($id);
        if($user){
            $roles = Role::all();
            return view('backend.users.modals.show', ['user'=>$user, 'roles'=>$roles]);
        }else{
            return response()->json(['type' => 'error', 'message' => "Une erreur est survenue !"]);
        }
    }


    public function edit($id){
        $user = User::find($id);
        if($user){
            $roles = Role::all();
            return view('backend.users.modals.update', ['user'=>$user, 'roles'=>$roles]);
        }else{
            return response()->json(['type' => 'error', 'message' => "Une erreur est survenue !"]);
        }
    }


    public function update(Request $request, User $user){
        $validator = Validator::make($request->all(), [
            "firstname" => 'required',
            "lastname" => 'required',
            "telephone" => 'required|unique:users,telephone,'.$user->id.',id,deleted_at,NULL',
            "email" => 'required|unique:users,email,'.$user->id.',id,deleted_at,NULL',
            "role" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $previous = [
            'Nom' =>$user->firstname,
            'Prenom'  =>$user->lastname,
            'Adresse email'     =>$user->email,
            'Telephone'    =>$user->telephone,
            'Statut' => $user->status
        ];

        if ($user){
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->telephone = $request->telephone;
            $user->email = $request->email;
            $user->save();
            $user->syncRoles([$request->role]);

            activity("Modification d'un compte")
                ->causedBy(Auth::user())
                ->performedOn($user)
                ->withProperties([
                    'previous'=>$previous,
                    'new'=>[
                        'Nom' =>$user->firstname,
                        'Prenom'  =>$user->lastname,
                        'Adresse email'     =>$user->email,
                        'Telephone'    =>$user->telephone,
                        'Statut' => $user->status
                    ]
                ])
                ->log("Modification de compte utilisateur ".$user->firstname.' '.$user->lastname);

            return response()->json(['type' => 'success', 'message' => "L'utilisateur a été modifié avec succès !"]);
        }else{
            return response()->json(['type' => 'error', 'message' => "Une erreur est survenue !"]);
        }
    }


    public function status(User $user){
        $user->status=='Actif'?$user->status='Inactif':$user->status='Actif';
        $user->save();

        activity("Changement de statut d'un compte")
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'Nom' =>$user->firstname,
                'Prenom'  =>$user->lastname,
                'Adresse email'     =>$user->email,
                'Telephone'    =>$user->telephone,
                'Statut' => $user->status
            ])
            ->log("Changement de statut de compte ".$user->firstname.' '.$user->lastname.' '.'en'.' '.$user->status);

        return response()->json(['type' => 'success', 'message' => "Status changé avec succès !"]);
    }


    public function profile(){
        $configs = DB::table('configs')->latest('id')->first();
        $user = User::where('id', Auth::user()->id);
        return view('backend.users.profile.index', compact('configs'));
    }


    public function avatar(){
        $user = User::find(Auth::user()->id);
        if ($user){
            return view('backend.users.profile.avatar');
        }else{
            return response()->json(['type' => 'error', 'message' => "Une erreur est survenue !"]);
        }
    }

    
    public function changeAvatar(Request $request){
        $user = User::where('id', Auth::user()->id)->first();

        $validator = Validator::make($request->all(), [
            'image' => ['nullable', 'file', 'image', 'min:0', 'max:12287'],
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $photo = $file->hashName();
            $path2 = public_path() . '/custom/users/'.$user->email.'/';
            $file->move($path2, $photo);
            $user->avatar           = $photo;
        }
        $user->save();

        activity("Modification de l'avatar de l'utilisateur")
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'Nom d\'utilisateur'  =>$user->username,
                'Nom' =>$user->firstname,
                'Prenom'  =>$user->lastname,
                'Adresse email'     =>$user->email,
                'Telephone'    =>$user->msisdn,
                'Statut' => $user->status
            ])
            ->log("Modification de l'avatar de utilisateur ".$user->firstname.' '.$user->lastname);

        return response()->json(['type' => 'success', 'message' => "Avatar changé avec succès !"]);
    }



    public function password(){
        return view('backend.users.profile.password');
    }

    public function passwordReset(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $validator = Validator::make($request->all(),[
            'ancien' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Ancien mot de passe incorrect !');
                    }
                },
            ],
            "nouveau"         => 'required|different:ancien',
            "renouveau"          => 'required|same:nouveau',
        ],
            [
                'ancien.required' => "Entrez l'ancien mot de passe !",
                'nouveau.required' => "Entrez le nouveau mot de passe !",
                'renouveau.required' => "Entrez à nouveau le nouveau mot de passe !",
                'nouveau.different' => 'Nouveau et ancien mot de passe identiques !',
                'renouveau.same' => 'Les nouveaus mots de passe ne sont pas identiques !',
            ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $password = $request->nouveau;
        $name = $user->name;
        $mail = $user->email;

        $user->password   = Hash::make($request->nouveau);
        $user->save();

        Hash::check($request->password, $user->password);
        $user->fill([
            'password' => Hash::make($request->nouveau)
        ])->save();

        activity("Réinitialisation de mot de passe")
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'Nom d\'utilisateur'  =>$user->username,
                'Nom' =>$user->firstname,
                'Prenom'  =>$user->lastname,
                'Adresse email'     =>$user->email,
                'Telephone'    =>$user->msisdn,
                'Statut' => $user->status
            ])
            ->log("Réinitialisation de mot de passe de utilisateur ".$user->firstname.' '.$user->lastname);

        return response()->json(['type' => 'success', 'message' => "Mot de passe changé avec succès !"]);
    }
}
