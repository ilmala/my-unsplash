<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Unsplash;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::latest()->search(request()->search)->paginate(10);

        return response()->json([
            'images' => $images
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:256',
            'url' => 'required|string|max:256',
        ]);

        $image = Image::create([
            'label' => $request->label,
            'url' => $request->url,
        ]);

        return response()->json($image);
    }

    public function destroy(Image $image)
    {
        $image->delete();

        return response()->json(['deleted' => true]);
    }
}
