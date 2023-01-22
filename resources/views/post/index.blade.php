@extends('layouts.main')
@section('content')
<div>
    <div  >
        <a href = "{{route('post.create')}}" class="btn btn-primary mb-3">Create</a>
    </div>
@foreach($posts as $post)
        <div><a href = "{{route('post.show', $post->id)}}"> {{$post->id}}.{{$post->title}}</a></div>
    {{--<div>{{$post->content}}</div>--}}
@endforeach
    <div class="mt-4">
    {{$posts->withQueryString()->links()}}
    </div>
</div>
@endsection
