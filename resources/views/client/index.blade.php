@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Client </h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div align="right">
        <a type="button" class="btn btn-success" href="/create-client">CREATE</a>
    </div>



    @hasanyrole('admin')
    <table id="myTable" class="table table-responsive table-bordered" cellspacing="0" Width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>phone</th>
                <th>regNo</th>
                <th>Email</th>
                <th>Action</th>


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
                <td>
                    <a type="button" class="btn btn-success" href="{{ url('/client-edit/' . $client->id) }}"><i
                            class="bi-pencil-square h8"></i></a></a>

                    <button type="button" class="btn btn-danger delete" value="{{$client->id}}"><i
                            class="bi-trash h8"></i></button>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    @else
    {{-- User details belonging to loged in only --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">regNo</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientLoged as $cli)
            <tr>
                <th>{{$cli->id}}</th>
                <th>{{$cli->name}}</th>
                <th>{{$cli->phone}}</th>
                <th>{{$cli->phone}}</th>
                <th>{{$cli->email}}</th>
                <td>
                    <a type="button" class="btn btn-success" href="{{ url('/client-edit/' . $cli->id) }}"><i
                            class="bi-pencil-square h8"></i></a></a>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @endhasanyrole

    @section('scripts')
    <script>
        $.ajaxSetup({//csrf token
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                
                });
                $('.delete').click(function (e){
                e.preventDefault();
                
                var delete_id = $(this).val();
                swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                
                .then((willDelete) => {
                if (willDelete) {
                var data ={
                "id": delete_id,
                };
               
                $.ajax({
                    type: "DELETE",
                    url: '/client-delete/' + delete_id,
                    dataType: "JSON",
                    success: function (response) {
                        swal({
                        title: response.status,
                        icon: response.statusCode
                        })
                        .then((willDelete) => {
                        location.reload();
                        });
                        
                    }
                });
            }
            });
                });

    </script>
    @endsection

    </tbody>
    </table>
</div>
@endsection