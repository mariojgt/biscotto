<?php

namespace Mariojgt\Biscotto\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class BiscottoContoller extends Controller
{
    public function index(Request $request)
    {
        // Create the log file with the user options
        $logFile = [
            'user_ip'         => $request->ip(),
            'time'            => Carbon::now(),
            'cookie_settings' => Request('cookie_options'),
        ];

        // Forget multiple keys...
        $request->session()->forget(['cookie_necessary', 'cookie_functional', 'cookie_statstics', 'cookie_marketing']);

        // Create the session that will be use so the cookie can remember the user
        foreach (Request('cookie_options') as $key => $value) {
            foreach ($value as $keyValue => $cookie) {
                session(['cookie_'.$keyValue => $cookie]);
            }
        }

        // Path we save the log file
        $path = storage_path() . '/biscotto/';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        // Create the log file
        File::put($path . $request->ip() . '-' . date('Y-m-d') . ".txt", json_encode($logFile));
        // Return message
        return response()->json([
            'message' => true,
        ]);
    }
}
