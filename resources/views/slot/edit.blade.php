@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Slot</h1>
    <form method="post" action="{{ url('slots.update', $slot->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time:</label>
            <input type="datetime-local" class="form-control" name="start_time" value="{{ $slot->start_time }}"
                required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time:</label>
            <input type="datetime-local" class="form-control" name="end_time" value="{{ $slot->end_time }}" required>
        </div>

        <div class="mb-3">
            <label for="counselor_id" class="form-label">Counselor:</label>
            <select class="form-select" name="counselor_id" required>
                @foreach($counselors as $counselor)
                <option value="{{ $counselor->id }}" {{ $counselor->id == $slot->counselor_id ? 'selected' : '' }}>{{
                    $counselor->full_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Slot</button>
    </form>
</div>
@endsection