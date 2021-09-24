@extends('layouts.article')

@section('main')
    <div class="container">
        <a class="font-thin text-4xl hover:text-white" href="{{ route('root')}}">FREE TALK</a>
        <a class="font-thin text-3xl"> > 編輯文章</a>

        <div class="m-4 border border-gray-100 p-4 bg-gray-400 shadow-2xl">
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

            <form action="{{ route('articles.update', $article) }}" method="post">
                @csrf
                @method('patch')
                <div class="field my-2">
                    <label class="text-2xl" for="">標題：</label>
                    <input type="text" value="{{ $article->title}}" name="title" size="100"  class="container border border-gray-300 p-2" placeholder="必須輸入標題">
                </div>

                <div class="field my-2">
                    <label class="text-2xl" for="">內文：</label>
                    <textarea name="content" id="" cols="110" rows="10" class="container border border-gray-300 p-2" placeholder="內容不能少於10個字元">{{ $article->content}}</textarea>
                </div>

                <div class="flex">
                    <div class="actions">
                        <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">更新文章</button>
                    </div>
                    <a href="{{ route('root') }}" class="ml-2 px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">返回首頁</a>
                </div>
            </form>
        </div>
    </div>
@endsection