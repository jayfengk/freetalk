@extends('layouts.article')

@section('main')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- 以迴圈印出資料 -->
                @foreach($articles as $article)
                    <!-- 用戶只看到自己的貼文 -->
                    <div class="rounded-lg border-t border-b border-gray-300 my-1 p-2 m-4 shadow-xl">
                        <h2 class="font-bold text-lg">
                            <!-- 檢視文章 -->
                            <a class="hover:text-gray-400" href="{{ route('articles.show', $article) }}">
                                {{ $article->title }}
                            </a>
                        </h2>
                        <div class="flex">
                            <p class="text-gray-900">
                                {{ $article->created_at }} 由 {{ $article->user->name }} 分享
                            </p>
                            <!-- 特定用戶登入才看到編輯刪除按鈕 -->
                            @if (Route::has('login'))
                                @auth
                                    @if (isset(Auth::user()->id) && Auth::user()->id == $article->user_id)
                                        <div class="flex">
                                            <a class="ml-2 mr-2 px-2 rounded bg-blue-500 hover:bg-blue-400 text-blue-100" href="{{ route('articles.edit', $article) }}">編輯</a>
                                            <form action="{{ route('articles.destroy', $article) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="px-2 rounded bg-red-500 hover:bg-red-400 text-red-100">刪除</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $articles->links()}}
        </div>
    </div>
</x-app-layout>
@endsection
