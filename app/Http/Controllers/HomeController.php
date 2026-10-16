<?php

namespace App\Http\Controllers;

use App\Models\Afisha;
use App\Models\Reviews;
use App\Models\Reward;
use App\Models\Spectacle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $afishes = Afisha::query()->where(['status' => 'pending'])->get();

        $repertuar = Spectacle::all();


        $rewards = Reward::all();
        $reviews = Reviews::query()->where(['status' => 'accepted'])->limit(3)->get();

        return view('index', compact('afishes', 'repertuar', 'rewards', 'reviews'));
    }
}
