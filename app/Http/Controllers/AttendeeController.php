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
      $eventvolunteers = "" ;
      $eventvolunteers = \teambernieny\EventVolunteers::with('commitments','volunteer')->where('event_id', '=', $request->event_id)->get();

      return view('volunteer.attendee.check')->with([
        'message' => '',
        'event_id' => $request->event_id,
        'eventvolunteers' => $eventvolunteers
        ]);
    }

    public function postCheckAttendee(Request $request){
      $eventvolunteers = "" ;
      $eventvolunteers = \teambernieny\EventVolunteers::with('commitments','volunteer')->where('event_id', '=', $request->event_id)->get();

      $event = \teambernieny\Event::find($request->event_id);
      if ($request->Email != "") {
        $volunteers = \teambernieny\Volunteer::distinct('id')->where('Email','=',$request->Email)->get();
      }
      if(sizeof($volunteers) > 0){
          $volunteer = \teambernieny\Volunteer::with('neighborhood','events','commitments')->find($volunteers[0]->id);
          $eventcommitments = $volunteer->commitments;
        /*  foreach($volunteer->events as $event){
            $eventcommitments[$event->id] = \teambernieny\Commitment::where('event_id','=',$event->id)->where('volunteer_id','=',$volunteer->id)->get();
          }*/
          return view('volunteer.attendance.add')->with([
            'volunteer' => $volunteers[0],
            'event' => $event,
            'eventvolunteers' => $eventvolunteers
          ]);
        } else {
        if ($request->Email == ""){
          $request->Email = " ";
        }
        return view('volunteer.attendee.add')->with([
          'email' => $request->Email,
          'event'=> $event,
          'eventvolunteers' => $eventvolunteers
        ]);
      }
    }
    ///If volunteer does not exist
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
      $volunteer->user_id = $request->user_id;
      $volunteer->save();


      $attendance = new \teambernieny\EventVolunteers();
      $attendance->event_id = $request->event_id;
      $attendance->volunteer_id = $volunteer->id;
      $attendance->Relationship = "Attendee";
      $attendance->save();


      if (sizeof($request->commitments) > 0){
        foreach($request->commitments as $commitment){
          $newcommitment = new \teambernieny\Commitment();
          $newcommitment->event_volunteers_id=$attendance->id;
          $newcommitment->Type = $commitment;
          $newcommitment->save();
        }

      }
      $eventvolunteers = "" ;
      $eventvolunteers = \teambernieny\EventVolunteers::with('commitments','volunteer')->where('event_id', '=', $request->event_id)->get();
      $message = 'Volunteer Attendance Added!';
      return view('volunteer.attendee.check')->with([
        'message'=> $message,
        'event_id'=>$request->event_id,
        'eventvolunteers' => $eventvolunteers
      ]);
    }
/// If volunteer exists
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

      $attendances = \teambernieny\EventVolunteers::where('event_id','=',$request->event_id)->where('volunteer_id','=',$request->volunteer_id)->get();
      if(sizeof($attendances) == 0){
        $attendance = new \teambernieny\EventVolunteers();
        $attendance->event_id = $request->event_id;
        $attendance->volunteer_id = $volunteer->id;
        $attendance->Relationship = "Attendee";
        $attendance->save();

        if (sizeof($request->commitments) > 0){
          foreach($request->commitments as $commitment){
            $newcommitment = new \teambernieny\Commitment();
            $newcommitment->event_volunteers_id = $attendance->id;
            $newcommitment->Type = $commitment;
            $newcommitment->save();
          }

        }
        $message = 'Volunteer Attendance Added!';
      } else {
        $message = 'Whoops! Volunteer Attendance already added... try further down in the file';
      }
      $eventvolunteers = "" ;
      $eventvolunteers = \teambernieny\EventVolunteers::with('commitments','volunteer')->where('event_id', '=', $request->event_id)->get();
      return view('volunteer.attendee.check')->with([
        'message'=> $message,
        'event_id'=>$request->event_id,
        'eventvolunteers' => $eventvolunteers
      ]);
    }

    public function getEditAttendance(Request $request) {
      //$volunteers = \teambernieny\Volunteer::with('commitments')->with('events')->where->get();
      $attendance = \teambernieny\EventVolunteers::with('volunteer')->with('event')->with('commitments')->find($request->attendance);
      //$commitments = \teambernieny\Commitment::where('volunteer_id',"=",$attendance->volunteer->id)->where('event_id','=',$attendance->event->id)->get();

      $host = "";
      $attend = "";
      if(sizeof($attendance->commitments) > 0){
        foreach($attendance->commitments as $commitment){
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
      $attendance = \teambernieny\EventVolunteers::with('volunteer')->with('event')->with('commitments')->find($request->attendance);
      //$commitments = \teambernieny\Commitment::where('volunteer_id',"=",$attendance->volunteer->id)->where('event_id','=',$attendance->event->id)->get();
        // find new commitments
        if ($request->commitments == ""){
          foreach($attendance->commitments as $commitment){
            $commitment->delete();
          }
        } else {
          foreach($attendance->commitments as $commitment){
            $exists1 = array_search($commitment->Type, $request->commitments);
              if($exists1 == false){
                $commitment->delete();
              }
            }

          foreach($request->commitments as $newcommitment){
              $exists = 0;
              foreach($attendance->commitments as $oldcommitment){
                if($newcommitment == $oldcommitment->Type){
                  $exists =1;
                }
              }
              if($exists == 0){
                $addcommitment = new \teambernieny\Commitment();
                $addcommitment->Type = $newcommitment;
                $addcommitment->event_volunteers_id = $attendance->id;
                $addcommitment->save();
              }


            }
        }

      $eventvolunteers = "" ;
      $eventvolunteers = \teambernieny\EventVolunteers::with('commitments','volunteer')->where('event_id', '=', $attendance->event_id)->get();

      return view('volunteer.attendee.check')->with([
        'message' => '',
        'event_id' => $attendance->event->id,
        'eventvolunteers' => $eventvolunteers
        ]);

    }

}
