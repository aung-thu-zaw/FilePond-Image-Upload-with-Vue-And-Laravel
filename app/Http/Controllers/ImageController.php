<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function show()
    {
        return Image::pluck("name")->toArray();
    }

    public function store(Request $request)
    {
        if(!$request->hasFile("image")) {
            return response()->json(["error" => "There is no image present."], 400);
        }

        $request->validate([
               "image" => ["required","file","image","mimes:png,jpg,jpeg,svg,webp"]
           ]);

        $formImage = $request->file("image");

        $originalName = $formImage->getClientOriginalName();

        $finalName = time()."-".$originalName;

        $formImage->storeAs("/images", $finalName);

        Image::create(["name" => $finalName]);

        return $finalName;

    }
}
