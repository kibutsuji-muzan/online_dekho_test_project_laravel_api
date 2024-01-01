<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class livelocation extends Controller
{
    //
    public function __invoke(Request $request)
    {
        $user = $request->user();
        if ($user->status == 1) {
            $user->livelocation = $request->livelocation;
            $user->save();
            print($request->livelocation);
        }
        return response()->json(['response'=>0],400);
    }
}
