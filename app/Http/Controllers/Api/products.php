<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Product;
use Illuminate\Support\Facades\Storage;

class products extends Controller
{
    //
    function upload(Request $request)
    {
        $user = $request->user();
        $rule = [
            'name' => 'required|max:20|min:5',
            'desc' => 'required|max:30|min:8',
            'price' => 'required|max:3|min:1',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if ($request->hasFile('image')) {
            $uploadFolder = 'users';
            $image = $request->file('image');
            $image_uploaded_path = $image->store($uploadFolder, 'public');

            $p = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'desc' => $request->desc,
                'image' => Storage::disk('public')->url($image_uploaded_path),
                'user_id' => $user->username,
            ]);
            return response()->json($p, 200);
        }
        return response()->json(['response' => 'image file is required'], 404);
    }

    function get(Request $request)
    {
        $user = $request->user();
        $p = Product::where('user_id', $user->username)->get();
        return response()->json($p, 200);
    }

}
// Symfony\Component\ErrorHandler\Error\FatalError: Cannot declare class App\Http\Controllers\Api\products, because the name is already in use in file /Users/mohdkashif/Projects/online_dekho_test_project_laravel_api/app/Http/Controllers/Api/product.php on line 9

// #0 {main}