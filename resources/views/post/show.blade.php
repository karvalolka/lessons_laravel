@extends('layouts.main')
@section('content')
    <div>
        <div>{{$post->id}}. {{$post->title}}</div>
        <div>{{$post->content}}</div>
    </div>
    <div>
        <a class="btn btn-dark mt-3"   href="{{route('post.edit', $post->id)}}">Редактировать</a>
    </div>
    <div>
        <form action="{{route('post.delete', $post->id)}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Удалить" class="btn btn-danger mt-3">
        </form>
    </div>
    <div>
        <a class="btn btn-light mt-3" href="{{route('post.index')}}">Назад</a>
    </div>
@endsection
