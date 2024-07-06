<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        // $user = User::create([
        //     "name" => $request->name,
        // ]);
        $user = array(
            "name" => "test",
            "nextCheckpointElevation" => 0,
            "totalPoints" => 0,
        );
        if ($request->id == 1) {
            $user = array(
                "name" => "二瓶啓太",
                "nextCheckpointElevation" => 150,
                "totalPoints" => 350,
            );
        }
        return response()->json([
            'result' => 'ok',
            'data' => [
                "name" => $user["name"],
                "nextCheckpointElevation" =>  $user["nextCheckpointElevation"],
                "totalPoints" =>  $user["totalPoints"],
            ]
        ]);
    }
    public function store(Request $request): array
    {
        $user = User::create([
            "name" => $request->name,
        ]);
        return [
            "name" => $user->name,
            "id" => $user->id,
        ];
    }
    public function update(Request $request): array
    {
        $user = User::find($request->user_id);
        $user->update([
            "name" => $request->name,
        ]);
        return [
            "name" => $user->name,
            "id" => $user->id,
        ];
    }
}
