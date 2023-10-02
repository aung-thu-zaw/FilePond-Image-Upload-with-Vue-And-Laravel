<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // public function show(): JsonResponse
    // {
    //     return response()->json(["images" => Image::pluck("name")->toArray()]);
    // }

    public function store(Request $request): JsonResponse
    {
        if(!$request->hasFile("image")) {
            return response()->json(["error" => "There is no image present."], 400);
        }

        $request->validate([
               "image" => ["required","file","image"]
           ]);

        $formImage = $request->file("image");

        $originalName = $formImage->getClientOriginalName();

        $finalName = time()."-".$originalName;

        $formImage->storeAs("/images", $finalName);

        $image = Image::create(["name" => $finalName]);

        return response()->json(["image" => $image]);

    }
}
