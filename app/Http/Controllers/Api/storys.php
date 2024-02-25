<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Story;
use Illuminate\Support\Facades\Storage;

class storys extends Controller
{
    //
    function upload(Request $request)
    {
        $user = $request->user();

        $rule = [
            'story' => 'required|file|mimes:zip',
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->hasFile('story')) {
            $uploadFolder = 'story';
            $story = $request->file('story');
            $story_uploaded_path = $story->store($uploadFolder, 'public');

            $p = Story::create([
                'product_id' => $request->product_id,
                'file' => Storage::disk('public')->url($story_uploaded_path),
                'views' => 0,
                'user_id' => $user->username,
            ]);
            return response()->json($p, 200);
        }
        return response()->json(['response' => 'story file is required'], 404);
    }

    function get(Request $request)
    {
        $user = $request->user();
        $p = Story::where('user_id', $user->username)->get();
        return response()->json($p, 200);
    }

    function updateViews(Request $request)
    {

        $story = Story::find($request->id);
        if ($story) {
            $story->views = $story->views + 1;
            $story->save();
            return response()->json($story, 200);
        } else {
            // Story not found
            return response()->json(['response' => 'story not found'], 200);
        }

    }
    function getViews(Request $request)
    {

        $story = Story::all();
        if ($story) {
            return response()->json($story, 200);
        } else {
            // Story not found
            return response()->json(['response' => 'story not found'], 200);
        }

    }

}
// Symfony\Component\ErrorHandler\Error\FatalError: Cannot declare class App\Http\Controllers\Api\products, because the name is already in use in file /Users/mohdkashif/Projects/online_dekho_test_project_laravel_api/app/Http/Controllers/Api/product.php on line 9

// Illuminate\Database\QueryException: SQLSTATE[42S02]: Base table or view not found: 1146 Table 'laravel.stories' doesn't exist (Connection: mysql, SQL: insert into `stories` (`product_id`, `user_id`, `updated_at`, `created_at`) values (?, satoru, 2024-02-03 19:41:13, 2024-02-03 19:41:13)) in file /Users/mohdkashif/Projects/online_dekho_test_project_laravel_api/vendor/laravel/framework/src/Illuminate/Database/Connection.php on line 822

// #0 {main}