@extends('layouts.dashboard')
@section('content')
  <div class="row">
        <div class="col mb-3 mt-5">
             <a href="{{ route('sales.create') }}" class="btn btn-dark  bg-gradient">ajouter vente</a>
        </div>
    </div>
    <div class="card">
    <div class="card-header bg-gradient-dark">

            <div class="card-tools">

            </div>
    </div>

        <div class="card-body">
            <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Produits</th>
                        <th>quantité</th>
                        <th>total</th>
                        <th>avance et paiment</th>
                        <th>Status</th>
                        <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($sales as $sale)
                        <tr>
                            <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                             <td><a href="{{ route('customers.show', $sale->customer) }}">{{ $sale->customer->name }}<br> </a></td>
                            <td>{{ $sale->products->count() }}</td>
                            <td>{{ $sale->products->sum('qty') }}</td>
                            <td>{{$sale->total_amount }} DHS</td>
                              <td>
                                  @if ($sale->transactions->sum('amount')<=0)
                                <a class="text-danger" href="{{route('sales.addtransaction',$sale)}}">ajouter paiment</a>
                                @else
                                <span class="text-success">{{$sale->transactions->sum('amount')}} DHS</span>
                                @endif</td>
                            <td>
                                @if (!$sale->finalized_at)
                                <span class="text-danger">à compléter</span>
                                @else
                                <span class="text-success">confirmée</span>
                                @endif
                                </td>
                            <td >
                                @if (!$sale->finalized_at)
                                    <a href="{{ route('sales.show', ['sale' => $sale]) }}" class="btn btn-dark"  title="Edit Sale">
                                   <i class="fas fa-edit"></i>
                                    </a>
                                @else
                                    <a href="{{ route('sales.show', ['sale' => $sale]) }}" class="btn btn-dark"  title="View Sale">
                                   <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                <form action="{{ route('sales.destroy', $sale) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger" title="Delete Sale" onclick="confirm('vous etes sure!!') ? this.parentElement.submit() : ''">
                                    <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                  </tbody>
                </table>
        </div>
    </div>



@endsection
