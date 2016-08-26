<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RestfullController extends Controller
{

    public function getSuma()
	{
	    $a = (int)request('a', 0);
        $b = (int)request('b', 0);

        $response = $a + $b;

        return response()->json(
            [
                'status' => '200',
                'response' => $response,
                'request' => request()->all(),
            ]
        );
	}

}
