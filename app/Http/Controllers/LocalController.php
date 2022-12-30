<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LocalController extends Controller
{
    public function datatable(){
        return datatables()->of(Local::all())
            ->addColumn('action', function($locaux){
                return view('backend.locaux.actions', ['locaux'=>$locaux]);
            })->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = DB::table('configs')->latest('id')->first();
        return view('backend.locaux.index', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.locaux.modal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        
        $local = new Local();
        $local->title_local = $request->name;
        $local->created_by     = Auth::user()->getAuthIdentifier();
        $local->save();
        $local->number_local = 'L00'.$local->id;
        $local->save();

        activity("Création")
            ->causedBy(Auth::user())
            ->performedOn($local)
            ->withProperties([
                'Nom' =>$local->title_local,
                'Numero serie'  =>$local->number_local
            ])
            ->log("Création de local ".$local->number_local);

        return response()->json(['type' => 'success', 'message' => "Le local a été créé avec succès"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function show(Local $local)
    {
        return view('backend.locaux.modal.update', compact('local'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function edit(Local $local)
    {
        return view('backend.locaux.modal.update', compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocalRequest  $request
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Local $local)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        
        $local->title_local = $request->name;
        $local->save();
        
        activity("Modification")
            ->causedBy(Auth::user())
            ->performedOn($local)
            ->withProperties([
                'Nom' =>$local->title_local,
            ])
            ->log("Modification du local ".$local->number_local);
            
        return response()->json(['type' => 'success', 'message' => "Local modifié avec succès !"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function destroy(Local $local)
    {
        $local->delete();
        
        activity("Suppression")
            ->causedBy(Auth::user())
            ->performedOn($local)
            ->withProperties([
                'Nom' =>$local->title_local,
            ])
            ->log("Suppression du local ".$local->number_local);
            
        return response()->json(['type' => 'success', 'message' => "Le local a été supprimé avec succès !"]);
    }
}
