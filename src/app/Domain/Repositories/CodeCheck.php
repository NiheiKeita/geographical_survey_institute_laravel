<?php

namespace App\Domain\Repositories;

class CheckResult
{
    public function __construct(public string $response = "", public string $error = "", public string $code = "")
    {
    }
}
class CodeCheck
{
    public function codeCheck($code): CheckResult
    {

        //TODO(あとでDocker内でlocalhostsにアクセスできるようにする)
        $data = [
            'code' => $code,
        ];
        $url = config('app.php_check_url');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        $outPutString = "";
        $error = curl_error($ch);
        if (!$error) {
            $resArray = json_decode($response);
            $outPutString = $resArray->result;
        }
        curl_close($ch);

        return new CheckResult($outPutString, $error, $code);
    }
}
