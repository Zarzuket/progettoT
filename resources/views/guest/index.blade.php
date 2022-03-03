@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      @foreach ($posts as $post)
      @foreach ($post['images'] as $image)
      <div class="col-md-7 card_post mt-5 p-3">
        <div class="info">
          <a class="title_link" href="{{route('posts.show',$post->slug)}}">
            <h2>{{$post->title}}</h2>
          </a>
          <small>{{$post->user->name}}  {{$post->created_at}}</small>
        </div>
        <div class="separatore">
          <div class="img_container col-md-3">
            <img class="img_" src="{{ asset('images/' . $image['name']) }}"
            alt="{{ $image['name'] }}">
  
          </div>
          <div class="info_text col-md-9">
            <p>
              @if (strlen($post->description) > 50)
              {{ substr($post->description, 0, 50) . '...' }}
              <a style="display: block; color: #ff5a5f; font-size: 1rem;"
                  href="{{ route('posts.show', $post->slug) }}">
                  Leggi tutto
              </a>
              @else
                  {{ $post->description }}
              @endif
            </p>
          </div>
        </div>
      </div>
      @endforeach
      @endforeach
  </div> 
</div>
@endsection