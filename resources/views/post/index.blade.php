@extends('layouts.main')
@section('content')
    <div>
        <div>
            <a href="{{route('post.create')}}" class="btn btn-success mb-3 mt-3">Создать</a>
        </div>
        @foreach($posts as $post)
            <div><a class="btn btn-outline-secondary mt-3" href="{{route('post.show', $post->id)}}">{{$post->id}}
                    . {{$post->title}}</a></div>
        @endforeach

        <div class="mt-3">
            {{$posts->links()}}
        </div>
    </div>
@endsection
