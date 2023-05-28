<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Follow;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ProfileController extends BaseController
{
    function showProfile($username)
    {
        if (!session('user_id')) {
            return redirect('/login');
        } else {
            if (session('username') !== $username) {
                return redirect('/home');
            }
        }

        $account = Account::find(session('user_id'));

        foreach ($account->articles as $article) {
            if (strlen($article['TITLE']) > 60) {
                $article['TITLE'] = substr($article['TITLE'], 0, 60) . '...';
            }
        }

        return view('profile')
            ->with('username', session('username'))
            ->with('name', $account->NAME)
            ->with('surname', $account->SURNAME)
            ->with('articles', $account->articles)
            ->with('likes', $account->likes)
            ->with('followers', count($account->followers))
            ->with('followings', $account->followings);
    }

    function showAccount($username)
    {
        if (!session('user_id')) {
            return redirect('/login');
        } else {
            if (session('username') === $username) {
                return redirect("/profile/$username");
            }
        }

        $account = Account::all()->where('USERNAME', '=', $username)->firstOrFail();
        $followers = Account::find($account->ID)->followers;
        $contributions = Account::find($account->ID)->articles;

        foreach ($contributions as $contribution) {
            if (strlen($contribution['TITLE']) > 60) {
                $contribution['TITLE'] = substr($contribution['TITLE'], 0, 60) . '...';
            }
        }

        return view('account')
            ->with('username', session('username'))
            ->with('account', $account)
            ->with('followers', $followers)
            ->with('contributions', $contributions);
    }

    public function follows($followed)
    {
        $follow = Account::where('USERNAME', '=', $followed)
            ->firstOrFail()
            ->followers
            ->where("FOLLOWER", '=', session('user_id'));
        return ['follows' => count($follow) ? true : false];
    }

    public function addFollow($followed)
    {
        $follows = $this->follows($followed);
        if ($follows['follows']) {
            return 'Errore, già seguito!';
        }

        $id = Account::where('USERNAME', '=', $followed)
            ->firstOrFail()
            ->ID;

        $follow = new Follow;
        $follow->FOLLOWER = session('user_id');
        $follow->FOLLOWED = $id;
        $follow->save();

        return ['success' => true, 'num' => count(Account::where('USERNAME', '=', $followed)
            ->firstOrFail()
            ->followers)];
    }

    public function removeFollow($followed)
    {

        $follows = $this->follows($followed);
        if (!$follows['follows']) {
            return 'Utente non ancora seguito!';
        }

        $id = Account::where('USERNAME', '=', $followed)
            ->firstOrFail()
            ->ID;

        $follow = Follow::all()
            ->where('FOLLOWER', '=', session('user_id'))
            ->where('FOLLOWED', '=', $id)
            ->firstOrFail()
            ->ID;

        DB::table('follows')
            ->delete($follow);


        return ['success' => true, 'num' => count(Account::where('USERNAME', '=', $followed)
            ->firstOrFail()
            ->followers)];
    }
}
