<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index() {

        $endPoint = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCeSgNMXPV1263WUwV-BTkIQ&key=";

        $fetchApiResult = PublicAPIController::getYoutubeChannelStatistics($endPoint . env('GOOGLE_API_KEY'));

        $subscriberCount = $fetchApiResult['items'][0]['statistics']['subscriberCount'];
        $totalVideo = $fetchApiResult['items'][0]['statistics']['videoCount'];
        $totalView = $fetchApiResult['items'][0]['statistics']['viewCount'];

        return view('about_us', [
            "title" => "About Us",
            "subscriberCount" => $subscriberCount,
            "totalVideo" => $totalVideo,
            "totalView" => $totalView,
        ]);
    }
}
