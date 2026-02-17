<?php

namespace App\Http\Controllers;

use App\Models\Ideas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class IdeasImageController extends Controller
{
    public function delete(Ideas $idea){
        Gate::authorize('workWith', $idea);

        Storage::disk('public')->delete($idea->image_path);
        $idea->update(['image_path' => null]);

        return back();
    }
}
