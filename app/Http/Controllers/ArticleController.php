<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ArticleController extends BaseController
{
    public function showArticle($article)
    {
        if (!session('user_id'))
            return redirect('login');
        $a = Article::find($article);

        if (!$a->count()) {
            return redirect('home');
        } else {
            return view('article')
                ->with('article', $a)
                ->with('username', session('username'));
        }
    }

    public function deleteArticle($id)
    {
        $article = Article::find($id);
        if ($article->AUTHOR !== session('user_id'))
            return 'Non Autorizzato!';

        DB::table('likes')->where('ARTICLE', '=', $article->ID)->delete();
        DB::table('comments')->where('ARTICLE', '=', $article->ID)->delete();
        DB::table('articles')->delete($article->ID);
        return redirect('article_list');
    }

    public function isLiked($article)
    {
        $a = Article::find($article);
        $isLiked = count($a->likes->where('AUTHOR', '=', session('user_id')));
        return ['likes' => $isLiked];
    }

    public function like($article)
    {
        $a = Article::find($article);
        $like = $a->likes->where('AUTHOR', '=', session('user_id'))->first();

        if ($like) {
            DB::table('likes')->delete($like['ID']);
            return ['success' => true, 'num' => count(Article::find($article)->likes)];
        } else {
            $like = new Like;
            $like->ARTICLE = $article;
            $like->AUTHOR = session('user_id');
            $like->save();
            return ['success' => true, 'num' => count(Article::find($article)->likes)];
        }
    }

    public function postComment(Request $request)
    {
        $comment = new Comment;
        $comment->AUTHOR = session('user_id');
        $comment->CONTENT = $request->content;
        $comment->ARTICLE = $request->article;
        $comment->COMMENT_DATE = date('d/m/Y');
        $comment->save();
        return ['success' => true];
    }

    public function getComments($article)
    {
        $comments = Article::find($article)->comments;
        foreach ($comments as $comment) {
            $c[] = [
                'CONTENT' => $comment->CONTENT,
                'COMMENT_DATE' => $comment->COMMENT_DATE,
                'USERNAME' => $comment->author->USERNAME
            ];
        }
        return ['num' => count($comments), 'comments' => $c];
    }
}
