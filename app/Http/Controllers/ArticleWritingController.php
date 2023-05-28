<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isEmpty;

class ArticleWritingController extends BaseController
{
    public function showArticleWriting()
    {
        if (!session('user_id')) {
            return redirect('login');
        } else {
            return view('article_writing')
                ->with('username', session('username'));
        }
    }

    public function createArticle(Request $request)
    {
        $title = $request->article_title;
        $content = $request->article_body;
        $city = $request->city;
        $image_url = $request->image_url;

        $repeated = DB::table('ARTICLES')
            ->select('*')
            ->where('TITLE', '=', $title)
            ->orWhere('CONTENT', '=', $content)
            ->get();

        if ($repeated->isEmpty()) {
            $article = new Article;
            $article->TITLE = $title;
            $article->CONTENT = $content;
            $article->CITY = $city;
            $article->AUTHOR = session('user_id');
            $article->IMAGE_URL = $image_url;

            $article->save();
            return redirect('article/' . $article->id);
        } else {
            return redirect('article_writing')
                ->with('error', true);
        }
    }

    public function getUnsplash($prompt = null)
    {
        if ($prompt) {
            $url = "https://api.unsplash.com/search/photos?page=1&query=$prompt&client_id=" . env('UNSPLASH_KEY');
            $unsplash = Http::get($url);
            if ($unsplash->successful() && $unsplash['total'] > 0) {
                $random_res = random_int(0, count($unsplash['results']) - 1);
                $response = [
                    'found' => true,
                    'link' => $unsplash['results'][$random_res]['urls']['regular']
                ];
            } else {
                $response = ['found' => false];
            }
        } else {
            $url = "https://api.unsplash.com/photos/random?client_id=" . env('UNSPLASH_KEY');
            $unsplash = Http::get($url);
            $response = [
                'found' => true,
                'link' => $unsplash['urls']['regular']
            ];
        }

        return $response;
    }
}
