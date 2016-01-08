@extends('layouts.app')


@section('contents')

<div class="row">
  <div class ="col-md-6">
    Event Attendees
    <table class="table table-bordered table-condensed">
    <tr class = 'header'>
      <td>Name</td><td>Email</td><td>Commitments</td>
    </tr>
      @if($eventvolunteers != "")
      @foreach($eventvolunteers as $attendee)
      <tr>
        @if($attendee->volunteer != "")
          <td>{{$attendee->volunteer->FirstName}} {{$attendee->volunteer->LastName}} </td><td>{{$attendee->volunteer->Email}} </td>
          <td>
          @foreach($attendee->commitments as $commitment)
            {{$commitment->Type }}
          @endforeach
          </td>
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
    <h2>Add Attendence</h2>
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
      <h3>Event Commitments from {{$event->Name}}:</h3>
      <label for='Host'>Host</label>
      <input type='checkbox'  id='Host' name='commitments[]' value='Host'> <br>
      <label for='Attend'>Attend</label>
      <input type='checkbox'  id='Attend' name='commitments[]' value='Attend'> <br>
      </div>
      <button class="btn btn-success" type="submit"  >Add Attendance</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name = 'volunteer_id' value="{{$volunteer->id}}">
      <input type='hidden' name='event_id' value='{{$event->id}}'>
    </form>
  </div>
</div>

</table>

@stop
