@extends('layouts.dashboard')
@section('content')
  <div class="row">
        <div class="col mb-3 mt-5">
            <a href="{{ route('methods.create') }}" class="btn bg-gradient-dark ">ajouter mode de paiment</a>
        </div>
    </div>
    <div class="card">
    <div class="card-header bg-gradient-dark">
            <h3 class="card-title">toutes les modes </h3>
            <div class="card-tools">

            </div>
    </div>

        <div class="card-body">
            <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th scope="col">Mode</th>
                        <th scope="col">Détails</th>
                        <th scope="col">Transactions mensuelles</th>
                        <th scope="col">Balance mensuel</th>
                        <th scope="col">action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($methods as $method)
                            <tr>
                                <td>{{ $method->name }}</td>
                                <td>{{ $method->description }}</td>
                                <td>{{ $method->transactions->count() }}</td>
                                <td>{{ ($method->transactions->sum('amount')) }}</td>
                                 <td class="td-actions text-right">
                                            <a href="{{ route('methods.show', $method) }}" class="btn btn-sm  btn-dark" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('methods.edit', $method) }}" class="btn btn-sm  btn-dark" data-toggle="tooltip" data-placement="bottom" title="Delete Method">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('methods.destroy', $method) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Method" onclick="confirm('Are you sure you want to remove this method? The payment records will not be deleted.') ? this.parentElement.submit() : ''">
                                                    <i class="fas fa-trash"></i>
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
