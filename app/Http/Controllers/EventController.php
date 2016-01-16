<?php

namespace teambernieny\Http\Controllers;

use teambernieny\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EventController extends Controller {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

####################################------------------INTERACTING WITH THE DATA --------------------------#################################
    public function getAdd(Request $request){

      $event_types = ['Canvassing','Flyering','Petitioning','Meeting'];
      return view('event.add')->with('event_types',$event_types);
    }
    public function postAdd(Request $request){
      $neighborhoods = \teambernieny\Neighborhood::select('id')->where('Name','=',$request->Neighborhood)->get();
      if (sizeof($neighborhoods) > 0){
        $neighborhood = $neighborhoods->first();
        $neighborhood_id = $neighborhood->id;
      } else {
        $neighborhood = new \teambernieny\Neighborhood();
        $neighborhood->Name = $request->Neighborhood;
        $neighborhood->Borough = $request->City;
        $neighborhood->save();
        $neighborhood_id = $neighborhood->id;
      }
      $event = new \teambernieny\Event();
      $event->Name = $request->EventName;
      $event->Date = $request->EventDate;
      $event->neighborhood_id = $neighborhood_id;
      $event->Type = $request->EventType;
      $event->save();

      $events = \teambernieny\Event::with('neighborhood')->orderby('Date', 'DESC')->get();
      $eventrows = array();
      foreach($events as $event){
        $totalrows = 0;
        foreach($event->files as $file){
          $totalrows = $totalrows + $file->TotalRows;
          $filenew = \teambernieny\File::with('user')->find($file->id);
          $file = $filenew;
        }
        $eventrows[$event->id] = $totalrows;
      }
      return view('home')->with([
        'events' => $events,
        'eventrows' => $eventrows
      ]);
    }
    public function getEdit(Request $request){
      $event_types = ['Canvassing','Flyering','Petitioning'];
      $event = \teambernieny\Event::with('neighborhood')->find($request->event_id);

      return view('event.edit')->with([
        'event_types' => $event_types,
        'event'=> $event
      ]);

    }
    public function postEdit(Request $request){
      $eventcol = \teambernieny\Event::with('neighborhood')->where('id','=',$request->event_id)->get();
      $event = $eventcol->first();
      $event->Name = $request->EventName;
      $event->Date = $request->EventDate;
      $event->neighborhood->Name = $request->Neighborhood;
      $event->Type = $request->EventType;
      $event->neighborhood->save();
      $event->save();
      $events = \teambernieny\Event::with('neighborhood')->orderby('Date', 'DESC')->get();
      return view('adminhome')->with([
      'events'=> $events
      ]);
    }

####################################------------------VIEWING THE DATA --------------------------#################################

  public function getSearchNeighborhood(Request $request){
    $events = \teambernieny\Event::with('neighborhood')->get();
    $bronx = array();
    $brooklyn = array();
    $manhattan = array();
    $queens = array();
    $statenisland = array();
    $other = array();
    foreach ($events as $event) {
      if ($event->neighborhood->Borough == 'Bronx'){
        array_push($bronx, $event->neighborhood);
      } elseif ($event->neighborhood->Borough == 'Brooklyn'){
        array_push($brooklyn, $event->neighborhood);
      } elseif ($event->neighborhood->Borough == 'Manhattan'){
        array_push($manhattan, $event->neighborhood);
      } elseif ($event->neighborhood->Borough == 'Queens'){
          array_push($queens, $event->neighborhood);
      } elseif ($event->neighborhood->Borough == 'Staten Island'){
          array_push($statenisland, $event->neighborhood);
      } else {
        array_push($other, $event->neighborhood);
      }
    }
    return view('event.search.zip')->with([
      'bronx' => $bronx,
      'brooklyn' => $brooklyn,
      'manhattan' => $manhattan,
      'queens' => $queens,
      'statenisland' => $statenisland,
      'other' => $other
    ]);
  }
  public function postSearchNeighborhood(Request $request){
    $events = \teambernieny\Event::distinct('id')->with('neighborhood')->whereIn('neighborhood_id', $request->neighborhoods)->get();
    return view('event.search.searchresults')->with([
      'events' => $events
    ]);
  }
  public function getSearchDate(Request $request){

    return view('event.search.date');
  }
  public function postSearchDate(Request $request){
    $events = \teambernieny\Event::with('neighborhood')->where('Date', '>=', $request->FromDate)->where('Date','<=',$request->ToDate)->get();
    return view('event.search.searchresults')->with([
      'events' => $events
    ]);
  }
  public function getAll(Request $request){
    $events = \teambernieny\Event::with('neighborhood')->orderby('id', 'DESC')->get();
    return view('event.search.all')->with([
      'events' => $events
    ]);
  }


}
