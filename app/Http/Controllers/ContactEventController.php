<?php

namespace teambernieny\Http\Controllers;

use teambernieny\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Config;

class ContactEventController extends Controller {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }


    public function getProcess(Request $request){
      return view('contactevent.process')->with([
        'message' => ""
      ]);
    }

    public function postProcess(Request $request){

      ini_set('auto_detect_line_endings',TRUE);
      $file = fopen(Config::get('app.filepath').$request->FileName,"r");

      ## Get the header line = FirstName(0),LastName(1),Zip(2),Phone(3),County(4),Email(5),Caller(6),Called(7),PickedUP(8)
      ## Texted(9),VM(10),RSVP(11),Event(12),Date(13),DoNotContact(14),BadPhone(15),Comments(16)
      $x = 0;
      while (($data = fgetcsv($file)) !== FALSE){
        if ($x == 0){
          $x = $x+1;
          continue;
        }

        #; Find Volunteer or add if does not exist
        if($data[3] != ""){ // check first by phone number
          $volunteers = \teambernieny\Volunteer::where('Phone','=',$data[3])->get();
        }

        if(sizeof($volunteers) == 0){

          $volunteer = new \teambernieny\Volunteer();
          $volunteer->FirstName = $data[0];
          $volunteer->LastName = $data[1];
          $volunteer->Phone = $data[3];
          $volunteer->Zip = $data[2];
          $volunteer->Email = $data[5];
          $volunteer->County = $data[4];
          $volunteer->neighborhood_id = "1";
          if($request->CDistrict != ""){
            $volunteer->CDistrict = $request->CDistrict;
          }
          $volunteer->user_id = "1";
          $volunteer->save();
          $volunteer_id = $volunteer->id;
        } else {
          $volunteer_id = $volunteers[0]->id;
          $volunteer = $volunteers[0];
        }
        if($data[14] == "1"){
          $volunteer->DoNotContact = true;
        }
        if($data[15] == "1"){
          $volunteer->BadPhone = true;
        }
        #; Check to see if volunteer was Called or texted -- add contact event if so

        if(($data[7] == "Y")||($data[9] == "Y")||($data[7] == "Yes")||($data[9] == "Yes")){

          if($data[12] != ""){ //get event info if there is a name in the event column
            $events = \teambernieny\Event::where('Name','=',$data[12])->get();
            if(sizeof($events) > 0){
              $event_id = $events[0]->id;
            } else { //add if event doesn't exist
             $event = new \teambernieny\Event();
             $event->Name = $data[12];
             $event->neighborhood_id = "1";
             $event->Date = date('Y/m/d');
             $event->save();
             $event_id = $event->id;
           }
         } else {
           $event_id = null; //no event indicated
         }

         #; create contact event
        $contactevent = new \teambernieny\Contactevent();
        $contactevent->volunteer_id = $volunteer_id;
        $contactevent->event_id = $event_id;
        $contactevent->Purpose = "Invitation";
        // if RSVPed
        if(($data[11] == "Y") || ($data[11] == "SENT") || ($data[11] == "Yes")){
          $contactevent->RSVP = true;
        } else {
          $contactevent->RSVP = false;
        }
        // if Called
        if(($data[7]=="Y") || ($data[7]=="Yes")){
          $contactevent->Call = true;
        } else {
          $contactevent->Call = false;
        }
        // if PickedUp
        if(($data[8]=="Y")||(($data[8]=="Yes"))){
          $contactevent->PickedUp = true;
        }else{
          $contactevent->PickedUp = false;
        }
        // if Texted
        if(($data[9]=="Y")||($data[9]=="Yes")){
          $contactevent->Text = true;
        }else{
          $contactevent->Text = false;
        }
        //if left a voicemail
        if(($data[10]=="Y")||($data[10]=="Yes")){
          $contactevent->VoiceMail = true;
        }else{
          $contactevent->VoiceMail = false;
        }

        $contactevent->Date = date('Y-m-d',strtotime($data[13]));
        $contactevent->Comment = $data[16];
        $contactevent->Caller = $data[6];
        $contactevent->Completed = true;
        $contactevent->user_id = null;
        $contactevent->save();

      }



    }

    fclose($file);


      return view('contactevent.process')->with([
        'message' => "File Processed"
      ]);;
    }
}
