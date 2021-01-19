<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Sushi\Sushi;

class Unsplash extends Model
{
    use HasFactory;
    use Sushi;

    public function getRows()
    {
        return Cache::remember('unsplash-images', now()->addDay(), function () {
            $url = "https://picsum.photos/v2/list?limit=100";
            return json_decode(file_get_contents($url), true);
        });
    }
}
