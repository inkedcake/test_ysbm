@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-info m-5 " href="{{route('list_items',['id'=>$item->shipment_id])}}">Back to items list</a>

        <div class="row justify-content-center">

            <div class="col-md-10">

                <form id="item_update_form">
                   @csrf
                    <div class="form-group">
                        <label for="name">Item name</label>
                        <input type="text" class="form-control" id="name" value="{{$item->name}}"
                               placeholder="Enter item name">
                    </div>
                    <div class="form-group">
                        <label for="code">Item code</label>
                        <input type="text" class="form-control" id="code" value="{{$item->code}}"
                               placeholder="Code">
                    </div>
                    <button type="submit" class="btn btn-primary" id="item_update" value="{{$item->id}}">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection