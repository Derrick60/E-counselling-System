<!-- resources/views/slots/create.blade.php -->
@extends('layouts.master')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Create Slot</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form method="post" action="{{ url('slot-save') }}">
                @csrf

                <div class="mb-3">
                    <label for="counselor_id" class="form-label">Counselor:</label>
                    <select class="form-select" name="counselor_id" required>
                        @foreach($counselors as $counselor)
                        <option value="{{ $counselor->id }}">{{ $counselor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="day" class="form-label">Day:</label>
                    <input type="text" class="form-control" name="day" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Slot</button>
            </form>
        </div>
    </div>
</div>
@endsection