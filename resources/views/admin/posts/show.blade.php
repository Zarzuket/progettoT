@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <nav style="background: transparent;" >
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    </ol>
                </nav>
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.posts.create') }}">
                            <span data-feather="file">Crea Post</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h1>{{$post->title}}</h1>
                <p>{{$post->description}}</p>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
