<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transformers\ArticleTransformer;

class ArticleController extends Controller
{
    public function add(Request $request, Article $article){
        $this->validate($request,[
            'content' => 'required|min:5'
        ]);

        $article = $article->create([
            'user_id' => Auth::user()->id,
            'content' => $request->content
        ]);

        $response = fractal()
            ->item($article)
            ->transformWith(new ArticleTransformer)
            ->toArray();

        return response()->json($response, 201);
    }

    public function update(Request $request, Article $article){
        $this->authorize('update',$article);
        $article->content = $request->get('content',$article->content);
        $article->save();

        $response = fractal()
            ->item($article)
            ->transformWith(new ArticleTransformer)
            ->toArray();

        return response()->json($response, 200);
    }

    public function delete(Article $article){
        $this->authorize('delete',$article);
	    $article->delete();

	    return response()->json(['message' => 'Article has been deleted']);
    }
}
