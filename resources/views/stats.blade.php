@extends('layouts.dashboard')
@section('content')
<div class="row">
        <div class="col mb-3 mt-3">
            <div class="row"></div>
        </div>
    </div>
 <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Statistiques de opérations effectuée</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-dark">
                               afficher les opérations
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Periode</th>
                                <th>opération</th>
                                <th>revenue</th>
                                <th>dépenses</th>
                                <th>Total balance</th>

                            </thead>
                            <tbody>
                                @foreach ($transactionsperiods as $period => $data)
                                    <tr>
                                        <td>{{ $period }}</td>
                                        <td>{{ $data->count() }}</td>
                                        <td>{{ ($data->where('type', 'income')->sum('amount')) }}</td>
                                        <td>{{ ($data->where('type', 'expense')->sum('amount')) }}</td>
                                        <td>{{ ($data->sum('amount')) }}</td>

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
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">paiment en attente</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('customers.index') }}" class="btn btn-sm btn-dark">afficher clients</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>Client</th>
                                <th>achat</th>
                                <th>opération</th>
                                <th>Balance</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td><a href="{{ route('customers.show', $customer) }}">{{ $customer->name }}<br>{{ $customer->document_type }}-{{ $customer->document_id }}</a></td>
                                        <td>{{ $customer->sales->count() }}</td>
                                        <td>{{ ($customer->transactions->sum('amount')) }}</td>
                                        <td>
                                            @if ($customer->balance > 0)
                                                <span class="text-success">{{ ($customer->balance) }}</span>
                                            @elseif ($customer->balance < 0.00)
                                                <span class="text-danger">{{ ($customer->balance) }}</span>
                                            @else
                                                {{ ($customer->balance) }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('customers.transactions.add', $customer) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="bottom" title="effectuer operation">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="bottom" title="afficher Client">
                                                <i class="fas fa-eye"></i>
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

        <div class="col-md-6">
            <div class="card card-tasks">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Statistiques par mode de paiment</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('methods.index') }}" class="btn btn-sm btn-dark">afficher les modes</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <th>Mode</th>
                                <th>opérations {{ $date->year }}</th>
                                <th>Balance {{ $date->year }}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($methods as $method)
                                    <tr>
                                        <td><a href="{{ route('methods.show', $method) }}">{{ $method->name }}</a></td>
                                        <td>{{ ($transactionsperiods['Year']->where('paiment_method_id', $method->id)->count()) }}</td>
                                        <td>{{ ($transactionsperiods['Year']->where('paiment_method_id', $method->id)->sum('amount')) }}</td>
                                        <td>
                                            <a href="{{ route('methods.show', $method) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="bottom" title="See Method">
                                                <i class="fas fa-eye"></i>
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
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Statistiques des ventes</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('sales.index') }}" class="btn btn-sm btn-dark">afficher les ventes</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Periode</th>
                        <th>Ventes</th>
                        <th>Clients</th>
                        <th>Qté vendue</th>
                        <th data-toggle="tooltip" data-placement="bottom" title="montant de la facture">Montant</th>
                        <th>Confirmées</th>
                        <th>à Compléter</th>
                    </thead>
                    <tbody>
                        @foreach ($salesperiods as $period => $data)
                            <tr>
                                <td>{{ $period }}</td>
                                <td>{{ $data->count() }}</td>
                                <td>{{ $data->groupBy('customer_id')->count() }}</td>
                                <td>{{ $data->where('finalized_at', '!=', null)->map(function ($sale) {return $sale->products->sum('qty');})->sum() }}</td>
                                <td>{{ ($data->sum('total_amount')) }}</td>
                                <td>{{ ($data->where('finalized_at', '!=', null))->count() }}</td>
                                <td>{{ $data->where('finalized_at', null)->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@endsection
