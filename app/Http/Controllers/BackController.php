<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BackController extends Controller
{
    public function getBackData(Request $request, $status){
        return View::make('back', [ 'data' => array_merge(['status' => $status], $request->query()) ]);
    }
}
