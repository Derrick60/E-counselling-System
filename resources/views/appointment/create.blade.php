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





                @hasanyrole('admin')
                <div class="mb-3">

                    <label for="client_id" class="form-label">Select Client:</label>
                    <select class="form-select client" name="client_id" required>
                        <option>-----Please Select----</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>

                </div>
                @endhasanyrole


                <input type="hidden" name="client_id" value="{{ auth()->user()->client->id }}">











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
                <input type="text" id="slot_id" name="slot_id" hidden>

                <div class="availableSlots">
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

    $(".date").on('change', function () {
        var date = $('.date').val();
        var counselor = $('.counselor').val();

        $.ajax({
            url: "{{url('availableSlots')}}/"+ date + '/'+ counselor,
            dataType: 'json',
            beforeSend: function(){
                $('.availableSlots').html('<option>----Loading---</option>');
            },
            success: function (response) {
                console.log(response);
                var _html = '';
                $.each(response.availableSlots, function (index, availableSlot) { 
                    _html += '<button type="button"  class="btn btn-success time-slot-btn m-2" data-start-time="' + availableSlot.id + '">' + availableSlot.start_time + '</button>';
                });
                $('.availableSlots').html(_html);
            }
        });
        
    });
    // Event delegation for dynamically added buttons
    $('.availableSlots').on('click', '.time-slot-btn', function() {
    var startTime = $(this).data('start-time');
   
     $('#slot_id').val(startTime);
    });
   
    
});


</script>
@endsection

@endsection