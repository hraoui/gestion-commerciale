@extends('layouts.dashboard')
@section('content')
<div class="row">
        <div class="col mb-3 mt-5">
              <div class="row bg-gradient-dark"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark">
            <h6>paiment de la vente {{$sale->created_at}}</h6>

        </div>
        <div class="card-body">
            <form method="post" action="{{ route('sales.transaction.store', $sale) }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                            <input type="hidden" name="customer_id" value="{{ $sale->customer_id }}">


                            <h6 class="heading-small text-muted mb-4"></h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">type d'operation</label>
                                    <select name="type" id="input-method" class=" form-select form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                        <option value="">--type d'operation--</option>
                                        @foreach (['income' => 'paiment reçu', 'expense' => 'frais et retour'] as $type => $title)
                                            @if($type == old('type'))
                                                <option value="{{$type}}" selected>{{ $title }}</option>
                                            @else
                                                <option value="{{$type}}">{{ $title }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group{{ $errors->has('paiment_method_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">mode de paiment</label>
                                    <select name="paiment_method_id" id="input-method" class="form-select form-control-alternative{{ $errors->has('paiment_method_id') ? ' is-invalid' : '' }}" required>
                                        <option value="">--mode de paiment--</option>
                                        @foreach ($paiment_methods as $paiment_method)
                                            @if($paiment_method['id'] == old('paiment_method_id'))
                                                <option value="{{$paiment_method['id']}}" selected>{{$paiment_method['name']}}</option>
                                            @else
                                                <option value="{{$paiment_method['id']}}">{{$paiment_method['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">montant</label>
                                    <input type="number" step=".01" name="amount" id="input-amount" class="form-control form-control-alternative" placeholder="montant" value="{{ old('amount') }}" required>


                                </div>



                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark mt-4">Enregistrer</button>
                                </div>
                            </div>
                        </form>
        </div>
    </div>

@endsection
