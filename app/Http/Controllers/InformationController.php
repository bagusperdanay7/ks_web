<?php

namespace App\Http\Controllers;

class InformationController extends Controller
{
    public function aboutUs()
    {
        $endPoint = 'https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=' . env('YOUTUBE_ID') . '&key=';
        $endPointLatestVideo = 'https://www.googleapis.com/youtube/v3/search?channelId=' . env('YOUTUBE_ID') . '&part=snippet,id&order=date&maxResults=1&key=';

        $fetchApiResult = PublicAPIController::getYoutubeChannelStatistics($endPoint . env('GOOGLE_API_KEY'));
        $fetchAPIResultLatestVideo = PublicAPIController::getYoutubeChannelStatistics($endPointLatestVideo . env('GOOGLE_API_KEY'));

        $subscriberCount = $fetchApiResult['items'][0]['statistics']['subscriberCount'];
        $totalVideo = $fetchApiResult['items'][0]['statistics']['videoCount'];
        $totalView = $fetchApiResult['items'][0]['statistics']['viewCount'];
        $latestVideoId = $fetchAPIResultLatestVideo['items'][0]['id']['videoId'];
        $latestVideoTitle = $fetchAPIResultLatestVideo['items'][0]['snippet']['title'];

        return view('information.about_us', [
            'title' => 'About Us',
            'subscriberCount' => $subscriberCount,
            'totalVideo' => $totalVideo,
            'totalView' => $totalView,
            'latestVideo' => $latestVideoId,
            'latestVideoTitle' => $latestVideoTitle
        ]);
    }

    public function privacyAndPolicy()
    {
        return view('information.privacy_policy', [
            'title' => 'Privacy & Policy',
        ]);
    }

    public function termsAndConditions()
    {
        return view('information.terms_conditions', [
            'title' => 'Terms & Conditions',
        ]);
    }
}
