@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Create Client</h1>
    @if(session('error'))
    <div class="alert alert-warning">
        {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form method="post" action="/client-save">
        {{ csrf_field() }}

        @auth
        <input type="text" name="user_id" value="{{auth()->user()->id}}" hidden>
        @endauth
        {{-- <div class="mb-3">
            @hasanyrole('admin')
            <label for="client_id" class="form-label">Select Client:</label>
            <select class="form-select client" name="client_id" required>
                <option>-----Please Select----</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>s
            @endhasanyrole
        </div> --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}" disabled>

        </div>


        <div class=" mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="number" class="form-control" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="regNo" class="form-label">Registration Number:</label>
            <input type="text" class="form-control" name="regNo" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" name="email" required>
        </div>


        {{-- @hasanyrole('admin') --}}
        <button type="submit" class="btn btn-primary">Save</button>
        {{-- @endhasanyrole --}}
    </form>
</div>
@endsection