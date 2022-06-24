@extends('layouts.dashboard')
@section('content')
  <div class="row">
        <div class="col mb-3 mt-5">
            <h3 class="text-center">Recettes et Revenues</h3>
        </div>
    </div>
    <div class="card">
    <div class="card-header bg-gradient-dark">

           <a type="button" class="btn btn-sm btn-default" href="{{ route('transactions.create', ['type' => 'income'])  }}">
                               nouvelle opération
           </a>
            <div class="card-tools">

            </div>
    </div>

        <div class="card-body">
            <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">nom</th>
                        <th scope="col">mode de paiment</th>
                        <th scope="col">montant</th>
                        <th scope="col">action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($transactions as $transaction)
                                    <tr>
                                        <td> {{ date('d-m-y', strtotime($transaction->created_at)) }}</td>
                                        <td> {{ $transaction->title }}</td>
                                        <td><a href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a></td>
                                        <td>{{ ($transaction->amount) }} DHS</td>
                                        <td class="td-actions text-right">
                                            @if ($transaction->sale_id)
                                                <a href="{{ route('sales.show', $transaction->sale_id) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="bottom" title="afficher">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="bottom" title="modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('transactions.destroy', $transaction) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="bottom" title="supprimer" onclick="confirm('Are you sure you want to delete this transaction? There will be no record left.') ? this.parentElement.submit() : ''">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                @endforeach
                  </tbody>
                </table>
        </div>
    </div>



@endsection
