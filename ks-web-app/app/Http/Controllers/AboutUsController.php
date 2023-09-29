<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index() {

        $projectController = new ProjectController();
        $apiKey = 'AIzaSyC9X67kK6KirTPzzxrodASGpum3eyXbQcA';

        $fetchApiResult = $projectController->getYoutubeAPICURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCeSgNMXPV1263WUwV-BTkIQ&key=' . $apiKey);

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
