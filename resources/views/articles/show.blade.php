@extends('layouts.article')

@section('main')
    <div class="container">
        <a class="font-thin text-4xl hover:text-white" href="{{ route('root')}}">FREE TALK</a>
        <a class="font-thin text-3xl"> > {{ $article->title }}</a>
        <br><br>

        <div class="m-4 border border-gray-100 p-4 bg-gray-400 shadow-2xl">
            <a class="px-2 rounded bg-green-500 hover:bg-green-400 text-green-100 text-2xl" href="{{ route('articles.create') }}">發表文章</a>
            <br><br>
            <div>
                <h1 class="ml-2 mb-2 font-thin text-3xl">標題：{{ $article->title }}</h1>
            </div>
            <div>
                <a class="ml-2 font-thin text-2xl">用戶：{{ $article->user->name }}</a>
                <a class="ml-10 font-thin text-2xl">時間：{{ $article->created_at }}</a>
            </div>
            <hr class="mt-4 mb-4">
            <div>
                <p class="ml-2 text-2xl text-gray-700 p-2">內文：</p>
            </div>
            <div>
                <pre class="ml-4 mr-4 text-lg p-2">{{ $article->content }}</pre>
            </div>
            <hr class="mt-4 mb-4">
            <div>
                <p class="ml-2 text-2xl text-gray-700 p-2">回覆：</p>
            </div>
                <hr class="mt-4 mb-4">
            @if (Route::has('login'))
                @auth
                <div>
                    <!-- 錯誤提示 -->
                    @if($errors->any())
                        <div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="container-fluid" action="{{ route('comments.store') }}" method="post">
                        @csrf
                        <p>{{ Auth::user()->name }}：</p>
                        <div class="flex field my-2">
                            <textarea name="content" id="" cols="50" rows="1" class="container border border-gray-300 p-2" placeholder="請輸入回覆內容">{{ old('content')}}</textarea>
                            <div class="actions">
                                <button type="submit" class="px-3 py-3 ml-2 rounded bg-gray-200 hover:bg-gray-300 text-nowrap">回覆</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="mt-4 mb-4">
                @else
                @endauth
            @endif
            <div>
                <a href="{{ route('root') }}" class="ml-2 px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">返回首頁</a>
            </div>
        </div>
    </div>
@endsection