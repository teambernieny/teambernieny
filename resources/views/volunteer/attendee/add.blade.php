@extends('layouts.app')


@section('contents')
<h2>Add Attendee</h2>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
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
        <label for='Phone'>Phone:</label>
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
    </form>
  </div>
</div>


@stop
