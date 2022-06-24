@extends('layouts.dashboard')
@section('content')
 <div class="row">
        <div class="col mb-3 mt-5">
            <div class="row "></div>
        </div>
    </div>
<div class="card">
    <div class="card-header">
    <h6> étape1</h6>
    </div>

    <div class="card-body">
         <form method="post" action="{{ route('sales.store') }}" autocomplete="off">
                            @csrf


            <div class="form-group ">
                <label for="customer_id">Client</label>
               <select required class="form-control" name="customer_id" id="customer_id">
                                <option value="">-- Client --</option>
                                @foreach($customers as $customer)
                                   <option value="{{ $customer->id }}" {{ $customer->id == 1? 'selected' : ''  }}>{{ $customer->name }}</option>
                                @endforeach
                            </select>
            </div>


               <button type="submit" class="btn btn-dark mt-4">Suivant</button>

        </form>


    </div>
</div>
@endsection


