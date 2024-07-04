<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        $question = Question::find($request->id);
        $codes = $question->getMaxCodeBytePerUser();
        
        return response()->json(['codes' => $codes]);
    }
    
}
