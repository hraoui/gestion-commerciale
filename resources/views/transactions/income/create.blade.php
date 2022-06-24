@extends('layouts.dashboard')
@section('content')
 <div class="row">
        <div class="col mb-3 mt-5">
            <div class="row bg-gradient-dark"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark">
            <h6 >revenues et recettes</h6>

        </div>

        <div class="card-body">
            <form method="post" action="{{ route('transactions.store') }}">
                @csrf
                 <input type="hidden" name="type" value="income">
                <div class="row">
                    <div class="col form-group ml-5 mr-5 " >
                        <label>nom</label>
                        <input type="text" class="form-control mb-3" name="title" id="title">
                    </div>
                    <div class="form-group col" >
                        <label for="paiment_method_id">mode de paiment </label>
                        <select name="paiment_method_id" id="paiment_method_id" class="form-control">
                            <option value="">--selectionner--</option>
                                @foreach ($paiment_methods as $paiment_method)
                                @if($paiment_method['id'] == old('paiment_method_id'))
                                    <option value="{{$paiment_method['id']}}" selected>{{$paiment_method['name']}}</option>
                                @else
                                    <option value="{{$paiment_method['id']}}">{{$paiment_method['name']}}</option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group ml-5 mr-5 " >
                        <label>montant</label>
                        <input type="text" class="form-control mb-3" name="amount" id="amount">
                    </div>

                </div>


                    <button type="submit" class="btn btn-dark">créer</button>
                    <a href="{{route('transactions.index')}}" class="btn btn-dark">annuler</a>
                </div>
            </form>
        </div>
    </div>

@endsection

