<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Unsplash;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::latest()->paginate(10);

        return response()->json([
            'images' => $images
        ]);
    }
}
