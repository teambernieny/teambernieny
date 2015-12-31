@extends('layouts.app')


@section('contents')
<h1>Search Events By Date</h1>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
    <form class="form" method='POST' action="/searchEventDate">
      FromDate (MM/DD/YYYY):

      <input type="text" name="FromDate"> <br>
      ToDate (MM/DD/YYY):
      <input type="text" name="ToDate"> <br>
      <button class="btn btn-success" type="submit"  >Search</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
    </form>
  </div>
</div>
@stop
