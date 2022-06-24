@extends('layouts.dashboard')
@section('content')
<div class="row">
        <div class="col mb-3 mt-5">
              <div class="row bg-gradient-success"></div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bilan de {{$customer->name}}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>nom</th>

                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Balance</th>
                            <th>achats</th>
                            <th>Total Paiment</th>

                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>

                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    @if ($customer->balance > 0)
                                        <span class="text-success">{{($customer->balance) }} DHS</span>
                                    @elseif ($customer->balance < 0.00)
                                        <span class="text-danger">{{($customer->balance) }} DHS</span>
                                    @else
                                        {{$customer->balance }} DHS
                                    @endif
                                </td>
                                <td>{{ $customer->sales->count() }}</td>
                                <td>{{$customer->transactions->sum('amount') }} DHS</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">les dernières operations de {{$customer->name}}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('customers.transactions.add', $customer) }}" class="btn btn-sm btn-dark">nouvelle opération</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Date</th>
                            <th>mode</th>
                            <th>montant</th>
                        </thead>
                        <tbody>
                            @foreach ($customer->transactions->reverse()->take(25) as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ date('d-m-y', strtotime($transaction->created_at)) }}</td>
                                    <td><a href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a></td>
                                    <td>{{$transaction->amount }} DHS</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">les dernières achats du {{$customer->name}}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <form method="post" action="{{ route('sales.store') }}">
                                @csrf

                                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                <button type="submit" class="btn btn-sm btn-dark">nouvelle achat</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Date</th>
                            <th>products</th>
                            <th>Stock</th>
                            <th>Total Amount</th>
                            <th>State</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($customer->sales->reverse()->take(25) as $sale)
                                <tr>
                                    <td><a href="{{ route('sales.show', $sale) }}">{{ $sale->id }}</a></td>
                                    <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                                    <td>{{ $sale->products->count() }}</td>
                                    <td>{{ $sale->products->sum('qty') }}</td>
                                    <td>{{($sale->products->sum('total_amount')) }} DHS</td>
                                    <td>{{ ($sale->finalized_at) ? 'complétée' : 'en attente' }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                            <i class="fa fa-eye"></i>
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
@endsection
