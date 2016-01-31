@extends('layouts.master')


@section('contents')
<h2>Edit Volunteer</h2>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <form method='POST' action="/editVolunteer" id='form'>
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
        <label for='Street'>Street:</label>
        <input type='text' class='form-control' id='Street' name='Street' value="{{$volunteer->Street}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Zip'>Zip:</label>
        <input type='text' class='form-control' id='Zip' name='Zip' value="{{$volunteer->Zip}}"> <br>
      </div>
      <div class = 'form-group'>
        <label for='Borough'>Borough:</label>
        <input type='text' class='form-control' id='Borough' name='City' value="{{$volunteer->City}}"> <br>
      </div>

      <div class = "col-md-4">

        <?php $checked = ($volunteer->BadEmail == "1") ? 'checked' : ''?>
        Bad Email
        <input type='checkbox' class='form-control' id='BadEmail' name='BadEmail' value="true" {{$checked}}> <br>
      </div>
      <div class = "col-md-4">
        <?php $checked = ($volunteer->BadPhone == "1") ? 'checked' : '' ?>
        Bad Phone
        <input type='checkbox' class='form-control' id='BadPhone' name='BadPhone' value="true" {{$checked}}> <br>
      </div>
      <div class = "col-md-5">
        Do Not Contact
        <?php $checked = ($volunteer->DoNotContact == "1") ? 'checked' : '' ?>
        <input type='checkbox' class='form-control' id='DoNotContact' name='DoNotContact' value="true" {{$checked}}> <br>
      </div>
      <div class="row">
        <div class="col-md-8">
          <button class="btn btn-success btn-block" type="submit"  >Edit</button>
          <input type='hidden' name='_token' value='{{ csrf_token() }}'>
          <input type='hidden' name = 'volunteer_id' value="{{$volunteer->id}}">
        </div>
      </div>

    </form>
  </div>
</div>
@stop
