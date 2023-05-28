<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isEmpty;

class TweetsController extends BaseController
{
    private function getToken()
    {
        $response = Http::withBasicAuth(
            '8ZctqAWzKrxUpNRgGwucYFgHB',
            'PZzLce7kJhwdgvBC5oIKmE2823VPcdcnzEbMfaE1kWJOsE5CmX'
        )
            ->asForm()
            ->post('https://api.twitter.com/oauth2/token', [
                "grant_type" => "client_credentials"
            ]);
        return $response["access_token"];
    }
    public function getTweets($hashtag = null)
    {
        $token = $this->getToken();
        $endpoint = "https://api.twitter.com/2/tweets/search/recent?query=";
        $expansions = '&expansions=' . urlencode("attachments.media_keys") . '&media.fields=url';

        if (!$hashtag) {
            $query = urlencode("from:Tripadvisor has:media -is:retweet");
        } else {
            $query = urlencode("(trip OR travel) " . $hashtag . " has:media -is:retweet");
        }

        $url = $endpoint . $query . $expansions;

        $response = Http::withToken($token)
            ->get($url);

        if ($response["meta"]["result_count"] === 0) {
            return ["num" => 0];
        }
        $data = $response['data'];
        $media = $response['includes']['media'];

        $tweets = [];

        foreach ($data as $t) {
            foreach ($media as $m) {
                if ($m['media_key'] === $t['attachments']['media_keys'][0] && $m['type'] === "photo") {
                    $tweets[] = ["content" => $t['text'], "photo" => $m['url']];
                } else {
                    continue;
                }
            }
        }
        return $tweets;
    }
}
