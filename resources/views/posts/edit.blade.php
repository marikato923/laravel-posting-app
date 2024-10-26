@extends('layouts.app')

@section('title', '投稿編集')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif

        <div class="mb-2">
        <a href="{{ route('posts.index') }}" class="text-decoration-none">&lt; 戻る</a>
        </div>

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>
        <div class="form-group mb-3">
            <label for="content">本文</label>
            <textarea class="form-control" id="content" name="content">{{ old('content', $post->content) }}</textarea>
        </div>

        <!-- 画像表示と投稿フォーム -->
        <div class="form-group mb-3">
            <label for="image">画像</label>
        @if($post->image_name)
        <img class="custum-img img-fluid" src="{{ asset('storage/posts/' . $post->image_name) }}" alt="アップロードした画像ファイル">
        <form action="{{ route('posts.image.delete', $post->id) }}" method="POST" onsubmit="return confirm('本当に画像を削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger my-3">画像を削除</button>
        </form>
        @endif
        <input type="file" class="form-control" id="image "name="image">
        </div>
        <button type="submit" class="btn btn-outline-primary">更新</button>
        </div>
        </form>
@endsection