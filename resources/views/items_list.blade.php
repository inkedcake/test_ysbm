@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-info m-5 " href="{{route('home')}}">Back to shipments list</a>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <form id="create_item">
                    @csrf
                    <div class="form-row align-items-start ">
                        <div class="col-auto">
                            <input id="name" placeholder="Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required >
                            <input id="shipment_id" type="text" class="form-control @error('code') is-invalid @enderror" name="shipment_id" value="{{ $shipment_id }}" required hidden="hidden">
                        </div>
                        <div class="col-auto">
                            <input id="code" placeholder="Code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" id='btn-add-item' value="add" class="btn btn-primary mb-2">Add item</button>
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
                                <th class="col-sm-4" scope="col">Name</th>
                                <th class="col-sm-4" scope="col">Code</th>
                                <th class="col-2" scope="col"></th>

                            </tr>
                            </thead>
                            <tbody  id="items-list">
                            @foreach($items as $item)
                                <tr class="d-flex" id="{{$item->id}}">
                                    <th class="col-2" scope="row">{{$item->id}}</th>
                                    <td class="col-sm-4">{{$item->name}}</td>
                                    <td class="col-sm-4">{{$item->code}}</td>
                                    <td class="col-2">
                                        <a class="btn btn-info" href="/dashboard/{{$item->shipment_id}}/item/{{$item->id}}/edit">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </a>
                                        <button class="btn btn-danger btn-delete-item" value="{{$item->id}}">
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
