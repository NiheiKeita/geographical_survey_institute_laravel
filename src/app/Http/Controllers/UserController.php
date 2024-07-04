<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request): Array
    {
        $user = User::create([
            "name" => $request->name,
        ]);
        return [
            "name" => $user->name,
            "id" => $user->id,
        ];
    }
    public function update(Request $request): Array
    {
        $user = User::find($request->user_id);
        $user->update([
            "name" => $request->name,
        ]);
        return[
            "name" => $user->name,
            "id" => $user->id,
        ];
    }
    
}
