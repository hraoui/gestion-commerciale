@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col mt-5 mb-3">

        </div>
    </div>
        <div class=" row mb-3">
            <div class="col-md-4 ">
                 <a href="{{ route('products.create') }}" class="btn bg-gradient  btn-dark ">ajouter nouveau produit</a>
            </div>
            <div class="col-md-8 ">
                <form action="{{ route('products.index') }}" method="GET" role="search">
                    <div class="input-group">
                        <span class="input-group-btn ">
                        <button class="btn bg-gradient  btn-dark mr-1" type="submit" title="Search products">
                            <span class="fas fa-search"></span>
                            </button>
                            </span>
                            <input type="text" class="form-control " name="term" placeholder="Search products" id="term">
                            <a href="{{ route('products.index') }}" >
                            <span class="input-group-btn">
                            <button class="btn bg-gradient btn-dark ml-1" type="button" title="Refresh page">
                            <span class="fas fa-sync-alt"></span>
                            </button>
                            </span>
                            </a>
                    </div>
                </form>
            </div>
        </div>


    <div class="card">
        <div class="card-header bg-gradient-dark">

            <div class="card-tools">
                    <h6>TOTAL: <span class="badge bg-dark  d-inline">{{ $products->count() }}</span></h6>
                </div>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Code_barre</th>
                            <th>Catégorie</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>QR code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key=>$product)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td> <img src="{{$product->photo}}" alt="product image" style="max-height:60px;max-width:60px"></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->barcode}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->price}} DHS</td>
                             <td> <a href="{{ route('generate',$product->id) }}" class="btn btn-sm btn-dark">Generer</a></td>
                            <td>
                                <a href="{{route('products.edit', $product->id)}}"class="btn bg-gradient  btn-sm btn-dark"><i class="fas fa-edit"></i></a>
                                <a href="{{route('products.show',$product->id)}} " class="btn bg-gradient  btn-sm btn-dark"><i class="fas fa-eye"></i></a>
                                <form action="{{ route('products.destroy', $product->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$products->links()}}
        </div>
    </div>
@endsection


