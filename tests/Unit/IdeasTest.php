<?php
use App\Models\Ideas;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

test('it belongs to a user', function () {
    $idea = Ideas::factory()->create();
    expect($idea->user)->toBeInstanceOf(User::class);
});

test('it can have steps', function(){
    $idea = Ideas::factory()->create();

    expect($idea->steps)->toBeEmpty();

    $idea->steps()->create([
        'description' => 'do the thing',
    ]);

    expect($idea->fresh()->steps)->toHaveCount(1);
});