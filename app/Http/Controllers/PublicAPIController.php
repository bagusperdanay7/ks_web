<?php

namespace App\Http\Controllers;

class PublicAPIController extends Controller
{
    public static function getYoutubeChannelStatistics($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
    
        return json_decode($result, true);
    }
}
