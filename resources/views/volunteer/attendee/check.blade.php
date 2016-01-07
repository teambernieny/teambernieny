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
