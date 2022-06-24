@extends('layouts.dashboard')
@section('content')
    <div class="row ml-4 mr-4">
        <div class="card">
            <div class="card-header"><h3>{{$product->name}}</h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">

                        <div class="col-12">
                            <img src="{{$product->photo}}" class="product-image" alt="Product Image">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 text-center mt-4">
                        <h5>{{$product->description}}</h5>
                        <div class="mt-4">
                        EN Stock: {{$product->stock}}
                        </div>
                        <div class="mt-4">
                        Prix Unitaire: {{$product->price}}
                        </div>
                    </div>
                    <a href="{{route('products.index')}}" class="btn btn-sm btn-dark">retour</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
