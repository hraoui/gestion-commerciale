@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col mb-3 mt-5">

                  <a href="{{route('sales.index')}}" class="btn btn-sm btn-dark">retour à la liste des ventes</a>
                    <a href="{{route('downloadPDF',$sale->id)}}" class="btn btn-sm  btn-dark "><i class="fas fa-file-pdf"></i> PDF</a>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header bg-gradient-dark">
                    <div class="row ">
                        <div class="col-8">
                            <h4 class="card-title ">détails de la commande</h4>
                        </div>
                        @if (!$sale->finalized_at)
                            <div class="col-4 text-right">
                                @if ($sale->products->count() == 0)
                                    <form action="{{ route('sales.destroy', $sale) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-light">
                                           supprimer la commande
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-light" onclick="confirm('ATTENTION : vous etes sure de finaliser ') ? window.location.replace('{{ route('sales.finalize', $sale) }}') : ''">
                                        Finaliser la commande
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Date</th>
                            <th>client</th>
                            <th>nombre de produit</th>
                            <th>quantité totale</th>
                            <th>montant total</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                                <td><a href="{{ route('customers.show', $sale->customer) }}">{{ $sale->customer->name }}</a></td>
                                <td>{{ $sale->products->count() }}</td>
                                <td>{{ $sale->products->sum('qty') }}</td>
                                <td>{{ ($sale->products->sum('total_amount')) }}</td>
                                <td>{!! $sale->finalized_at ? 'complétée le :<br>'.date('d-m-y', strtotime($sale->finalized_at)) : (($sale->products->count() > 0) ? 'à compléter' : 'en attente') !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-dark">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">produits: {{ $sale->products->sum('qty') }}</h4>
                        </div>
                        @if (!$sale->finalized_at)
                            <div class="col-4 text-right">
                                <a href="{{ route('sales.product.add', ['sale' => $sale->id]) }}" class="btn btn-sm btn-primary">Add</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Categorie</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                            @foreach ($sale->products as $sold_product)
                                <tr>
                                    <td>{{ $sold_product->product->id }}</td>
                                    <td><a href="{{ route('categories.show', $sold_product->product->category) }}">{{ $sold_product->product->category->name }}</a></td>
                                    <td><a href="{{ route('products.show', $sold_product->product) }}">{{ $sold_product->product->name }}</a></td>
                                    <td>{{ $sold_product->qty }}</td>
                                    <td>{{ ($sold_product->price) }}</td>
                                    <td>{{ ($sold_product->total_amount) }} dhs</td>
                                    <td class="td-actions text-right">

                                            <a href="{{ route('sales.product.edit', ['sale' => $sale, 'soldproduct' => $sold_product]) }}" class="btn btn-dark" title="modifier">
                                            <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('sales.product.destroy', ['sale' => $sale, 'soldproduct' => $sold_product]) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-dark" title="supprimer" onclick="confirm('vous etes sure!!') ? this.parentElement.submit() : ''">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
