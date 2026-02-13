<?php

namespace App\Http\Controllers;

use App\Models\Steps;
use Illuminate\Http\Request;

class StepsController extends Controller
{
    public function update(Steps $step){
        $step->update(['completed' => ! $step->completed]);
        return back();
    }
}
