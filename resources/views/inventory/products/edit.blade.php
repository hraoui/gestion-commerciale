@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col mb-3 mt-5">
            <div class="row "></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-dark">
            <h6 >ajouter nouveau produit</h6>

        </div>
        <div class="card-body">
            <form action="{{route('products.update',$product->id)}}" method="post">
            @csrf
            @method('PUT')

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Nom du produit</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$product->name}}">
                    </div>
                    <div class="form-group col">
                        <label>code_bare</label>
                        <input type="text" class="form-control" name="barcode" id="barcode" value="{{$product->barcode}}">
                    </div>
                    <div class=" form-group col">
                        <label for="price">prix<span class="text-danger">*</span></label>
                        <input id="price" type="number" name="price"    value="{{$product->price}}" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="stock">quantité <span class="text-danger">*</span></label>
                        <input id="stock" type="number" name="stock" min="0" placeholder="Entrer quantité"  value="{{$product->stock}}" class="form-control">
                    </div>
                    <div class="form-group col" >
                        <label for="category_id">categorie </label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">--selectionner--</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}"> {{$category->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class=" form-group col">
                        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                        <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-dark">
                            <i class="fa fa-picture-o"></i> Choisir
                            </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col ">
                        <label for="description">description</label>
                        <textarea id="description" name="description" class="form-control" cols="30" rows="10" value="{{$product->description}}" >Description</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Enregistrer</button>
                <a href="{{route('products.index')}}" class="btn btn-dark">Annuler</a>
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
<script src="{{asset('summernote-0.8.18-dist/summernote.js')}}"></script>
@endsection

