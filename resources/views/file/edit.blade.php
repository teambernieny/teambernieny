@extends('layouts.app')


@section('contents')


<div class="row">
  <div class ="col-md-6">
    Files for {{$event->Name}}
    <table class="table table-bordered table-condensed">
    <tr class = 'header'>
      <td>Name</td><td>Total Rows</td><td>Rows Completed</td>
    </tr>
      @foreach($event->files as $file)
      <tr>
          <td>{{$file->Name}}</td><td>{{$file->TotalRows}} </td><td>{{$file->CompletedRows}}</td>
          <td>
          @if($file->Completed != "1")
          <form method='POST' action='/completeFile'>
            <button class="btn btn-link" id="completelink" type="submit">Completed</button>
            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
            <input type='hidden' name='event_id' value='{{$event->id}}'>
            <input type='hidden' name='file_id' value='{{$file->id}}'>
          </form>
          @endif
          </td>
          <td>
          <form method='GET' action='/editFile'>
            <button class="btn btn-link" id="editlink" type="submit">Edit</button>
            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
            <input type='hidden' name='event_id' value='{{$event->id}}'>
            <input type='hidden' name='file_id' value='{{$file->id}}'>
          </form>
          </td>
      </tr>
      @endforeach
    </table>
  </div>
  <h4>Edit File for {{$event->Name}}</h4>
  <div class="col-md-4 col-md-offset-1">
    <form method='POST' action="/editFile" id='form'>
      <div class = 'form-group'>
        <label for='FileName'>File Name:</label>
        <input type='text' class='form-control' id='FileName' name='FileName' value='{{$file->Name}}'> <br>
      </div>
      <div class = 'form-group'>
        <label for='TotalRows'>Total Number of Rows</label>
        <input type='text' class='form-control' id='TotalRows' name='TotalRows' value='{{$file->TotalRows}}'> <br>
      </div>
      <div class = 'form-group'>
        <label for='CompletedRows'>Number of Rows Completed (defaults to zero)</label>
        <input type='text' class='form-control' id='CompletedRows' name='CompletedRows' value='{{$file->CompletedRows}}'> <br>
      </div>
      <div class='form-group'>
          <?php if($file->Completed == "1"){
            $checked = 'checked';
          } else {
            $checked = '';
          } ?>
          <input type='checkbox' name='Completed' {{$checked}}>   Completed<br>
      </div>
      <button class="btn btn-success" type="submit"  >Edit</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name='event_id' value='{{$event->id}}'>
      <input type='hidden' name='file_id' value='{{$file->id}}'>
    </form>
  </div>
</div>

@stop
