@extends('layouts.master')


@section('contents')

<h1>Enter a file of Contact Events to process</h1>
File format (with header row) should be: <br>
FirstName,LastName,Zip,Phone,County,Email,Caller,Called,PickedUp, Texted,VM,
RSVP,Event,Date,DoNotContact,BadPhone,Comments
<div class="row">
    <div class="col-md-4 col-md-offset-4">
      {{ $message }}
      <form class="form" method='POST' action="/processContactEvents">
        <div class="form-group">
          <label for="FileName">File Name</label>
          <input type="text" class="form-control" id="FileName" name="FileName"> <br>
        </div>
        <div class="form-group">
          <label for="CDistrict">Congressional District (if any)</label>
          <input type="integer" class="form-control" id="CDistrict" name="CDistrict"> <br>
        </div>
        <div>
          <button class="btn btn-success" type="submit"  >Process</button>
          <input type='hidden' name='_token' value='{{ csrf_token() }}'>
        </div>
      </form>
  </div>
</div>
@stop
