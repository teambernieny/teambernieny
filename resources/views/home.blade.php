@extends('layouts.app')

@section('contents')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <h2>Recent/Upcoming Events</h2>
                  <div>
                  <table class="table">

                  <tr>
                    <th>Event Name</th><th>Date</th><th>Neighborhood</th><th>Type</th>
                  </tr>
                  @foreach($events as $event)
                  <tr class = 'info'>
                    <th>{{$event->Name}} </th><th>{{$event->Date}}</th><th>{{$event->neighborhood->Name}}</th><th>{{$event->Type}}</th>
                    <td>
                      <form method='GET' action='/checkAttendee'>
                        <button class="btn btn-link" id="editlink" type="submit">Add Attendees</button>
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                        <input type='hidden' name='event_id' value='{{$event->id}}'>
                      </form>
                    </td>
                  </tr>
                  @if(sizeof($event->files)>0)
                  <tr>
                    <td rowspan={{sizeof($event->files)+1}}>Event Files</td><td>File Name</td><td>Completed Rows</td><td>Mark Completed</td><td>User Completed</td>
                  </tr>
                    @foreach($event->files as $file)
                    <tr>
                      <td>{{$file->Name}}</td><td>{{$file->CompletedRows}}/{{$file->TotalRows}}</td>
                      <td>
                        @if($file->Completed == '0')
                        <form method='POST' action='/completeFileReg'>
                          <button class="btn btn-link" id="completelink" type="submit">Completed</button>
                          <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                          <input type='hidden' name='event_id' value='{{$event->id}}'>
                          <input type='hidden' name='file_id' value='{{$file->id}}'>
                        </form>
                        @endif
                      </td><td></td>
                    </tr>
                    @endforeach
                    @endif
                  @endforeach
                  </table>

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
