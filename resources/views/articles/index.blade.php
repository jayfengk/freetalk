@extends('layouts.article')

@section('main')
<body>
    <div class="container">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center text-gray-500 hover:text-gray-700">
            <x-jet-application-mark class="block h-9 w-auto" />
            <a class="ml-2 font-thin text-4xl text-black hover:text-white" href="{{ route('root')}}">FREE TALK</a>
        </div>
        @if(session()->has('notice'))
        <div class="bg-pink-300">
            {{ session()->get('notice')}}
        </div>
        @endif
        <br><br>
        <div class="m-4 rounded-lg border border-gray-100 p-4 bg-gray-400 shadow-xl">
            <div class="mb-4">
                <a class="px-2 rounded bg-green-500 hover:bg-green-400 text-green-100 text-2xl" href="{{ route('articles.create') }}">發表文章</a>
            </div>
            <div>
                <!-- 以迴圈印出資料 -->
                @foreach($articles as $article)
                <div class="rounded-lg border-t border-b border-gray-300 my-1 p-2 m-4 shadow-xl ">
                    <h2 class="font-bold text-lg">
                        <!-- 檢視文章 -->
                        <a class="hover:text-gary-100" href="{{ route('articles.show', $article) }}">
                            {{ $article->title }}
                        </a>
                    </h2>
                    <div class="flex">
                        <p class="text-gray-900">
                            {{ $article->created_at }} 由 {{ $article->user->name }} 分享
                        </p>
                        <!-- <p class="ml-2">有{{$collection->count()}}個回覆</p> -->
                        <!-- 作者登入才看到編輯刪除按鈕 -->
                        @if (Route::has('login'))
                            @auth
                                @if (isset(Auth::user()->id) && Auth::user()->id == $article->user_id)
                                <div class="flex">
                                    <a class="ml-2 mr-2 px-2 rounded bg-blue-500 hover:bg-blue-400 text-blue-100" href="{{ route('articles.edit', $article) }}">編輯</a>
                                    <form action="{{ route('articles.destroy', $article) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="px-2 rounded bg-red-500 hover:bg-red-400 text-red-100" onclick="return confirm('您確認要刪除嗎？')">刪除</button>
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
</body>
@endsection