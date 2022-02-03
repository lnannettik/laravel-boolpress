@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blog Posts</h1>

    @if (session('deleted'))
        <div class="alert alert-success">
            <strong>{{ session('deleted') }}</strong>
            deleted successfully.
        </div>
    @endif



    @if ($posts->isEmpty())
        <p>No post found yet. <a href="{{ route('admin.posts.create') }}">Create a new one</a></p>
        
    @else
        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>

            <tbody>
                
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if($post->category)  
                            <a href="{{ route('admin.category', $post->category->id)}}">{{ $post->category->name }}</a>
                        @else 
                        Uncategorised 
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-success" href="{{ route('admin.posts.show', $post->slug) }}">Show</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            
                            <input type="submit" class="btn btn-danger" value="Delete" />

                        </form>
                    </td>

                </tr>
                    
                @endforeach
            </tbody>

        </table>
        
    @endif
</div>
    
@endsection


