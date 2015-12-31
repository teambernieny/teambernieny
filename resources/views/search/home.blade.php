@extends('layouts.app')


@section('contents')
<h1>Search Options</h1>
<div>
  <h2>Volunteer Searches:</h2>
    <a class="btn btn-primary" role="button"  href='/volSearchZip'>By Zip or Neighborhood</a>
    <a class="btn btn-primary" role="button" href='/volSearchName'>By Name</a>
    <a class="btn btn-primary"  role="button" href='/volSearchEvent'>By Event</a>
    <a class="btn btn-primary"  role="button" href='/volAll'>See All</a>
  </div>
<div>
  <h2>Event Searches:</h2>
  <a class="btn btn-primary"  role="button" href='/eventSearchNeighborhood'>By Neighborhood</a>
  <a class="btn btn-primary"  role="button" href='/eventSearchDate'>By Date</a>
  <a class="btn btn-primary"  role="button" href='/eventAll'>See All</a>
</div>
@stop
