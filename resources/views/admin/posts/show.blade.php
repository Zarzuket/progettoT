@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
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
