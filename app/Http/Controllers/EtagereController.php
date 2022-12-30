<?php

namespace App\Http\Controllers;

use App\Models\Etagere;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EtagereController extends Controller
{
    public function datatable(){
        $etageres = DB::table('etageres')
            ->join('locals', 'locals.id', '=', 'etageres.id_local')
            ->select('etageres.number_etagere', 'locals.title_local', 
                    'locals.number_local', 'etageres.uuid')
            ->get();

        return datatables()->of($etageres)
            ->addColumn('action', function($etageres){
                return view('backend.etageres.actions', ['etageres'=>$etageres]);
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
        return view('backend.etageres.index', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locaux = Local::all();
        return view('backend.etageres.modal.create', compact('locaux'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEtagereRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "local" => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        
        $etagere = new Etagere();
        $etagere->id_local = $request->local;
        $etagere->created_by     = Auth::user()->getAuthIdentifier();
        $etagere->save();
        $etagere->number_etagere = 'E00'.$etagere->id;
        $etagere->save();

        activity("Création")
            ->causedBy(Auth::user())
            ->performedOn($etagere)
            ->withProperties([
                'Numero serie'  =>$etagere->number_etagere,
            ])
            ->log("Création de l'étagère ".$etagere->number_etagere);

        return response()->json(['type' => 'success', 'message' => "L'étagère a été créé avec succès"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etagere  $etagere
     * @return \Illuminate\Http\Response
     */
    public function show(Etagere $etagere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etagere  $etagere
     * @return \Illuminate\Http\Response
     */
    public function edit(Etagere $etagere)
    {
        $locaux = Local::all();
        $locau = DB::table('locals')
            ->where('id', '=', $etagere->id_local)
            ->first();
        return view('backend.etageres.modal.update', compact('etagere', 'locaux', 'locau'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEtagereRequest  $request
     * @param  \App\Models\Etagere  $etagere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etagere $etagere)
    {
        $validator = Validator::make($request->all(), [
            "local" => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        
        $etagere->id_local = $request->local;
        $etagere->created_by     = Auth::user()->getAuthIdentifier();
        $etagere->save();

        activity("Modification")
            ->causedBy(Auth::user())
            ->performedOn($etagere)
            ->withProperties([
                'Numero serie'  =>$etagere->number_etagere,
            ])
            ->log("Modification de l'étagère ".$etagere->number_etagere);

        return response()->json(['type' => 'success', 'message' => "L'étagère a été modifié avec succès"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etagere  $etagere
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etagere $etagere)
    {
        $etagere->delete();
        
        activity("Supression")
            ->causedBy(Auth::user())
            ->performedOn($etagere)
            ->withProperties([
                'Numero serie'  =>$etagere->number_etagere,
            ])
            ->log("Supression de l'étagère ".$etagere->number_etagere);

        return response()->json(['type' => 'success', 'message' => "L'étagère a été supprimé avec succès !"]);
    }
}
