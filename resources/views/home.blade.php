@extends('layouts.dashboard')

@section('content')
<div class="row">
        <div class="col mb-2 mt-2">

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header bg-gradient-dark ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Total Ventes</h5>
                            <h2 class="card-title">Bilan Annuel</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header bg-gradient-dark">
                    <h5 class="card-category">revenue du mois dernier </h5>
                    <h3 class="card-title"><i class="tim-icons icon-money-coins text-dark"></i>{{ ($semesterincomes) }} DHS</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header bg-gradient-dark">
                    <h5 class="card-category">Balance mensuel</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bank text-info"></i> {{ ($monthlybalance) }} DHS</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header bg-gradient-dark">

                    <h5 class="card-category">Frais et Dépense dernier mois</h5>
                    <h3 class="card-title"><i class="tim-icons icon-paper text-success"></i> {{ ($semesterexpenses) }} DHS</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header bg-gradient-dark">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">ventes en attente</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('sales.create') }}" class="btn btn-sm btn-default">nouvelle vente</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                       client
                                    </th>
                                    <th>
                                        Produits
                                    </th>
                                    <th>
                                        Montant
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unfinishedsales as $sale)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                                        <td><a href="">{{ $sale->customer->name }}<br>{{ $sale->customer->document_type }}-{{ $sale->customer->document_id }}</a></td>
                                        <td>{{ $sale->products->count() }}</td>
                                        <td>{{ ($sale->transactions->sum('amount')) }} DHS</td>
                                        <td>{{ ($sale->products->sum('total_amount')) }} DHS</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('sales.show', ['sale' => $sale]) }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="afficher">
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
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header bg-gradient-dark">
                <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Dernières opérations</h4>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#transactionModal">
                                nouvelle opération
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        Categorie
                                    </th>

                                    <th>
                                        mode de paiment
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($lasttransactions as $transaction)
                                    <tr>
                                        <td>
                                            @if($transaction->type == 'expense')
                                                Dépense
                                            @elseif($transaction->type == 'sale')
                                                Vente

                                                Payment
                                            @elseif($transaction->type == 'income')
                                                Revenue
                                            @else
                                                {{ $transaction->type }}
                                            @endif

                                        </td>

                                        <td>{{ $transaction->method->name }}</td>
                                        <td>{{ ($transaction->amount) }} DHS</td>
                                        <td class="td-actions text-right">
                                            @if ($transaction->sale_id)
                                                <a href="{{ route('sales.show', $transaction->sale_id) }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="afficher">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif
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

    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouvelle opération</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">

                        <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="btn btn-sm btn-default">Revenue et Recette</a>
                        <a href="{{ route('transactions.create', ['type' => 'expense']) }}" class="btn btn-sm btn-default">Dépenses</a>
                        <a href="{{ route('sales.create') }}" class="btn btn-sm btn-default">Sale</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script>
        var lastmonths = [];

        @foreach ($lastmonths as $id => $month)
            lastmonths.push('{{ strtoupper($month) }}')
        @endforeach

        var lastincomes = {{ $lastincomes }};
        var lastexpenses = {{ $lastexpenses }};
        var anualsales = {{ $anualsales }};
        var anualcustomers= {{ $anualcustomers}};
        var anualproducts = {{ $anualproducts }};
        var methods = [];
        var methods_stats = [];

        @foreach($monthlybalancebymethod as $method => $balance)
            methods.push('{{ $method }}');
            methods_stats.push('{{ $balance }}');
        @endforeach

        $(document).ready(function() {
            demo.initDashboardPageCharts();
        });
    </script>
@endsection
