@extends('layouts.app')


@section('contents')
<h1>Search Volunteers By Event</h1>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
    <form class="form" method='POST' action="/volSearchEvent">
      <h2>Search by Name</h2>
      Event Name
      <input type="text" name="EventName"> <br>
      <button class="btn btn-success" type="submit"  >Search</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name='type' value='Name'>
    </form>
  </div>
  <div class="col-md-6 col-md-offset-3">
  <form class="form" method='POST' action="/volSearchEvent">
    <h2>Search by Date</h2>
    Event Date
    <input type="text" name="EventDate"> <br>
    <button class="btn btn-success" type="submit"  >Search</button>
    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
    <input type='hidden' name='type' value='Date'>
  </form>
</div>
</div>
@stop
