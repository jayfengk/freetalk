@extends('layouts.article')

@section('main')
    <div class="container">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center text-gray-500 hover:text-gray-700">
            <x-jet-application-mark class="block h-9 w-auto" />
            <a class="ml-2 font-thin text-4xl text-black hover:text-white" href="{{ route('root')}}">FREE TALK</a>
        </div>
        <a class="font-thin text-3xl"> > 編輯文章</a>

        <div class="m-4 rounded-lg border border-gray-100 p-4 bg-gray-400 shadow-2xl">
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
                    <input type="text" value="{{ $article->title}}" name="title" size="100"  class="container rounded-lg border border-gray-300 p-2" placeholder="標題不得多於30個字元">
                </div>

                <div class="field my-2">
                    <label class="text-2xl" for="">內文：</label>
                    <textarea name="content" id="" cols="110" rows="10" class="container rounded-lg border border-gray-300 p-2" placeholder="內容不得少於10個字元">{{ $article->content}}</textarea>
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