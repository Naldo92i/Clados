<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Classeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
    public function datatable(){
        $documents = DB::table('documents')
        ->join('classeurs', 'classeurs.id', '=', 'documents.id_classeur')
        ->join('niveaux', 'niveaux.id', '=', 'classeurs.id_niveau')
        ->join('etageres', 'etageres.id', '=', 'niveaux.id_etagere')
        ->join('locals', 'locals.id', '=', 'etageres.id_local')
        ->select('etageres.number_etagere', 'niveaux.number_niveau', 
                    'documents.uuid', 'locals.title_local', 'classeurs.number_classeur', 
                    'classeurs.title_classeur', 'documents.title_document',
                    'documents.fichier')
        ->get();

        return datatables()->of($documents)
            ->addColumn('action', function($documents){
                return view('backend.document.actions', ['documents'=>$documents]);
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
        return view('backend.document.index', compact('configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classeurs = Classeur::all();
        return view('backend.document.modal.create', compact('classeurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string',
            'classeur' => 'required|integer',
            'fichier' => ['nullable', 'file', 'min:0'],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        
        $document = new Document();
        $document->title_document      = $request->titre;
        $document->id_classeur         = $request->classeur;
        $document->created_by     = Auth::user()->getAuthIdentifier();
        if($request->hasFile('fichier')){
            $file = $request->file('fichier');
            $photo = $file->hashName();
            $path2 = public_path() . '/custom/documents/';
            $file->move($path2, $photo);
            $document->fichier           = $photo;
        }
        $document->save();
        
        activity("Creation")
            ->causedBy(Auth::user())
            ->performedOn($document)
            ->withProperties([
                'Titre du document'           =>$document->title_document,
            ])
            ->log("Création du document ".$document->title_document);

        return response()->json(['type' => 'success', 'message' => "Document créé avec succès !"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $classe = Classeur::find($document->id_classeur);
        $classeurs = Classeur::all();
        return view('backend.document.modal.update', compact('classeurs', 'document', 'classe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentRequest  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string',
            'classeur' => 'required|integer',
            'fichier' => ['nullable', 'file', 'min:0'],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        
        $document->title_document      = $request->titre;
        $document->id_classeur         = $request->classeur;
        $document->created_by     = Auth::user()->getAuthIdentifier();
        if($request->hasFile('fichier')){
            $file = $request->file('fichier');
            $photo = $file->hashName();
            $path2 = public_path() . '/custom/documents/';
            $file->move($path2, $photo);
            $document->fichier           = $photo;
        }
        $document->save();
        
        activity("Modification")
            ->causedBy(Auth::user())
            ->performedOn($document)
            ->withProperties([
                'Titre du document'           =>$document->title_document,
            ])
            ->log("Modification du document ".$document->title_document);

        return response()->json(['type' => 'success', 'message' => "Document modifié avec succès !"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();
        
        activity("Supression")
            ->causedBy(Auth::user())
            ->performedOn($document)
            ->withProperties([
                'Titre du document'           =>$document->title_document,
            ])
            ->log("Supression du document ".$document->title_document);

        return response()->json(['type' => 'success', 'message' => "Le document a été supprimé avec succès !"]);
    }
}
