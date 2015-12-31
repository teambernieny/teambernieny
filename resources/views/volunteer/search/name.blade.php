@extends('layouts.search')


@section('contents')
<h1>Search Volunteers By Name</h1>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
    <form class="form" method='POST' action="/volSearchName">
      <h2>Search by Name</h2>
      First Name
      <input type="text" name="FirstName"> <br>
      Last Name
      <input type="text" name="LastName"> <br>
      <button class="btn btn-success" type="submit"  >Search</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name='type' value='Name'>
    </form>
    <form class="form" method='POST' action="/volSearchName">
        <h2>Search by Email</h2>
        Email
        <input type="text" name="Email"> <br>
        <button class="btn btn-success" type="submit"  >Search </button>
        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
        <input type='hidden' name='type' value='Email'>
      </form>
      <form class="form" method='POST' action="/volSearchName">
        <h2>Search by Phone</h2>
        Phone
        <input type="text" name="Phone"> <br>
        <button class="btn btn-success" type="submit"  >Search</button>
        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
        <input type='hidden' name='type' value='Phone'>
      </form>
  </div>
</div>
@stop
