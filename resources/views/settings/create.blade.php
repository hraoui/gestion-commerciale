@extends('layouts.dashboard')
@section('content')
    <div class="card ml-3 mr-3 mt-3 ">
        <div class="card-header mr-1 ml-1 bg-gradient-dark" >
            <h4 >réglages generales</h4>
        </div>
    </div>

        <div class="container">
            <div class="col-md-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="card">
                <div class="header">

                </div>
                <div class="body ml-3 mr-3 mb-2 mt-2">
                    <form action="{{route('settings.store')}}" method="post" >
                        @csrf
                        <div class="form-group">
                                <label>nom professionnel</label>
                                <input type="text" class="form-control" name="title" id="title" >
                        </div>


                        <div class="form-group">
                            <label for="inputPhoto" class="col-form-label">logo</span></label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-dark">
                                <i class="fa fa-picture-o"></i> Choisir
                                </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="logo" >
                            </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                        </div>
                        <div class="form-group">
                            <label for="inputPhoto" class="col-form-label">favicon</span></label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-dark">
                                <i class="fa fa-picture-o"></i> Choisir
                                </a>
                                </span>
                                <input id="thumbnail1" class="form-control" type="text" name="favicon" >
                            </div>
                                <div id="holder1" style="margin-top:15px;max-height:100px;"></div>

                        </div>

                            <br>
                        <button type="submit" class="btn btn-dark">sauvegarder</button>
                        <a href="" class="btn btn-dark">annuler</a>
                    </form>
                </div>
        </div>

@endsection
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
     <script>
      $('#lfm').filemanager('image');
      $('#lfm1').filemanager('image');
    </script>
@endsection

