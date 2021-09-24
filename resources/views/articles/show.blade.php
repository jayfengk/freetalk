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
            <div>
                <pre class="ml-4 mr-4 text-lg p-2">{{ $article->content }}</pre>
            </div>
            <hr class="mt-4 mb-4">
            <div>
                回覆：
            </div>
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

                    <div class="field my-2">
                        <textarea name="content" id="" cols="50" rows="2" class="container border border-gray-300 p-2" placeholder="請輸入回覆">{{ old('content')}}</textarea>
                    </div>

                    <div class="flex">
                        <div class="actions">
                            <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">回覆文章</button>
                        </div>
                        <a href="{{ route('root') }}" class="ml-2 px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">返回首頁</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection