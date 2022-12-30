<?php

namespace App\Http\Controllers;

use App\Models\Classeur;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClasseurController extends Controller
{
    public function datatable(){
        $classeurs = DB::table('classeurs')
            ->join('niveaux', 'niveaux.id', '=', 'classeurs.id_niveau')
            ->join('etageres', 'etageres.id', '=', 'niveaux.id_etagere')
            ->join('locals', 'locals.id', '=', 'etageres.id_local')
            ->select('etageres.number_etagere', 'niveaux.number_niveau', 
                        'classeurs.uuid', 'locals.title_local', 'classeurs.number_classeur', 
                        'classeurs.title_classeur')
            ->get();

        return datatables()->of($classeurs)
            ->addColumn('action', function($classeurs){
                return view('backend.classeur.actions', ['classeurs'=>$classeurs]);
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
        return view('backend.classeur.index', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveaux = Niveau::all();

        return view('backend.classeur.modal.create', compact('niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClasseurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "niveau" => 'required|numeric',
            "titre" => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        $classeur = new Classeur();
        $classeur->id_niveau      = $request->niveau;
        $classeur->title_classeur = $request->titre;
        $classeur->created_by     = Auth::user()->getAuthIdentifier();
        $classeur->save();
        $classeur->number_classeur  = 'C00'.$classeur->id;
        $classeur->save();

        activity("Création")
            ->causedBy(Auth::user())
            ->performedOn($classeur)
            ->withProperties([
                'Numero serie'  =>$classeur->number_classeur,
                'Titre du classeur'  =>$classeur->title_classeur,
            ])
            ->log("Création du classeur ".$classeur->number_classeur);

        return response()->json(['type' => 'success', 'message' => "Le classeur a été créé avec succès"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classeur  $classeur
     * @return \Illuminate\Http\Response
     */
    public function show(Classeur $classeur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classeur  $classeur
     * @return \Illuminate\Http\Response
     */
    public function edit(Classeur $classeur)
    {
        $niveaux = Niveau::all();

        $etage = Niveau::find($classeur->id_niveau);

        return view('backend.classeur.modal.update', compact('niveaux', 'classeur', 'etage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClasseurRequest  $request
     * @param  \App\Models\Classeur  $classeur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classeur $classeur)
    {
        $validator = Validator::make($request->all(), [
            "niveau" => 'required|numeric',
            "titre" => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        
        $classeur->id_niveau      = $request->niveau;
        $classeur->title_classeur = $request->titre;
        $classeur->created_by     = Auth::user()->getAuthIdentifier();
        $classeur->save();

        activity("Modification")
            ->causedBy(Auth::user())
            ->performedOn($classeur)
            ->withProperties([
                'Numero serie'  =>$classeur->number_classeur,
                'Titre du classeur'  =>$classeur->title_classeur,
            ])
            ->log("Modification du classeur ".$classeur->number_classeur);

        return response()->json(['type' => 'success', 'message' => "Le classeur a été modifié avec succès"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classeur  $classeur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classeur $classeur)
    {
        $classeur->delete();
        
        activity("Supression")
            ->causedBy(Auth::user())
            ->performedOn($classeur)
            ->withProperties([
                'Numero serie'  =>$classeur->number_classeur,
                'Titre du classeur'  =>$classeur->title_classeur,
            ])
            ->log("Supression du classeur ".$classeur->number_classeur);

        return response()->json(['type' => 'success', 'message' => "Le classeur a été supprimé avec succès !"]);
    }
}
