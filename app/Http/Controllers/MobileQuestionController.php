<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobileQuestionController extends Controller
{
    public function index_mobile() {
        $tags = DB::table('tags')->get();
        return view('index_mobile', compact('tags'));
    }
}
