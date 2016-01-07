@extends('layouts.app')


@section('contents')

<div class="row">
  <div class ="col-md-6">
    Event Attendees
    <table class="table table-bordered table-condensed">
    <tr class = 'header'>
      <td>Name</td><td>Email</td>
    </tr>
      @if($eventvolunteers != "")
      @foreach($eventvolunteers as $attendee)
      <tr>
        @if($attendee->volunteer != "")
          <td>{{$attendee->volunteer->FirstName}} {{$attendee->volunteer->LastName}} </td><td>{{$attendee->volunteer->Email}} </td>
          <td>
          <form method='GET' action='/editAttendance'>
            <button class="btn btn-link" id="editlink" type="submit">Edit</button>
            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
            <input type='hidden' name='attendance' value='{{$attendee->id}}'>
          </form>
          </td>
       @endif
      </tr>
      @endforeach
      @endif
    </table>
  </div>
  <div class="col-md-4 col-md-offset-1">
    <h2>Add Attendee</h2>
    <form method='POST' action="/addAttendee" id='form'>
      <div class = 'form-group'>
        <label for='FirstName'>FirstName:</label>
        <input type='text' class='form-control' id='FirstName' name='FirstName' > <br>
      </div>
      <div class = 'form-group'>
        <label for='LastName'>LastName:</label>
        <input type='text' class='form-control' id='LastName'name='LastName' > <br>
      </div>
      <div class = 'form-group'>
        <label for='Email'>Email:</label>
        <input type='text' class='form-control' id='Email' name='Email' value="{{$email}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Phone'>Phone (no dashes):</label>
        <input type='text' class='form-control' id='Phone' name='Phone'> <br>
      </div>
      <div class = 'form-group'>
        <label for='Neighborhood'>Neighborhood:</label>
        <input type='text' class='form-control' id='Neighborhood' name='Neighborhood' > <br>
      </div>
      <div class = 'form-group'>
        <label for='FirstName'>Street:</label>
        <input type='text' class='form-control' id='Street' name='Street' > <br>
      <div>
      <div class = 'form-group'>
        <label for='FirstName'>Zip:</label>
        <input type='text' class='form-control' id='Zip' name='Zip' > <br>
      </div>
      <div class = 'form-group'>
        <label for='FirstName'>Borough:</label>
        <input type='text' class='form-control' id='Borough' name='City' > <br>
      </div>
      <div class = 'form-group'>
        <label for='Commitments'>Event Commitments from {{$event->Name}}:</label>
      <input type='checkbox' class='form-control' id='Commitments' name='commitments[]' value='Host'> Host <br>
      <input type='checkbox' class='form-control' id='Commitments' name='commitments[]' value='Attend'> Attend<br>
    </div>
      <button class="btn btn-success" type="submit"  >Add Attendance</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name='event_id' value='{{$event->id}}'>
      <input type='hidden' name='user_id' value='{{Auth::user()->id}}'>
    </form>
  </div>
</div>


@stop
