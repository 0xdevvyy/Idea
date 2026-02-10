<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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

        $status = $request->status;

        if (! in_array($status, IdeaStatus::values())) {
            $status = null;
        }

        $ideas = Auth::user()
            ->ideas()
            // ->where('status', 'pending')
            ->when($status, fn ($query, $status) => $query->where('status', $status))
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
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
