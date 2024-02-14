@extends('layouts.master')

@section('content')
<div class="container">
    <h1>counselor </h1>

    @if(session('error'))

    <div class="alert alert-warning">
        <ul>
            @foreach(session('error')->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <a href="/counselor-create">CREATE</a>
    <!-- Display a table of appointments -->
    <table class="table">
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
            @foreach($counselor as $counselor)
            <tr>
                <td>{{$counselor->id}}</td>
                <td>{{$counselor->name }}</td>
                <td>{{$counselor->phone}}</td>
                <td>{{$counselor->regNo}}</td>
                <td>{{$counselor->email}}</td>
                <td>
                    <a href="counselor-edit/{{$counselor->id}}" type="button" class="btn btn-success">Edit</a>
                    <button type="button" class="btn btn-warning delete" value="{{$counselor->id}}">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js">
</script>
<script>
    $(document).ready(function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
});
    $(document).on('click','.delete',function (e){
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
    type: '',
    url: "{{url('counselor-delete')}}/"+ delete_id,
    data: data,
    success: function (response) {
        console.log(response);
    
    swal({
    title: response.success,
    icon: response.success
    })
    .then((willDelete) => {
    location.reload();
    });
    },
    error: function(xhr, status, error) {
    alert(xhr),
    console.log(xhr.responseText);
    console.log("AJAX Error:", xhr, status, error);
    swal({
    title: "Error",
    text: "An error occurred while processing the request.",
    icon:"error"
    });
    },
    
    });
    
    }
    });
    
    });

</script>

@endsection
@endsection