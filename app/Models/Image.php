<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $search)
    {
        if(empty($search)) {
            return $query;
        }

        return $query->where('label', 'LIKE', "%$search%");
    }
}
