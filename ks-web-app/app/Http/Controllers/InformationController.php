<?php

namespace App\Http\Controllers;

class InformationController extends Controller
{
    public function aboutUs() {
        $endPoint = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCeSgNMXPV1263WUwV-BTkIQ&key=";

        $fetchApiResult = PublicAPIController::getYoutubeChannelStatistics($endPoint . env('GOOGLE_API_KEY'));

        $subscriberCount = $fetchApiResult['items'][0]['statistics']['subscriberCount'];
        $totalVideo = $fetchApiResult['items'][0]['statistics']['videoCount'];
        $totalView = $fetchApiResult['items'][0]['statistics']['viewCount'];

        return view('information.about_us', [
            "title" => "About Us",
            "subscriberCount" => $subscriberCount,
            "totalVideo" => $totalVideo,
            "totalView" => $totalView,
        ]);
    }

    public function privacyAndPolicy() {
        return view('information.privacy_policy', [
            "title" => "Privacy & Policy",
        ]);
    }

    public function termsAndConditions() {
        return view('information.terms_conditions', [
            "title" => "Terms & Conditions",
        ]);
    }
}
