@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    @foreach ($posts as $post)        
    <div class="col-md-7 card_post mt-5 p-3">
      <h2>{{$post->title}}</h2>
      <small>{{$post->user->name}}  {{$post->created_at}}</small>
      <p>
        @if (strlen($post->description) > 120)
        {{ substr($post->description, 0, 300) . '...' }}
        <a style="display: block; color: #ff5a5f; font-size: 1rem;"
            href="{{ route('posts.show', $post->slug) }}">
            Leggi tutto
        </a>
        @else
            {{ $post->description }}
        @endif
      </p>
    </div>
    @endforeach
  </div>
</div>
@endsection