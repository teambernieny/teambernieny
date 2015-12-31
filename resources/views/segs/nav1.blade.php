@section('nav')
@if(Auth::check())
<nav>
  <ul>
      <li><a href='/logout'>Log out</a></li>
      <li><a href='/'>Home</a></li>
  </ul>
</nav>
<nav>
  @if($user->role == 'admin')
  <ul>
    <li><a href='/checkVolunteer'>Add Volunteer</a></li>
    <li><a href='/addVolunteer'>Add Volunteer Direct</a></li>
    <li><a href='/addEvent'>Add Event</a></li>
    <li><a href='/addFile'>Add File</a></li>
    <li><a href='/addUser'>Add User</a></li>
    <li><a href='/search'>Search</a></li>
    <l1><a href='/datahome'>Data Admin</a></l1>
  </ul>
  @endif
</nav>
@endif
@stop
