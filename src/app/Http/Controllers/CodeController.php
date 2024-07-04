<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\CodeCheck;
use App\Models\Code;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CodeController extends Controller
{

    function codeExecutionOutput($code){
        ob_start();
        eval($code);
        $output = ob_get_clean();
        return $output;
    }
    function isCorrect($value): bool
    {
        $correctValue ="1\n2\nFizz\n4\nBuzz\nFizz\n7\n8\nFizz\nBuzz\n11\nFizz\n13\n14\nFizzBuzz\n16\n17\nFizz\n19\nBuzz\nFizz\n22\n23\nFizz\nBuzz\n26\nFizz\n28\n29\nFizzBuzz\n31\n32\nFizz\n34\nBuzz\nFizz\n37\n38\nFizz\nBuzz\n41\nFizz\n43\n44\nFizzBuzz\n46\n47\nFizz\n49\nBuzz\nFizz\n52\n53\nFizz\nBuzz\n56\nFizz\n58\n59\nFizzBuzz\n61\n62\nFizz\n64\nBuzz\nFizz\n67\n68\nFizz\nBuzz\n71\nFizz\n73\n74\nFizzBuzz\n76\n77\nFizz\n79\nBuzz\nFizz\n82\n83\nFizz\nBuzz\n86\nFizz\n88\n89\nFizzBuzz\n91\n92\nFizz\n94\nBuzz\nFizz\n97\n98\nFizz\nBuzz\n";
        return $correctValue === $value;
    }

    #[OA\Post(
        path: '/code-check',
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]
    )]
    public function index(Request $request): Array
    {
        $codeCheck = new CodeCheck();
        $result = $codeCheck->codeCheck($request->code ?? "");
        $isCorrect = self::isCorrect($result->response ?? "");
        $codeResult = !$result->error ? ($isCorrect ? "ok" : "ng") : "error";
        $byte = null;
        $user = User::find($request->id);
        $question = Question::find($request->question_id);
        if($codeResult === "ok"){
            $byte = strlen($request->code);
            self::createCode($request->code,$user,$question);
        }

        $data = [
            "result" => $codeResult,
            "response" => $result->response,
            "error" => $result->error,
            "code" => $request->code,
            "byte" => $byte,
        ];
        return $data;
    }

    public function check(Request $request): Array
    {
        $resultCode = self::codeExecutionOutput($request->code);
        $data = [
            "result" => $resultCode,
        ];
        return $data;
    }

    public function createCode($code, $user, $quesion){

        Code::create([
            "user_id" => $user->id,
            "question_id" => $quesion->id,
            "code" => $code,
        ]);
    }
}
