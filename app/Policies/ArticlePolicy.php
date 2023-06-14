<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function published(?User $user, Article $article){
        if($article->status == 1){
            return true;
        } else {
            return false;
        }
    }
}
