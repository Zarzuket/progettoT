@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mx-auto no_border">Modifica il post</div>
                <div class="card-body">
					<form action="{{route("admin.posts.update", $post["id"])}}" method="POST">
						@csrf
						@method("PUT")
						<div class="form-group">
						  <label for="title">Titolo</label>
						  <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Inserisci il titolo" value="{{old("title") ?? $post["title"]}}">
						  @error('title')
							<div class="alert alert-danger">{{ $message }}</div>
						  @enderror
						</div>
						<div class="form-group">
							<label for="description">Descrizione</label>
							<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" placeholder="Inserisci la descrizione">{{old("description") ?? $post["description"]}}</textarea>
							@error('description')
								<div class="alert alert-danger">{{ $message }}</div>
						    @enderror
						</div>	
						<button type="submit" class="btn btn-primary">Salva</button>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection