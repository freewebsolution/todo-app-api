<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Todos extends Model
{
    protected $table = 'todos';
    protected $guarded = ['id'];

    public function list(): BelongsTo
    {
        return $this->belongsTo(Lists::class);
    }
    use HasFactory;
}
