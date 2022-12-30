<?php

namespace App\Http\Controllers;

use App\Models\Actuality;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\About;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller{

    public function index(){
        $configs = DB::table('configs')->latest('id')->first();
        $sliders = Slider::where('status', 'Publié')->get();
        $testimonials = Testimonial::all();
        $partners = Partner::all();
        $about = About::first();
        $news = Actuality::all();
        return view('welcome', compact('sliders',
                    'testimonials', 'partners',
                    'about', 'news', 'configs'));
    }
}
