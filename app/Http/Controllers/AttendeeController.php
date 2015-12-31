<?php

namespace teambernieny\Http\Controllers;

use teambernieny\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AttendeeController extends Controller {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }




    public function getCheckAttendee(Request $request){
      $eventvolunteers = \teambernieny\EventsVolunteer::with('commitments','volunteer')->where('event_id', '=', $request->event_id)->get();

      return view('volunteer.attendee.check')->with([
        'message' => '',
        'event_id' => $request->event_id,
        'eventvolunteers' => $eventvolunteers
        ]);
    }

    public function postCheckAttendee(Request $request){
      $event = \teambernieny\Event::find($request->event_id);
      if ($request->Email != "") {
        $volunteers = \teambernieny\Volunteer::distinct('id')->where('Email','=',$request->Email)->get();

        if(sizeof($volunteers) > 0){
          $volunteer = \teambernieny\Volunteer::with('neighborhood','events','commitments')->find($volunteers[0]->id);
          $eventcommitments = array();
          foreach($volunteer->events as $event){
            $eventcommitments[$event->id] = \teambernieny\Commitment::where('event_id','=',$event->id)->where('volunteer_id','=',$volunteer->id)->get();
          }
          return view('volunteer.attendance.add')->with([
            'volunteer' => $volunteers[0],
            'event' => $event,
            'attendances' => $volunteers[0]->events,
            'eventcommitments' => $eventcommitments
          ]);
        }
      }
      if ($request->Email == ""){
        $request->Email = " ";
      }
      return view('volunteer.attendee.add')->with([
        'email' => $request->Email,
        'event'=> $event
      ]);
    }

    public function postAddAttendee(Request $request){
      $volunteer = new \teambernieny\Volunteer();

      $neighborhoods = \teambernieny\Neighborhood::select('id')->where('Name','=',$request->Neighborhood)->get();
      if (sizeof($neighborhoods) > 0){
        $neighborhood = $neighborhoods->first();
      } else {
        $neighborhood = new \teambernieny\Neighborhood();
        $neighborhood->Name = $request->Neighborhood;
        $neighborhood->Borough = $request->City;
        $neighborhood->save();

      }
      $neighborhood_id=$neighborhood->id;
      $volunteer->FirstName = $request->FirstName;
      $volunteer->LastName = $request->LastName;
      $volunteer->Email = $request->Email;
      $volunteer->Phone = $request->Phone;
      $volunteer->Zip = $request->Zip;
      $volunteer->neighborhood_id = $neighborhood_id;
      $volunteer->Street = $request->Street;
      $volunteer->City = $request->City;
      $volunteer->neighborhood->save();
      $volunteer->save();
      $volunteer->event = $event;

      $attendance = new \teambernieny\EventsVolunteer();
      $attendance->event_id = $request->event_id;
      $attendance->volunteer_id = $volunteer->id;
      $attendance->Relationship = "Attendee";
      $attendance->save();


      if (sizeof($request->commitments) > 0){
        foreach($request->commitments as $commitment){
          $newcommitment = new \teambernieny\Commitment();
          $newcommitment->event_id = $request->event_id;
          $newcommitment->volunteer_id = $volunteer->id;
          $newcommitment->Type = $commitment;
          $newcommitment->save();
        }

      }
      $message = 'Volunteer Attendance Added!';
      return view('volunteer.attendee.check')->with([
        'message'=> $message,
        'event_id'=>$request->event_id
      ]);
    }

    public function postAddAttendance(Request $request){
      $volunteercol = \teambernieny\Volunteer::with('neighborhood')->where('id','=',$request->volunteer_id)->get();
      $volunteer = $volunteercol->first();
      $volunteer->FirstName = $request->FirstName;
      $volunteer->LastName = $request->LastName;
      $volunteer->Email = $request->Email;
      $volunteer->Phone = $request->Phone;
      $volunteer->Zip = $request->Zip;
      $volunteer->neighborhood->Name = $request->Neighborhood;
      $volunteer->Street = $request->Street;
      $volunteer->neighborhood->Borough = $request->City;
      $volunteer->City = $request->City;
      $volunteer->neighborhood->save();
      $volunteer->save();

      $attendance = new \teambernieny\EventsVolunteer();
      $attendance->event_id = $request->event_id;
      $attendance->volunteer_id = $volunteer->id;
      $attendance->Relationship = "Attendee";
      $attendance->save();

      if (sizeof($request->commitments) > 0){
        foreach($request->commitments as $commitment){
          $newcommitment = new \teambernieny\Commitment();
          $newcommitment->event_id = $request->event_id;
          $newcommitment->volunteer_id = $request->volunteer_id;
          $newcommitment->Type = $commitment;
          $newcommitment->save();
        }

      }
      $message = 'Volunteer Attendance Added!';
      return view('volunteer.attendee.check')->with([
        'message'=> $message,
        'event_id'=>$request->event_id
      ]);
    }
    public function getEditAttendance(Request $request) {
      $attendance = \teambernieny\EventsVolunteer::with('volunteer')->with('event')->find($request->attendance_id);
      $commitments = \teambernieny\Commitment::where('volunteer_id',"=",$attendance->volunteer->id)->where('event_id','=',$attendance->event->id)->get();
      $host = "";
      $attend = "";
      if(sizeof($commitments) > 0){
        foreach($commitments as $commitment){
          if ($commitment->Type == 'Host'){
            $host = 'checked';
          } elseif ($commitment->Type == 'Attend'){
            $attend = 'checked';
          }
        }
      }
      return view('volunteer.attendance.edit')->with([
        'attendance' => $attendance,
        'host' => $host,
        'attend'=> $attend
      ]);
    }
    public function postEditAttendance(Request $request) {
      $attendance = \teambernieny\EventsVolunteer::with('volunteer')->with('event')->find($request->attendance_id);
      $commitments = \teambernieny\Commitment::where('volunteer_id',"=",$attendance->volunteer->id)->where('event_id','=',$attendance->event->id)->get();
      foreach ($commitments as $commitment){
        foreach($request->commitments as $newcommitment){
        }
      }
    }

}
