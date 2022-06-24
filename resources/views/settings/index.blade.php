@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col mb-3 mt-5">
        </div>
    </div>

    <div class="card">
    <div class="card-header bg-gradient-dark">
     <h6 class="card-title">paramétres</h6>
    <div class="card-tools">
        <a href="{{route('settings.create')}}" class="btn btn-sm btn-default">Ajouter vos données</a>
    </div>

    </div>

        <div class="card-body">
            <table class="table table-stripped ">
                  <thead class="bg-gradient-dark">
                    <tr>
                        <th >nom </th>
                        <th></th>
                        <th >logo</th>
                        <th>favicon</th>
                        <th>action</th>

                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td></td>
                                <td colspan="1"><img src="{{$item->logo}}"   class="img-circle elevation-2" width="25%"; height="25%"></td>
                                <td><img src="{{$item->favicon}}"   class="img-circle elevation-2" width="15%"; height="15%"></td>
                                <td>
                                    <a href="{{route('settings.edit', $item->id)}}" title="edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
        </div>
    </div>


@endsection
