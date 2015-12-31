@extends('layouts.app')


@section('contents')
<div class="row">
  <div id=dvData>
    <table class="table table-bordered table-condensed">
    <tr class = 'header'>
      <td>Name</td><td>Email</td><td>Commitments</td>
    </tr>
    @foreach($eventvolunteers as $attendee)
    <tr>
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
    </tr>
    @endforeach
    </table>
  </div>
    <div class="col-md-4 col-md-offset-4">
        @if($message != "")
          <h2>{{$message}}</h2>
        @endif
      <h2>Find Volunteer</h2>
    <form class="form" method='POST' action="/checkAttendee" id='form'>
      <label for='Email'>Email:</label>
      <input class='form-control' id='Email' type='text' name='Email'> <br>
      <button class="btn btn-success" type="submit"  >Find</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name='event_id' value='{{ $event_id }}'>
    </form>
  </div>
</div>
@stop
