@section('nav')
@if(Auth::check())
<nav>
  <ul>
      <li><a href='/'>Home</a></li>
      <li><a href='/search'>Search</a></li>
      <li><a href='/logout'>Log out</a></li>
      <li><a href='/checkVolunteer'>Add Volunteer</a></li>
      <li><a href='/addEvent'>Add Event</a></li>
      <li><a href='/addFile'>Add File</a></li>
      <li><a href='/addUser'>Add User</a></li>
  </ul>
</nav>
<nav>
  <a class="btn btn-default" role="button"  href='/volSearchZip'>Volunteers By Zip or Neighborhood</a>
  <a class="btn btn-default" role="button" href='/volSearchName'>Volunteers By Name</a>
  <a class="btn btn-default"  role="button" href='/volSearchEvent'>Volunteers By Event</a>
  <a class="btn btn-default"  role="button" href='/volAll'>See All Volunteers</a>
  <a class="btn btn-default"  role="button" href='/eventSearchZip'>Events By Neighborhood</a>
  <a class="btn btn-default"  role="button" href='/eventSearchDate'>Events By Date</a>
  <a class="btn btn-default"  role="button" href='/eventAll'>See All Events</a>
</nav>
@endif
@stop
