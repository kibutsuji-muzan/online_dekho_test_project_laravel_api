<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class status extends Controller
{
    //
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $user->status = !$user->status;
        $user->location = $request->location;
        $user->save();
        
        return response()->json(['response' => 'status update successful', 'user' => $user], 200);
    }
}
