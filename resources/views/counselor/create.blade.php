@extends('layouts.master')

@section('content')
<div class="container">

    <h1>Create Counselor</h1>

    <form method="post" action="{{ url('/counselor-save') }}">
        @csrf
        <div class="mb-3">
            {{--display user_id from users table--}}
            <label for="">User Name</label>
            <select class="form-select" name="user_id">
                @foreach ($User as $user1)
                <option value="{{ $user1->id }}">{{ $user1->name }}</option>
                @endforeach
            </select>
        </div>
        {{--name of user--}}
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="number" class="form-control" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>

    </form>
</div>
@endsection