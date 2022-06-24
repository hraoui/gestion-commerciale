@extends('layouts.dashboard')
@section('content')
    <div class="row ">
        <div class="col mb-2 mt-5 text-center ">

        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark">
            <h6 class="text-center ">Ajout  des produits  à  la  commande</h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('sales.product.store', $sale) }}" autocomplete="off">
                @csrf
                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                <div class="row">
                    <div class="col form-group ml-5 mr-5 " >
                        <label for="product_id">Produit</label>
                        <select name="product_id"  id="input-product" class="form-control">
                            <option value="">--selectionner --</option>
                                <td>
                                    @foreach ($products as $product)
                                     <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </td>
                        </select>
                    </div>
                    <div class="col form-group ml-5 mr-5 " >
                        <label>Prix</label>
                        <input type="number" class="form-control mb-3" name="price" id="input-price">
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group ml-5 mr-5 " >
                        <label>Quantité</label>
                        <input type="number" class="form-control mb-3" name="qty" id="input-qty">
                    </div>
                    <div class="col form-group ml-5 mr-5 " >
                        <label class="form-control-label" for="input-total">Montant Total</label>
                                    <input type="text" name="total_amount" id="input-total" class="form-control" >
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark mt-4">Ajouter</button>

                </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        let input_qty = document.getElementById('input-qty');
        let input_price = document.getElementById('input-price');
        let input_total = document.getElementById('input-total');
        input_qty.addEventListener('input', updateTotal);
        input_price.addEventListener('input', updateTotal);
        function updateTotal () {
            input_total.value = (parseInt(input_qty.value) * parseFloat(input_price.value))+"DHs";
        }
    </script>

@endsection
