<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ConfigController extends Controller
{
    public function index(){
        $configs = DB::table('configs')->latest('id')->first();
        return view('backend.config.index', compact('configs'));
    }

    
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150|string',
            'telephone' => 'required|numeric',
            'code' => 'required|numeric|max:999',
            'address' => 'required|max:300|string',
            'image' => ['nullable', 'file', 'image', 'min:0', 'max:12287'],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        $config = DB::table('configs')->latest('id')->first();

        $configs = Config::find($config->id);
        $configs->name      = $request->name;
        $configs->number         = $request->telephone;
        $configs->code         = $request->code;
        $configs->address         = $request->address;
        //$configs->created_by     = Auth::user()->getAuthIdentifier();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $photo = $file->hashName();
            $path2 = public_path() . '/custom/configs/';
            $file->move($path2, $photo);
            $configs->logo           = $photo;
        }
        $configs->save();

        activity("Modification")
            ->causedBy(Auth::user())
            ->performedOn($configs)
            ->withProperties([
                'Nom de l\'entreprise'      =>$configs->name,
                'Numéro de télpéhonne'      =>$configs->number,
                'Code du pays'              =>$configs->code,
                'Adresse'                   =>$configs->address,
                'Logo'                      =>$configs->logo,
            ])
            ->log("Modification des configurations...");

        return response()->json(['type' => 'success', 'message' => "Configurations modifiées avec succès !"]);

    }
    
}
