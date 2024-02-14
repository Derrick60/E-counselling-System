@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Appointments</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div>
        <a href="{{url('appointment-create')}}">Create</a>
    </div>
    <!-- Display a table of appointments -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Counselor</th>
                <th>Start Time</th>
                <th>End Time</th>

                <th>Status</th>
                <th>zoomLink</th>

            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appt)
            <tr>
                <td>{{$appt->id}}</td>
                <td>{{$appt->client->name}}</td>
                <td>{{$appt->counselor->name}}</td>
                <td>{{$appt->slot->start_time}}</td>
                <td>{{$appt->slot->end_time}}</td>
                <td>{{$appt->status}}</td>
                <td></td>

            </tr>

            @endforeach

        </tbody>
    </table>
</div>
@endsection