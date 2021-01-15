<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */

    protected $availableIncludes = [
        'articles'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
{
    return [
        'name' => $user->name,
        'email' => $user->email,
        'registered_at' => $user->created_at->diffForHumans()
    ];
}

public function includeArticles(User $user){
    $articles = $user->articles()->latestFirst()->get();

    return $this->collection($articles, new ArticleTransformer);
}
}
