@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Slot</h1>
    <form method="post" action="{{ url('counselor-update/' . $counselors->id) }}">
        @csrf
        @method('PUT')

</div>

<input type="text" class="form-control" name="user_id" value="{{$counselors->id}}" hidden>
{{--name of user--}}
<div class="mb-3">
    <label for="name" class="form-label">Name:</label>
    <input type="text" class="form-control" name="name" value="{{$counselors->name}}" required>
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone:</label>
    <input type="number" class="form-control" value="{{$counselors->phone}}" name="phone" required>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="text" class="form-control" value="{{$counselors->email}}" name="email" required>
</div>
<button type="submit" class="btn btn-primary">Update</button>

</form>
</div>
@endsection