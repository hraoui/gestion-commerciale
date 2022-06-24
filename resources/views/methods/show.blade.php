@extends('layouts.dashboard')
@section('content')
  <div class="row">
        <div class="col mb-3 mt-5">

        </div>
    </div>
    <div class="card">
    <div class="card-header bg-gradient-dark">
            <h3 class="card-title">MODE DE PAIMENT </h3>
            <div class="card-tools">

            </div>
    </div>

        <div class="card-body">
            <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mode</th>
                        <th>Description</th>
                        <th>Transactions</th>
                        <th>Balance/jour</th>
                        <th>Annual balance</th>
                    </tr>
                  </thead>
                  <tbody>
                        <td>{{ $method->id }}</td>
                        <td>{{ $method->name }}</td>
                        <td>{{ $method->description }}</td>
                        <td>{{ $method->transactions->count() }}</td>
                        <td>{{ ($balances['daily']) }}</td>
                        <td>{{ ($balances['annual']) }}</td>

                  </tbody>
                </table>
        </div>

    </div>
     <div class="row ml-5 mr-5">
            <a href="{{route('methods.index')}}" class="btn btn-dark">retour à la liste des modes de paiment</a>
        </div>



@endsection
