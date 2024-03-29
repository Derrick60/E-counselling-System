@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Slot</h1>
</div>
<form method="post" id="editForm">
    {{ csrf_field() }}
    {{method_field('PUT')}}
    {{--name of user--}}
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" name="name" value="{{$clients->name}}" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone:</label>
        <input type="number" class="form-control" value="{{$clients->phone}}" name="phone" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="text" class="form-control" value="{{$clients->email}}" name="email" required>
    </div>
    <button type="submit" id="update" class="btn btn-primary">Update</button>

</form>
</div>

@section('scripts')
<script>
    $.ajaxSetup({//csrf token
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    
    });
    $("#update").click(function (e) {
    e.preventDefault();
     var formData = $("#editForm").serialize();
    var id  = $('#user_id').val();
            $.ajax({
                type: "PUT",
                url: "/client-update/" + id,
                data: formData,
                dataType: "JSON",
                success: function (response) {
                   swal({
                    title: response.status,
                    icon: response.statusCode
                    }) 
                   window.location.href = '/client';
                    
                   
                }
          
        });
        
    });
</script>
@endsection
@endsection