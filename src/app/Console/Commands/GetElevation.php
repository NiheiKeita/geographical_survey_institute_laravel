<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetElevation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-elevation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle($page = 1)
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
            $this->info("error $error");
            return;
        }
        curl_close($ch);

        $this->info($response);
        $this->info($page);
    }
}
