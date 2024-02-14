@extends('layouts.master')

@section('content')

<div class="container">
    <div class="card col-8">
        <div class="card-header">
            <h1>Book Appointment</h1>
        </div>

        <div class="card-body">
            <form id="appointmentForm" method="post" action="{{ url('appointment-save') }}">
                @csrf

                @auth

                <div class="mb-3">
                    @hasanyrole('admin')
                    <label for="client_id" class="form-label">Select Client:</label>
                    <select class="form-select client" name="client_id" required>
                        <option>-----Please Select----</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    @endhasanyrole
                </div>

                <input type="hidden" name="client_id" value="{{ auth()->user()->client->id }}">

                @endauth

                <div class="mb-3">
                    <label for="counselor_id" class="form-label">Select Counselor:</label>
                    <select class="form-select counselor" name="counselor_id" required>
                        <option>-----Please Select----</option>
                        @foreach($counselors as $counselor)
                        <option value="{{ $counselor->id}}">{{ $counselor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="date"> Date</label>
                    <input type="date" class="form-control date" name="date">
                </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label">Select Start Time:</label>
                    <select class="form-select availableSlots" name="slot_id" required>
                    </select>


                </div>




                <button type="submit" class="btn btn-primary">Book Appointment</button>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $(document).ready(function () {
       $.ajaxSetup({//csrf token
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
        
      
        $(".date").on('blur', function () {
           
            var date = $('.date').val();
            var counselor = $('.counselor').val();

            
        // var data = new FormData(this);
       
          $.ajax({
            url:"{{url('availableSlots')}}/"+ date + '/'+ counselor,
            dataType:'json',
            beforeSend:function(){
                $('.availableSlots').html('<option>----Loading---</option>');

            },
            success: function (response) {
                console.log(response);
                var _html = '';
                $.each(response.availableSlots, function (index, availableSlot) { 
                    _html+='<option value="'+availableSlot.id+'" class=>' +availableSlot.start_time+'</option>'
                     
                });
                $('.availableSlots').html(_html);
                

            }
        });
    
    
    });      
        
        
        
    });
</script>
@endsection
</div>
@endsection