<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeographyController extends Controller
{
    public function elevation(Request $request)
    {
        $url = "https://cyberjapandata2.gsi.go.jp/general/dem/scripts/getelevation.php?lon={$request->lon}&lat={$request->lat}&outtype=JSON";
        $ch = curl_init();
        $headers = [
            'Accept: application/json',
        ];
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        if ($error) {
            return response()->json(['result' => 'ng', 'data' => $error]);
        }
        $responseArray = json_decode($response);
        curl_close($ch);

        // TODO:現在の位置情報と目標の標高が合っているか確認
        $isClear = false;

        return response()->json([
            'result' => 'ok',
            'data' => [
                'elevation' => $responseArray->elevation,
                'hsrc' => $responseArray->hsrc,
                'isClear' => $isClear,
            ]
        ]);
    }
}

