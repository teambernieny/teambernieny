@extends('layouts.app')


@section('contents')
<h1>Search Volunteers By Name</h1>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
    <form class="form" method='POST' action="/volSearchName">
      <h2>Search by Name</h2>
      <div class="form-group">
        First Name
        <input type="text" name="FirstName"> <br>
      </div>
      <div class = "form-group">
      Last Name
      <input type="text" name="LastName"> <br>
    </div>
    <div class = "form-group">
      <button class="btn btn-success" type="submit"  >Search</button>
      <input type='hidden' name='_token' value='{{ csrf_token() }}'>
      <input type='hidden' name='type' value='Name'>
    </div>
    </form>
    <form class="form" method='POST' action="/volSearchName">
        <h2>Search by Email</h2>
        <div class = "form-group">
          Email
          <input type="text" name="Email"> <br>
        </div>
        <div class="form-group">
          <button class="btn btn-success" type="submit"  >Search </button>
          <input type='hidden' name='_token' value='{{ csrf_token() }}'>
          <input type='hidden' name='type' value='Email'>
        </div>
      </form>
      <form class="form" method='POST' action="/volSearchName">
        <h2>Search by Phone</h2>
        <div class="form-group">
          Phone
          <input type="text" name="Phone"> <br>
        </div>
        <div>
          <button class="btn btn-success" type="submit"  >Search</button>
          <input type='hidden' name='_token' value='{{ csrf_token() }}'>
          <input type='hidden' name='type' value='Phone'>
        </div>
      </form>
  </div>
</div>
@stop
