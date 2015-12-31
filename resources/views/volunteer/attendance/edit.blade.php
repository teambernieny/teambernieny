@extends('layouts.app')


@section('contents')
<h2>Edit Attendance</h2>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <form method='POST' action="/editAttendance" id='form'>
      <div class = 'form-group'>
        <label for='FirstName'>FirstName:</label>
        <input type='text' class='form-control' id='FirstName' name='FirstName' value="{{$attendance->volunteer->FirstName}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='LastName'>LastName:</label>
        <input type='text' class='form-control' id='LastName'name='LastName' value="{{$attendance->volunteer->LastName}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Email'>Email:</label>
        <input type='text' class='form-control' id='Email' name='Email' value="{{$attendance->volunteer->Email}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Phone'>Phone:</label>
        <input type='text' class='form-control' id='Phone' name='Phone' value="{{$attendance->volunteer->Phone}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Neighborhood'>Neighborhood:</label>
        <input type='text' class='form-control' id='Neighborhood' name='Neighborhood' value="{{$attendance->volunteer->Neighborhood->Name}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='FirstName'>Street:</label>
        <input type='text' class='form-control' id='Street' name='Street' value="{{$attendance->volunteer->Street}}"> <br>
      <div>
      <div class = 'form-group'>
        <label for='FirstName'>Zip:</label>
        <input type='text' class='form-control' id='Zip' name='Zip' value="{{$attendance->volunteer->Zip}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='FirstName'>Borough:</label>
        <input type='text' class='form-control' id='Borough' name='City' value="{{$attendance->volunteer->City}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Commitments'>Event Commitments from {{$attendance->event->Name}}:</label>

      <input {{ $host }} type='checkbox' class='form-control' id='Commitments' name='commitments[]' value='Host'> Host <br>
      <input {{ $attend }} type='checkbox' class='form-control' id='Commitments' name='commitments[]' value='Attend'> Attend<br>
    </div>
      <button class="btn btn-success" type="submit"  >Edit Attendance</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name = 'attendace_id' value="{{$attendance->id}}">

    </form>
  </div>
</div>

@stop
