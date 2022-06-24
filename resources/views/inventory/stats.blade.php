@extends('layouts.dashboard')
@section('content')
 <div class="row">
        <div class="col mb-3 mt-3">

        </div>
    </div>
     <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-dark">
                    <h4 class="card-title">Statistiques</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Categorie</th>
                            <th>Produit</th>
                            <th>En Stock</th>
                            <th>Qté vendues</th>
                            <th>Prix moyen</th>
                            <th>revenue</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($soldproductsbystock as $soldproduct)
                                <tr>
                                    <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product_id }}</a></td>
                                    <td><a href="{{ route('categories.show', $soldproduct->product->category) }}">{{ $soldproduct->product->category->name }}</a></td>
                                    <td>{{ $soldproduct->product->name }}</td>
                                    <td>{{ $soldproduct->product->stock }}</td>
                                    <td>{{ $soldproduct->total_qty }}</td>
                                    <td>{{ (round($soldproduct->avg_price, 2)) }} DHS</td>
                                    <td>{{ ($soldproduct->incomes) }} DHS</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('products.show', $soldproduct->product) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="afficher">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header  bg-gradient-dark">
                    <h4 class="card-title">Statistics par revenue (TOP 15)</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Categorie</th>
                                <th>produit</th>
                                <th>vendus</th>
                                <th>revenue</th>
                            </thead>
                            <tbody>
                                @foreach ($soldproductsbyincomes as $soldproduct)
                                    <tr>
                                        <td>{{ $soldproduct->product_id }}</td>
                                        <td><a href="{{ route('categories.show', $soldproduct->product->category) }}">{{ $soldproduct->product->category->name }}</a></td>
                                        <td><a href="{{ route('products.show', $soldproduct->product) }}">{{ $soldproduct->product->name }}</a></td>
                                        <td>{{ $soldproduct->total_qty }}</td>
                                        <td>{{ ($soldproduct->incomes) }} DHS</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header  bg-gradient-dark">
                    <h4 class="card-title">inventaire du stock</h4>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>

                                <th>Categorie</th>
                                <th>Produit</th>
                                <th>Qté vendue</th>
                                <th>stock</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>

                                        <td><a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a></td>
                                        <td><a href="{{ route('products.show', $product) }}">{{$product->name }}</a></td>
                                        <td>{{ $soldproduct->total_qty }}</td>
                                        <td>{{$product->stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
