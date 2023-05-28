<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Routing\Controller as BaseController;

class ArticleListController extends BaseController
{
    public function showArticleList()
    {
        if (!session('user_id'))
            return redirect('login');

        $articles = Article::all();

        foreach ($articles as $article) {
            if (strlen($article['TITLE']) > 60) {
                $article['TITLE'] = substr($article['TITLE'], 0, 60) . '...';
            }
        }

        return view('article_list')
            ->with('username', session('username'))
            ->with('articles', $articles);
    }
}
