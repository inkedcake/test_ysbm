@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form id="create_shipment">
                @csrf
                <div class="form-row align-items-start ">
                    <div class="col-auto">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="col-auto">
                        <button type="submit" id='btn-add-shipment' value="add" class="btn btn-primary mb-2">Add shipment</button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-striped">
                            <thead>
                            <tr  class="d-flex" >
                                <th class="col-2" scope="col">#</th>
                                <th class="col-sm-8" scope="col">Name</th>
                                <th class="col-2" scope="col"></th>

                            </tr>
                            </thead>
                            <tbody  id="todos-list">
                            @foreach($shipments as $shipment)
                            <tr class="d-flex" id="{{$shipment->id}}">
                                <th class="col-2" scope="row">{{$shipment->id}}</th>
                                <td class="col-sm-8">{{$shipment->name}}</td>
                                <td class="col-2">
                                    <a class="btn btn-info" href="/dashboard/{{$shipment->id}}/list_items">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
                                            <circle cx="3.5" cy="5.5" r=".5"/>
                                            <circle cx="3.5" cy="8" r=".5"/>
                                            <circle cx="3.5" cy="10.5" r=".5"/>
                                        </svg>
                                    </a>
                                    <button class="btn btn-danger btn-delete-shipment" value="{{$shipment->id}}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
