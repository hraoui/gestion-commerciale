@extends('layouts.dashboard')
@section('content')
 <div class="row">
        <div class="col mb-3 mt-5">
            <div class="row bg-gradient-dark"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark">
            <h6 >ajouter nouveau client</h6>

        </div>
        <div class="card-body">
             <form action="{{route('customers.update',$customer->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col form-group ml-5 mr-5 " >
                        <label>nom</label>
                        <input type="text" class="form-control mb-3" name="name" id="name" value="{{$customer->name}}">
                    </div>
                    <div class="col form-group ml-5 mr-5 " >
                        <label>téléphone</label>
                        <input type="text" class="form-control mb-3" name="phone" id="phone" value="{{$customer->phone}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group ml-5 mr-5 " >
                        <label>email</label>
                        <input type="email" class="form-control mb-3" name="email" id="email" value="{{$customer->email}}">
                    </div>
                    <div class="col form-group ml-5 mr-5 " >
                        <label>adresse</label>
                        <input type="text" class="form-control mb-3" name="address" id="address" value="{{$customer->address}}">
                    </div>
                </div>
                 <div class="form-group">
                            <label for="inputPhoto" class="col-form-label">logo</span></label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-dark">
                                <i class="fa fa-picture-o"></i> Choisir
                                </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="logo" placeholder="si le client a un logo">
                            </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                    </div>


                    <button type="submit" class="btn btn-dark">modifier</button>
                    <a href="{{route('customers.index')}}" class="btn btn-dark">annuler</a>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
     <script>
      $('#lfm').filemanager('image');

    </script>
@endsection
