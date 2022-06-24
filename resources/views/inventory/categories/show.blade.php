@extends('layouts.dashboard')
@section('content')

    <div class="row">
        <div class="col mb-3 mt-5">

        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark" >
             <h3>nom : {{ $category->name }}</h3>
        </div>
        <div class="card-body">*
            <div class="row">
                 <div class="col">
                <img src="{{$category->photo}}"   class="img-circle elevation-2" width="150"; height="150">
            </div>
            <div class="col">

              <h3 style="display: inline-block">nombre de produits: {{ $category->products->count() }}</h3>
            </div>
            </div>
            <div class="text-center">
                <a href="{{route('categories.index')}}" class="btn btn-dark">Retour à la liste</a>
            </div>

        </div>
    </div>

@endsection
