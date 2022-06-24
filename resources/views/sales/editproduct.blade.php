@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col mb-3 mt-5">

        </div>
    </div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
             <form method="post" action="{{ route('sales.product.update', ['sale' => $sale, 'soldproduct' => $soldproduct]) }}" autocomplete="off">
                            @csrf
                            @method('put')
                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                <div class="row">
                    <div class="col form-group ml-5 mr-5 " >
                        <label for="product_id">produit</label>
                        <select name="product_id"  id="input-product" class="form-control">
                            <option value="">--selectionner--</option>
                                <td>
                                    @foreach ($products as $product)
                                    @if($product['id'] == old('product_id') or $product['id'] == $soldproduct->product_id )
                                                <option value="{{$product['id']}}" selected>[{{ $product->category->name }}] {{ $product->name }} </option>
                                            @else
                                                <option value="{{$product['id']}}">[{{ $product->category->name }}] {{ $product->name }} </option>
                                            @endif
                                    @endforeach
                                </td>
                        </select>
                    </div>
                    <div class="col form-group ml-5 mr-5 " >
                        <label>prix</label>
                        <input type="number" class="form-control mb-3" name="price" id="input-price" value="{{ $soldproduct->price }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group ml-5 mr-5 " >
                        <label>Quantité</label>
                        <input type="number" class="form-control mb-3" name="qty" id="input-qty"  value="{{ old('qty', $soldproduct->qty) }}">
                    </div>
                    <div class="col form-group ml-5 mr-5 " >
                        <label class="form-control-label" for="input-total">Total Amount</label>
                                    <input type="text" name="total_amount" id="input-total" class="form-control" >
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark mt-4">modifier</button>
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
