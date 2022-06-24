@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col mb-3 mt-5">
            <a href="{{ route('categories.create') }}" class="btn bg-gradient-dark ">ajouter nouvelle catégorie</a>
        </div>
    </div>
    <div class="card">
    <div class="card-header bg-gradient-dark">
            <h3 class="card-title">toute les catégories  </h3>
            <div class="card-tools">
                        <h6>TOTAL: <span class="badge bg-light ">{{ $categories->count() }}</span></h6>
            </div>
    </div>

        <div class="card-body">
            <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>N°</th>
                        <th>image</th>
                        <th>nom</th>
                        <th>Total produits</th>
                        <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($categories as $key=>$category)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                  <td><img src="{{$category->photo}}"   class="img-circle elevation-2" width="50"; height="50"></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products->count() }}</td>
                                <td>
                                    <a href="{{route('categories.edit', $category->id)}}" title="modifier" class="btn btn-sm btn-dark"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('categories.show', $category->id)}}" title="afficher" class="btn btn-sm btn-dark"><i class="fas fa-eye"></i></a>
                                    <form action="{{ route('categories.destroy', $category->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">supprimer</button>
                                </form>

                                </td>
                            </tr>
                        @endforeach

                  </tbody>
                </table>
        </div>
    </div>
@endsection
