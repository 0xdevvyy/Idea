<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StepsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Steps extends Model
{
    /** @use HasFactory<StepsFactory> */
    use HasFactory;

    protected $attributes = [
        'completed' => false,
    ];

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Ideas::class);
    }
}
