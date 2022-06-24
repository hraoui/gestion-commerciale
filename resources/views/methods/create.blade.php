@extends('layouts.dashboard')
@section('content')
 <div class="row">
        <div class="col mb-3 mt-5">
            <div class="row bg-gradient-dark"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark">
            <h6 >ajouter nouveau mode de paiment</h6>

        </div>
        <div class="card-body">
            <form action="{{route('methods.store')}}" method="POST">
                @csrf
                <div class="row">
                     <div class="col  form-group">
                    <label for="name">mode de paiment</label>
                    <input type="text" name="name" id="name" class="form-control" >
                </div>
                <div class="col form-group">
                    <label for="description">description</label>
                    <input type="text" name="description" id="description" class="form-control" >
                </div>

                </div>
                <button type="submit" class="btn btn-dark">Enregistrer</button>
                <a href="{{route('methods.index')}}" class="btn btn-dark">Annuler</a>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
     <script>
      $('#lfm').filemanager('photo');

    </script>
@endsection

