@extends('layouts.app')


@section('contents')
<h2>Add Attendence</h2>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <form method='POST' action="/addAttendance" id='form'>
      <div class = 'form-group'>
        <label for='FirstName'>FirstName:</label>
        <input type='text' class='form-control' id='FirstName' name='FirstName' value="{{$volunteer->FirstName}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='LastName'>LastName:</label>
        <input type='text' class='form-control' id='LastName'name='LastName' value="{{$volunteer->LastName}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Email'>Email:</label>
        <input type='text' class='form-control' id='Email' name='Email' value="{{$volunteer->Email}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Phone'>Phone:</label>
        <input type='text' class='form-control' id='Phone' name='Phone' value="{{$volunteer->Phone}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Neighborhood'>Neighborhood:</label>
        <input type='text' class='form-control' id='Neighborhood' name='Neighborhood' value="{{$volunteer->Neighborhood->Name}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='FirstName'>Street:</label>
        <input type='text' class='form-control' id='Street' name='Street' value="{{$volunteer->Street}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='FirstName'>Zip:</label>
        <input type='text' class='form-control' id='Zip' name='Zip' value="{{$volunteer->Zip}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='FirstName'>Borough:</label>
        <input type='text' class='form-control' id='Borough' name='City' value="{{$volunteer->City}}"> <br>
      </div>
      <div >
      <label for='Commitments'>Event Commitments from {{$event->Name}}:</label>
      <input type='checkbox' class='form-control' id='Commitments' name='commitments[]' value='Host'> Host <br>
      <input type='checkbox' class='form-control' id='Commitments' name='commitments[]' value='Attend'> Attend<br>
      </div>
      <button class="btn btn-success" type="submit"  >Add Attendance</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name = 'volunteer_id' value="{{$volunteer->id}}">
      <input type='hidden' name='event_id' value='{{$event->id}}'>
    </form>
  </div>
</div>
Past Attendances

<table class="table table-bordered table-condensed">
<tr class = 'header'>
  <td>Event</td><td>Date</td><td>Attendance Type</td><td>Commitment Type</td>
</tr>
@foreach($attendances as $attendance)
<tr>
  <td>{{$attendance->Name}}</td><td>{{$attendance->Date}} </td><td>{{$attendance->Relationship}}</td>
  <td>
  @foreach($eventcommitments[$attendance->id] as $commitment)
  {{$commitment->Type }}
  @endforeach
  </td>
  <td>
    <form method='GET' action='/editAttendance'>
      <button class="btn btn-link" id="editlink" type="submit">Edit</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name='attendance_id' value='{{$attendance->id}}'>
    </form>
  </td>
</tr>
@endforeach
</table>

@stop
