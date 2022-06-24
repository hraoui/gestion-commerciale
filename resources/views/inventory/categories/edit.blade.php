@extends('layouts.dashboard')
@section('content')
 <div class="row">
        <div class="col mb-3 mt-5">
            <div class="row"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark">
            <h6 >modifier catégorie</h6>

        </div>
        <div class="card-body">
            <form action="{{route('categories.update',$category->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group ml-5 mr-5 " >
                    <label>nom</label>
                    <input type="text" class="form-control mb-3" name="name" id="name" value="{{$category->name}}">
                    <div class="form-group">
                                <label for="inputPhoto" class="col-form-label">photo</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-dark">
                                        <i class="fa fa-picture-o"></i> Choisir
                                        </a>
                                    </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$category->photo}}" >
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                                </div>

                    <button type="submit" class="btn btn-dark">Modifier</button>
                    <a href="{{route('categories.index')}}" class="btn btn-dark">Annuler</a>
                </div>
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

