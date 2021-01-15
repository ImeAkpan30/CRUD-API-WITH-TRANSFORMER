<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, Article $article){
        return $user->ownsArticle($article);
    }

    public function delete(User $user, Article $article){
        return $user->ownsArticle($article);
    }
}
