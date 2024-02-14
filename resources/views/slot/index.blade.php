@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Appointment Slots</h1>
    <a href="{{ url('slot-create') }}" class="btn btn-primary mb-3">Create Slot</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Counselor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($slots as $slot)
            <tr>
                <td>{{ $slot->id }}</td>
                <td>{{$slot->day}}</td>
                <td>{{ $slot->start_time }}</td>
                <td>{{ $slot->end_time }}</td>
                <td>{{ $slot->counselor->name }}</td>
                <td>
                    {{-- <a href="{{ route('slots.edit', $slot->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No slots found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection