@extends('layouts.base')

@section('styles')
    <link   rel="stylesheet" href="{{ asset('css/manage_post/categories/css/article_category.css')}}"></link>
@endsection

@section('title', 'Blog')

@section('content')

@include('layouts.navbar')

<div class="slogan">
    <div class="column1">
        <h2>BLOG</h2>
    </div>
    <div class="column2">
        <p>Blog de infomática.
            Para practicar Laravel
        </p>
    </div>
</div>

<div class="article-container">
    <!-- Listar artículos -->
    @foreach ($articles as $article)

    <article class="article">
        <img src="{{ asset('storage/' . $article->image) }}" class="img">
        <div class="card-body">
            <a href="{{ route('articles.show', $article->slug) }}">
                <h2 class="title">{{ Str::limit($article->title, 60, '...') }}</h2>
            </a>
            <p class="introduction">{{ Str::limit($article->title, 100, '...') }}</p>
        </div>
    </article>
    @endforeach
</div>
<div class="links-paginate">
    {{ $articles->links() }}
</div>
@endsection