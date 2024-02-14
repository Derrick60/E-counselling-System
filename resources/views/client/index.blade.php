@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Client </h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <a href="/create-client">CREATE</a>
    <!-- Display a table of appointments -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>phone</th>
                <th>regNo</th>
                <th>Email</th>


            </tr>
        </thead>
        <tbody>
            @foreach($client as $client)
            <tr>
                <td>{{$client->id}}</td>
                <td>{{$client->name }}</td>
                <td>{{$client->phone}}</td>
                <td>{{$client->regNo}}</td>
                <td>{{$client->email}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
@endsection