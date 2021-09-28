@extends('layouts.article')

@section('main')
    <div class="container">
        <a class="font-thin text-4xl hover:text-white" href="{{ route('root')}}">FREE TALK</a>
        <a class="font-thin text-3xl"> > 發表文章</a>

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


            <form class="container-fluid" action="{{ route('articles.store') }}" method="post">
                @csrf
                <div class="field my-2">
                    <label class="text-2xl" for="">標題：</label>
                    <input type="text" value="{{ old('title') }}" name="title" size="100" class="container rounded-lg border border-gray-300 p-2" placeholder="標題不得多於30個字元">
                </div>

                <div class="field my-2">
                    <label class="text-2xl" for="">內文：</label>
                    <br>
                    <textarea name="content" id="" cols="50" rows="10" class="container rounded-lg border border-gray-300 p-2" placeholder="內容不得少於10個字元">{{ old('content')}}</textarea>
                </div>

                <div class="flex">
                    <div class="actions">
                        <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">發表文章</button>
                    </div>
                    <a href="{{ route('root') }}" class="ml-2 px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">返回首頁</a>
                </div>
            </form>
        </div>
    </div>
@endsection