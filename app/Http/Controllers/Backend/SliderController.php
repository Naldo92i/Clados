<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SliderController extends Controller
{
    public function datatable(){
        return datatables()->of(Slider::all())
            ->addColumn('action', function($sliders){
                return view('backend.sliders.actions', ['sliders'=>$sliders]);
            })->toJson();
    }


    public function index(){
        return view('backend.sliders.index');
    }


    public function create(){
        return view('backend.sliders.pages.create');
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'petit_titre' => 'nullable|max:150',
            'grand_titre' => 'required|max:150',
            'url' => 'required|max:150',
            'image' => ['required', 'file', 'image', 'min:0'],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        $last = Slider::latest()->first();
        $lastOrder = $last==null?'0':$last->order;

        $slider = new Slider();
        $slider->title1         = $request->petit_titre;
        $slider->title2         = $request->grand_titre;
        $slider->url            = $request->url;
        $slider->order          = $lastOrder+1;
        $slider->created_by     = Auth::user()->getAuthIdentifier();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $photo = $file->hashName();
            $path2 = public_path() . '/custom/sliders/';
            $file->move($path2, $photo);
            $slider->image           = $photo;
        }
        $slider->save();

        activity("Audit")
            ->causedBy(Auth::user())
            ->performedOn($slider)
            ->withProperties([
                'slider'           =>$slider,
            ])
            ->log("Création de carroussel ".$slider->title1);

        return response()->json(['type' => 'success', 'message' => "Carroussel créé avec succès !"]);
    }


    public function edit(Slider $slider){
        return view('backend.sliders.pages.update', ['slider'=>$slider]);
    }


    public function update(Request $request ,Slider $slider){
        $validator = Validator::make($request->all(), [
            'petit_titre' => 'nullable|max:150',
            'grand_titre' => 'required|max:150',
            'url' => 'required|max:150',
            'image' => ['nullable', 'file', 'image', 'min:0', 'max:12287', Rule::dimensions()->maxWidth(1600)->maxHeight(800)],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        $slider->title1         = $request->petit_titre;
        $slider->title2         = $request->grand_titre;
        $slider->url            = $request->url;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $photo = $file->hashName();
            $path2 = public_path() . '/custom/sliders/';
            $file->move($path2, $photo);
            $slider->image           = $photo;
        }
        $slider->save();

        return response()->json(['type' => 'success', 'message' => "Carroussel modifié avec succès !"]);
    }


    public function status(Slider $slider){
        $slider->status=='Publié'?$slider->status='Non publié':$slider->status='Publié';
        $slider->save();

        return response()->json(['type' => 'success', 'message' => "Changement de statut avec succès !"]);
    }


    public function destroy(Slider $slider){
        $slider->delete();
        return response()->json(['type' => 'success', 'message' => "Le carroussel a été supprimé avec succès !"]);
    }

}
