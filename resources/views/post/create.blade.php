@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('post.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" placeholder="Content"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" class="form-control" name="image" id="image" placeholder="Image">
            </div>
            <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" id="category" name="category_id">
                    @foreach($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for = "tags">Tags</label>
            <select multiple class="form-control" id="tags" name="tags[]">
                @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->title}}</option>
                @endforeach

            </select>
            </div>




            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
