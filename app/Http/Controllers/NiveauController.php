<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\Etagere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NiveauController extends Controller
{
    public function datatable(){
        $niveaux = DB::table('niveaux')
            ->join('etageres', 'etageres.id', '=', 'niveaux.id_etagere')
            ->join('locals', 'locals.id', '=', 'etageres.id_local')
            ->select('etageres.number_etagere', 'niveaux.number_niveau', 
                        'niveaux.uuid', 'locals.title_local')
            ->get();

        return datatables()->of($niveaux)
            ->addColumn('action', function($niveaux){
                return view('backend.niveau.actions', ['niveaux'=>$niveaux]);
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
        return view('backend.niveau.index', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveaux = DB::table('etageres')
            ->join('locals', 'locals.id', '=', 'etageres.id_local')
            ->select('etageres.id', 'etageres.number_etagere', 'locals.title_local')
            ->get();

        return view('backend.niveau.modal.create', compact('niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNiveauRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "etagere" => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        
        $niveau = new Niveau();
        $niveau->id_etagere = $request->etagere;
        $niveau->created_by     = Auth::user()->getAuthIdentifier();
        $niveau->save();
        $niveau->number_niveau = 'N00'.$niveau->id;
        $niveau->save();

        activity("Création")
            ->causedBy(Auth::user())
            ->performedOn($niveau)
            ->withProperties([
                'Numero serie'  =>$niveau->number_niveau,
            ])
            ->log("Création du niveau ".$niveau->number_niveau);

        return response()->json(['type' => 'success', 'message' => "Le niveau a été créé avec succès"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function show(Niveau $niveau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function edit(Niveau $niveau)
    {
        $etageres = DB::table('etageres')
            ->join('locals', 'locals.id', '=', 'etageres.id_local')
            ->select('etageres.id', 'etageres.number_etagere', 'locals.title_local', 'etageres.uuid')
            ->get();

        $etage = DB::table('etageres')
        ->join('locals', 'locals.id', '=', 'etageres.id_local')
        ->where('etageres.id', '=', $niveau->id_etagere)
        ->select('etageres.id', 'etageres.number_etagere', 'locals.title_local', 'etageres.uuid')
            ->first();

        return view('backend.niveau.modal.update', compact('niveau', 'etageres', 'etage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNiveauRequest  $request
     * @param  \App\Models\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveau $niveau)
    {
        $validator = Validator::make($request->all(), [
            "etagere" => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }
        
        $niveau->id_etagere       = $request->etagere;
        $niveau->created_by     = Auth::user()->getAuthIdentifier();
        $niveau->save();

        activity("Modification")
            ->causedBy(Auth::user())
            ->performedOn($niveau)
            ->withProperties([
                'Numero serie'  =>$niveau->number_niveau,
            ])
            ->log("Modification du niveau ".$niveau->number_niveau);

        return response()->json(['type' => 'success', 'message' => "Le niveau a été modifié avec succès"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Niveau  $niveau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Niveau $niveau)
    {
        $niveau->delete();
        
        activity("Supression")
            ->causedBy(Auth::user())
            ->performedOn($niveau)
            ->withProperties([
                'Numero serie'  =>$niveau->number_niveau,
            ])
            ->log("Supression du niveau ".$niveau->number_niveau);

        return response()->json(['type' => 'success', 'message' => "Le niveau a été supprimé avec succès !"]);
    }
}
