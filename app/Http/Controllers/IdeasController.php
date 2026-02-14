<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdeaRequest;
use App\IdeaStatus;
use App\Models\Ideas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $ideas = Auth::user()
            ->ideas()
            // ->where('status', 'pending')
            ->when(in_array($request->status, IdeaStatus::values()), fn ($query) => $query->where('status', $request->status))
            ->latest()
            ->get();

        return view('ideas.index', [
            'ideas' => $ideas,
            'statusCount' => Ideas::status(Auth::user()),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request)
    {
        // dd($request->all());
      
        $idea = Auth::user()->ideas()->create($request->safe()->except('steps', 'image'));

        $idea->steps()->createMany(
            collect($request->steps)->map(fn ($step) => ['description' => $step])
        );
        //   dd(collect($request->steps)->map(fn ($step) => ['description' => $step]));
        // dd($request->steps);
        $imagePath = $request->image->store('idea' ,'public');

        $idea->update([
            'image_path' => $imagePath,
        ]);

        return to_route('ideas.index')->with('success', 'Idea is Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ideas $idea)
    {
        
        return view('ideas.show',[
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ideas $idea)
    {
        $idea->delete();
        return to_route('ideas.index');
    }
}
