<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isEmpty;

class HomeController extends BaseController
{
    public function showHome()
    {
        if (session('user_id')) {
            return view('home')
                ->with('username', session('username'));
        } else {
            return redirect('login');
        }
    }

    public function getMostPopular()
    {
        $liked_articles = DB::table('likes')
            ->select('ARTICLE', DB::raw('count(*) as LIKES'))
            ->groupBy('ARTICLE')
            ->orderByDesc('LIKES')
            ->get();

        $articles = [];
        foreach ($liked_articles as $a) {
            $articles[] = Article::find($a->ARTICLE);
        }
        return ['num' => count($articles), 'articles' => $articles];
    }

    public function getAlike($word)
    {
        $similar_articles = DB::table('articles')
            ->where('TITLE', 'LIKE', "%$word%")
            ->orWhere('CONTENT', 'LIKE', "%$word%")
            ->orWhere('CITY', 'LIKE', "%$word%")
            ->get();
        return ['num' => count($similar_articles), 'articles' => $similar_articles];
    }
}
