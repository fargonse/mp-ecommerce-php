<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DetailController extends Controller
{
    public function getDetail(Request $request){
        $details = $request->except('_token');
        return View::make('detail', ['details' => $details]);
    }
}
