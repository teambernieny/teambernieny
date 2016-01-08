<?php

namespace teambernieny\Http\Controllers;

use teambernieny\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class VolunteerController extends Controller {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }
###################### --------------- INTERACTING WITH THE DATA -------------- #######################################
    public function getCheck(Request $request){

      return view('volunteer.check')->with('message','');
    }
    public function postCheck(Request $request){
      if ($request->Email != "") {
        $volunteers = \teambernieny\Volunteer::distinct('id')->with('neighborhood')->where('Email','=',$request->Email)->get();
        if(sizeof($volunteers) > 0){
          return view('volunteer.edit')->with([
            'volunteer' => $volunteers[0]
          ]);
        }
      }
      if ($request->Email == ""){
        $request->Email = " ";
      }
      return view('volunteer.add')->with('email', $request->Email );
    }
    public function getAdd(Request $request){
      return view('volunteer.add')->with('email', '' );
    }
    public function postAdd(Request $request){
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
      $volunteer->neighborhood->Borough = $request->City;
      $volunteer->City = $request->City;
      $volunteer->save();

      return view('volunteer.check')->with('message','Volunteer Added');
    }

    public function postEdit(Request $request){
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
      if($request->BadEmail == 'true'){
        $volunteer->BadEmail = "1";
      } else {
        $volunteer->BadEmail = "0";
      }
      if($request->BadPhone == 'true'){
        $volunteer->BadPhone = "1";
      } else {
        $volunteer->BadPhone = "0";
      }
      if($request->DoNotContact == 'true'){
        $volunteer->DoNotContact = "1";
      } else {
        $volunteer->DoNotContact = "0";
      }
      $volunteer->neighborhood->save();
      $volunteer->save();

      return view('volunteer.check')->with('message','Volunteer Edited!');

    }





    ################################## --------------- VIEWING THE DATA -------------- #######################################

    public function getSearchZip(Request $request){
      //get the zips for the columns
      $zips =  \teambernieny\Volunteer::select('Zip')->distinct('Zip')->orderby('Zip')->get();
      $collength = sizeof($zips)/12;
      for($y =0; $y< 12; $y++){
        for($x=0;$x < $collength;$x++){
            $zipcol[$x]=$zips[$x+$collength*$y];
        }
        $zipcols[$y]=$zipcol;
      }

      $neighborhoods = \teambernieny\Neighborhood::distinct('Name')->orderby('Borough')->get();
      $bronx = $neighborhoods->whereLoose('Borough','Bronx')->sortBy('Name');
      $brooklyn = $neighborhoods->whereLoose('Borough','Brooklyn')->sortBy('Name');
      $manhattan = $neighborhoods->whereLoose('Borough','Manhattan')->sortBy('Name');
      $queens =$neighborhoods->whereLoose('Borough','Queens')->sortBy('Name');
      $statenisland = $neighborhoods->whereLoose('Borough','Staten Island')->sortBy('Name');
      $other = \teambernieny\Neighborhood::distinct('Name')->whereNotIn('Borough', ['Bronx','Brooklyn','Manhattan','Queens','Staten Island'])->orderby('Name')->get();


      return view('volunteer.search.zip')->with([
        'zipcols' => $zipcols,
        'bronx' => $bronx,
        'brooklyn' => $brooklyn,
        'manhattan' => $manhattan,
        'queens' => $queens,
        'statenisland' => $statenisland,
        'other' => $other
      ]);
    }
    public function postSearchZip(Request $request){
    if (($request->zips != "") && ($request->neighborhoods != "")){
      $volunteers = \teambernieny\Volunteer::distinct('id')->with('neighborhood')->whereIn('neighborhood_id', $request->neighborhoods)->orwhereIn('Zip',$request->zips)->get();
    } else if ($request->neighborhoods != ""){
      $volunteers = \teambernieny\Volunteer::distinct('id')->with('neighborhood')->whereIn('neighborhood_id', $request->neighborhoods)->get();
    } else {
      $volunteers = \teambernieny\Volunteer::distinct('id')->with('neighborhood')->whereIn('Zip',$request->zips)->get();

    }
      return view('volunteer.search.searchresults')->with([
        'volunteers'=> $volunteers]);
    }

    public function getSearchName(Request $request){

      return view('volunteer.search.name');
    }
    public function postSearchName(Request $request){
      if($request->type == 'Name'){
        $volunteers = \teambernieny\Volunteer::distinct('id')->with('neighborhood')->where('FirstName','=',$request->FirstName)->where('LastName','=',$request->LastName)->get();

      } else if ($request->type == 'Email'){
        $volunteers = \teambernieny\Volunteer::distinct('id')->with('neighborhood')->where('Email','=',$request->Email)->get();

      } else if ($request->type == 'Phone'){
        $volunteers = \teambernieny\Volunteer::distinct('id')->with('neighborhood')->where('Phone','=',$request->Phone)->get();

      }
      return view('volunteer.search.searchresults')->with([
        'volunteers'=> $volunteers]);
    }

    public function getSearchEvent(Request $request){

      return view('volunteer.search.event');
    }
    public function postSearchEvent(Request $request){

      if($request->type == 'Name'){
        $events = \teambernieny\Event::with('volunteers')->where('Name', '=', $request->EventName)->get();
        $volunteers = $events[0]->volunteers;

      } elseif ($request->type == 'Date'){
        $events = \teambernieny\Event::with('volunteers')->where('Date', '=', $request->EventDate)->get();
        $x=0;
        foreach($events as $event){
          foreach($events->volunteers as $volunteer){
            $volunteers[$x] = $volunteers;
            $x=$x+1;
          }
        }
      }
      return view('volunteer.search.searchresults')->with([
        'volunteers' => $volunteers
      ]);
    }
    public function getAll(Request $request){
      $volunteers = \teambernieny\Volunteer::with('neighborhood')->orderby('FirstName')->get();

      return view('volunteer.search..all')->with(['volunteers' => $volunteers]);
    }
}
