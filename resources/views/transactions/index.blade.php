@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col mb-3 mt-5">

        </div>
    </div>
     <div class="card">
    <div class="card-header bg-gradient-dark">
           <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#transactionModal">
                               nouvelle opération
                            </button>
            <div class="card-tools">

            </div>
    </div>

        <div class="card-body">
            <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Method</th>
                        <th>Amount</th>
                        <th>client</th>
                        <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ date('d-m-y', strtotime($transaction->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('transactions.type', ['type' => $transaction->type]) }}">{{ $transactionname[$transaction->type] }}</a>
                                        </td>
                                        <td style="max-width:180px">{{ $transaction->title}}</td>
                                        <td><a href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a></td>
                                        <td>{{ ($transaction->amount) }} DHS</td>

                                        <td>
                                            @if ($transaction->customer)
                                                <a href="{{ route('customers.show', $transaction->customer) }}">{{ $transaction->customer->name }}</a>
                                            @else
                                                Does not apply
                                            @endif
                                        </td>


                                        <td class="td-actions text-right">
                                            @if ($transaction->sale_id)
                                                <a href="{{ route('sales.show', $transaction->sale) }}" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="More details">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                            @else
                                                <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Edit Transaction">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('transactions.destroy', $transaction) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Delete Transaction" onclick="confirm('Are you sure you want to delete this transaction?') ? this.parentElement.submit() : ''">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                  </tbody>
                </table>
        </div>
    </div>
     <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">nouvelle operation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="btn  btn-primary">recette</a>
                        <a href="{{ route('transactions.create', ['type' => 'expense']) }}" class="btn  btn-primary">dépenses</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
