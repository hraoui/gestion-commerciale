@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col mb-3 mt-5">
            <a href="{{ route('customers.create') }}" class="btn bg-gradient-dark ">ajouter nouveau client</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark">
                <h3 class="card-title">toute les clients </h3>
                <div class="card-tools">
                            <h6>TOTAL: <span class="badge bg-light ">{{ $customers->count() }}</span></h6>
                </div>
        </div>

        <div class="card-body">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>nom</th>
                        <th>téléphone</th>
                        <th>email</th>
                        <th>adresse</th>

                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $key=>$customer)
                        <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer-> phone}}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer-> address}}</td>

                                <td>
                                     <a href="{{route('customers.show',$customer->id)}} " class="btn bg-gradient  btn-sm btn-dark"><i class="fas fa-eye"></i></a>
                                    <a href="{{route('customers.edit', $customer->id)}}" title="modifier" class="btn btn-sm btn-dark"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('customers.destroy', $customer->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                                </form>

                                </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <table class="table table-hover text-nowrap">
            <thead>
                <th>nom</th>
                <th>Balance</th>
                <th>les achats</th>
                <th>Total Paiment</th>
                <th>derniere facture</th>
            </thead>
            <tbody>
                @foreach ($customers as $key=>$customer)
                <td>{{ $customer->name }}</td>
                <td>  @if (round($customer->balance) > 0)
                    <span class="text-success">{{ ($customer->balance) }}</span>
                    @elseif (round($customer->balance) < 0.00)
                    <span class="text-danger">{{ ($customer->balance) }}</span>
                    @else
                    {{ ($customer->balance) }}
                    @endif
                </td>
                <td>{{ $customer->sales->count() }}</td>
                <td>{{($customer->transactions->sum('amount')) }}</td>
                <td>{{ ($customer->sales->sortByDesc('created_at')->first()) ? date('d-m-y', strtotime($customer->sales->sortByDesc('created_at')->first()->created_at)) : 'aucune facture en cours' }}</td>
                @endforeach
            </tbody>
        </table>
    </div>



@endsection
