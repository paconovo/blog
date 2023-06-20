<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    //proteger rutas
    public function __construct()
    {
       $this->middleware('can:articles.index')->only('index'); 
       $this->middleware('can:articles.create')->only('create', 'store'); 
       $this->middleware('can:articles.edit')->only('edit', 'update'); 
       $this->middleware('can:articles.destroy')->only('destroy'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mostrar articulo en admin
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->simplePaginate(10);
        
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtener categorias publicas
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get();
        
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $request->merge(['user_id' => Auth::user()->id]);

        $article = $request->all();

        if($request->hasFile('image')){
            $article['image'] = $request->file('image')->store('articles');
        }

        Article::create($article);

        return redirect()->action([ArticleController::class, 'index'])
                            ->with('success-create', 'Articulo creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $this->authorize('published', $article);
        
        $comments = $article->comments()->simplePaginate(5);

        return view('subscriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize('view', $article);

        //obtener categorias publicas
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get();
        
        return view('admin.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        if($request->hasFile('image')){
            File::delete(public_path('storage/' . $article->image));

            $article['image'] = $request->file('image')->store('articles');
        }

        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'introduction' => $request->introduction,
            'body' => $request->body, 
            'user_id' => Auth::user()->id,
            'status' => $request->status, 
            'category_id' => $request->category_id, 
        ]);

        return redirect()->action([ArticleController::class, 'index'])
                            ->with('success-update', 'Articulo modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        if($article->image){
            File::delete(public_path('storage/' . $article->image));
        }

        $article->delete();

        return redirect()->action([ArticleController::class, 'index'], compact('article'))
                            ->with('success-delete', 'Articulo eliminado con exito');
    }
}
