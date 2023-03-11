<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebhookController extends Controller
{
    public function getNotification(Request $request) {
        $filename = 'notification_' . now()->timestamp . '.log';
        Storage::disk('local')->put($filename, json_encode($request->all()));
    }
}
