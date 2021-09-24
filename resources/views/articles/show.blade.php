@extends('layouts.article')

@section('main')
    <div class="container">
        <a class="font-thin text-4xl hover:text-white" href="{{ route('root')}}">FREE TALK</a>
        <a class="font-thin text-3xl"> > {{ $article->title }}</a>
        <br><br>

        <div class="m-4 border border-gray-100 p-4 bg-gray-400 shadow-2xl">
            <a class="px-2 rounded bg-green-500 hover:bg-green-400 text-green-100 text-2xl" href="{{ route('articles.create') }}">發表文章</a>
            <br><br>
            <h1 class="ml-2 mb-2 font-thin text-3xl">標題：{{ $article->title }}</h1>
            <a class="ml-2 font-thin text-2xl">用戶：{{ $article->user->name }}</a>
            <a class="ml-10 font-thin text-2xl">時間：{{ $article->created_at }}</a>
            <hr class="mt-4 mb-4">
            <p class="ml-2 text-2xl text-gray-700 p-2">內文：</p>
            <pre class="ml-4 text-lg text-gray-700 p-2">{{ $article->content }}</pre>
            <hr class="mt-4 mb-4">
            <a class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300" href="{{ route('articles.index') }}">返回首頁</a>
        </div>
    </div>
@endsection