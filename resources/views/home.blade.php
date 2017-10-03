@extends('layouts.app')

@section('content')
<div class="container">
    @forelse ($posts as $post)
        @can('view_post', $post)  
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>
            <br><b>Author: {{ $post->user->name }}</b>	
               @can('edit_post', $post)
                    <a href="{{url("/post/$post->id/update")}}">Editar</a>
               @endcan
            <hr>
         @endcan
    @empty
        <p>No post</p>
    @endforelse
</div>
@endsection
