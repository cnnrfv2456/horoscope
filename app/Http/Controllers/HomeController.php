<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\horoscope;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $today_fortune = horoscope::select(
            'constellation_name',
            'all_score',
            'all_description',
            'love_score',
            'love_description',
            'work_score',
            'work_description',
            'fortune_score',
            'fortune_description'
        )->where('date', date('yy-m-d'))->get(12);

        return view('welcome', [
            'today_fortune' => $today_fortune,
            'today_date' => date('yy-m-d')
        ]);
    }
}
