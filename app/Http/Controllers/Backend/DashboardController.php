<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Locale;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $locaux = DB::table('locals')->count();
        $etageres = DB::table('etageres')->count();
        $classeurs = DB::table('classeurs')->count();
        $documents = DB::table('documents')->count();
        $users = DB::table('users')->count();
        $configs = DB::table('configs')->latest('id')->first();
        return view('backend.dashboard.index', compact('configs', 
                            'locaux', 'etageres', 'users',
                        'documents', 'classeurs'));
    }
}
