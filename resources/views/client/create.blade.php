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
    swal({
    title: response.status,
    icon: success,
    text:{{ session('success') }}
    })
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form method="post" action="/client-save">
        {{ csrf_field() }}

        @hasanyrole('admin')
        <div class="mb-3">
            {{--display user_id from users table--}}
            <label for="">User Name</label>
            <select class="form-select" name="user_id">
                @foreach ($User as $user1)
                <option value="{{ $user1->id }}">{{ $user1->name }}</option>
                @endforeach
            </select>
            <input type="text" class="form-control" name="name">
        </div>

        @else
        <input type="text" name="user_id" value="{{auth()->user()->id}}" hidden>
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}" readonly>

        </div>
        @endhasanyrole

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



        <button type="submit" class="btn btn-primary">Save</button>

    </form>
</div>
@endsection