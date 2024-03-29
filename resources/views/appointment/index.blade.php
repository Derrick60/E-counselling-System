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
        <a type="button" class="btn btn-success" href="{{url('appointment-create')}}">Create</a>
    </div>

    <!-- Display a table of appointments for all users  -->
    @hasanyrole('admin')
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Counselor</th>
                <th>Start Time</th>
                <th>End Time</th>

                <th>Status</th>
                <th>Action</th>
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
                <td><a type="button" class="btn btn-success" href="{{$appt->link}}">JOIN</a></td>
                <td><button type="button" class="btn btn-warning cancel" value="{{$appt->id}}">CANCEL</button></td>

            </tr>

            @endforeach
            @else
            <table id="user">
                <thead>
                    <tr>
                        <th>Counselor</th>
                        <th>Start At</th>
                        <th>Ends At</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>zoomLink</th>

                    </tr>
                </thead>

                @foreach($userAppointments as $userApp)
                <tbody>
                    <tr>
                        <td>{{$userApp->counselor->name}}</td>
                        <td>{{$userApp->slot->start_time}}</td>
                        <td>{{$userApp->slot->end_time}}</td>
                        <td>{{$userApp->status}}</td>
                        <td>
                            <form action="/delete/{{$userApp->id}}" method="post">

                                {{ csrf_field() }}
                                {{method_field('DELETE')}}

                                <button type="submit" class="btn btn-danger btn-sm" title="Cancel Booking"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i>
                                    Cancel</button>
                            </form>
                        </td>


                        <td><a type="button" class="btn btn-success" href="{{$userApp->link}}">JOIN</a></td>



                    </tr>
                </tbody>
                @endforeach
            </table>
            @endhasanyrole
            @section('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
            <script>
                $(document).ready(function () {
            let table = new DataTable('#user,#myTable');
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            
            
            $('.cancel').click(function (e){
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
            type: 'DELETE',
            url: '/delete/'+ delete_id,
            success: function (response) {
            console.log(response.success);
            
            swal({
            title: response.success,
            icon: "success"
            })
            .then((willDelete) => {
            location.reload();
            });
            },
            
           
            
            });
           
            
            }
            });
            
            });
            });
            
            
            
            </script>

            </script>
            @endsection



        </tbody>
    </table>
</div>
@endsection