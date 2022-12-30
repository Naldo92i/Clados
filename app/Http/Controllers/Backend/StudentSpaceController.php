<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Galerie;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentSpaceController extends Controller
{
    public function galery_datatable(){
        return datatables()->of(Galerie::all())
            ->addColumn('action', function($sliders){
                return view('backend.student_space.pages.galery.actions', ['sliders'=>$sliders]);
            })->toJson();
    }

    public function galery(){
        return view('backend.student_space.galery');
    }

    public function create_galery(){
        return view('backend.student_space.pages.galery.create');
    }

    public function store_galery(Request $request){
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:150',
            'image' => ['nullable', 'file', 'image', 'min:0', 'max:12287', Rule::dimensions()->maxWidth(1600)->maxHeight(800)],
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        $slider = new Galerie();
        $slider->description         = $request->description;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $photo = $file->hashName();
            $path2 = public_path() . '/custom/galery/';
            $file->move($path2, $photo);
            $slider->image           = $photo;
        }
        $slider->save();

        return response()->json(['type' => 'success', 'message' => "Photo modifié avec succès !"]);
    }

    public function destroy_galery($id){
        $galerie = DB::table('galeries')->where('uuid', '=', $id)->delete();
        return response()->json(['type' => 'success', 'message' => "La photo a été supprimé avec succès !"]);
    }

    public function schedule_datatable(){
        return datatables()->of(DB::table('schedules')
        ->join('faculties', 'schedules.faculty_id', '=', 'faculties.id')
        ->select('schedules.id', 'schedules.uuid', 'schedules.date_debut', 'schedules.file', 'faculties.name')
        ->get())
            ->addColumn('action', function($schedules){
                return view('backend.student_space.pages.schedule.actions', ['schedules'=>$schedules]);
            })->toJson();
    }

    public function schedule(){
        $schedules = DB::table('schedules')
        ->join('faculties', 'schedules.faculty_id', '=', 'faculties.id')
        ->select('schedules.id', 'schedules.faculty_id', 'schedules.date_debut', 'schedules.file', 'faculties.name')
        ->orderByDesc('schedules.date_debut')
        ->get();
        return view('backend.student_space.schedule.index', ['schedules'=>$schedules]);
    }

    public function create_schedule(){
        $faculties = Faculty::all();
        return view('backend.student_space.pages.schedule.create', compact('faculties'));
    }

    public function store_schedule(Request $request){
        $date_today = date('Y/m/d');
        $validator = Validator::make($request->all(), [
            'date_debut' => 'date|required',
            'faculty' => 'required|integer',
            'image' => 'required|file|mimes:pdf,docx|max:12287',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        $fichier = new Schedule();
        $fichier->date_debut = $request->date_debut;
        $fichier->faculty_id = $request->faculty;
        // $fichier->created_by = Auth::user()->getAuthIdentifier();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $monfichier = $file->hashName();
            $path2 = public_path() . '/custom/schedule/';
            $file->move($path2, $monfichier);
            $fichier->file           = '/custom/schedule/'.$monfichier;
        }

        $fichier->save();

        return response()->json(['type' => 'success', 'message' => "Emploi du temps créé avec succès !"]);
    }

    public function destroy_schedule($id){
        $schedules = DB::table('schedules')->where('uuid', '=', $id)->delete();
        return response()->json(['type' => 'success', 'message' => "Le programme a été supprimé avec succès !"]);
    }

}
