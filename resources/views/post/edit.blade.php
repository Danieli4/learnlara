@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('post.update', $post->id)}}" method="post">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" >{{$post->content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" class="form-control" name="image" id="image" value="{{$post->image}}">
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" id="category" name="category_id">
                    @foreach($categories as $cat)
                        <option
                            {{$cat->id===$post->category_id ? 'selected' : ''}}
                            value="{{$cat->id}}">{{$cat->title}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary" >Update</button>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
