<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class MeController extends Controller
{


    public function getMe()
    {
        if(auth()->check()){
            //return response()->json(["user" =>auth()->user()], 200);
            $user = auth()->user();
            return new UserResource($user);
        }
        return response()->json(null, 401);
    }
}
