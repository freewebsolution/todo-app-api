<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lists extends Model
{
    protected $table = 'lists';
    protected $guarded = ['id'];

    public function todos(): HasMany
    {
        return $this->hasMany(Todos::class,'lists_id');
    }
    use HasFactory;
}
