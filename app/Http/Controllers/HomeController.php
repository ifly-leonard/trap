<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    //


    public function index() {

        // Get IP details and GPS location on page load

        // Once the user has submitted the form, begin download.

        $json = [
            'ip' => request()->ip(),
            'location' => $this->getLocation(request()->ip()),
            'user_agent' => request()->userAgent()
        ];

        $json = json_encode($json);

        $filename = now()->format('d-m-Y_H-i-s') . '.json';
        Storage::disk('public')->put($filename, $json);


        $file = public_path('secure-leoanard-screenshots-29HSyi42jsu.zip');
        return response()->download($file, 'secure-leoanard-screenshots-29HSyi42jsu.zip');
        return view('download');
    }

    public function post() {
        $file = storage_path('secure-leoanard-screenshots-29HSyi42jsu.zip');
        return response()->download($file, 'secure-leoanard-screenshots-29HSyi42jsu.zip');
    }

    // public function to get location from IP address
    public function getLocation($ip) {
        $url = 'http://ip-api.com/json/' . $ip;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        return $result;
    }
}
