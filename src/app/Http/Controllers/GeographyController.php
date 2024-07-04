<?php

namespace App\Http\Controllers;

class GeographyController extends Controller
{
    public function elevation()
    {
        $url = "https://cyberjapandata2.gsi.go.jp/general/dem/scripts/getelevation.php?lon=135&lat=35&outtype=JSON";
        $ch = curl_init();
        $apiKey = config('app.annict_api_key');
        $headers = [
            'Authorization: Bearer ' . $apiKey,
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

        return response()->json([
            'result' => 'ok',
            'data' => [
                'elevation' => $responseArray->elevation,
                'hsrc' => $responseArray->hsrc,
            ]
        ]);
        // $this->info($response);
        // return "ww";
        // return response()->json(['animations' => '111']);
    }
}
