<?php

namespace teambernieny\Http\Controllers;

use teambernieny\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class FileController extends Controller {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    public function getAdd(Request $request){

      $event = \teambernieny\Event::with('files')->find($request->event_id);
      return view('file.add')->with([
        'event' => $event
      ]);
    }
    public function postAdd(Request $request){
        $file = new \teambernieny\File();
        $file->event_id = $request->event_id;
        $file->Name = $request->FileName;
        $file->TotalRows = $request->TotalRows;
        if($request->CompletedRows == ""){
          $file->CompletedRows = '0';
        } else {
          $file->CompletedRows = $request->CompletedRows;
        }
        if($request->Completed == "true"){
          $file->Completed = 1;
        }else{
          $file->Completed = 0;
        }
        $file->save();
      
      $event = \teambernieny\Event::with('files')->find($request->event_id);
      return view('file.add')->with([
        'event' => $event
      ]);
    }
    public function postComplete(Request $request){
      $file = \teambernieny\File::find($request->file_id);
      $file->CompletedRows = $file->TotalRows;
      $file->Completed = "1";
      $file->user_id = $request->user_id;
      $file->save();

      $event = \teambernieny\Event::with('files')->find($request->event_id);
      return view('file.add')->with([
        'event' => $event
      ]);
    }
    public function postCompleteReg(Request $request){
      $file = \teambernieny\File::find($request->file_id);
      $file->CompletedRows = $file->TotalRows;
      $file->Completed = "1";
      $file->user_id = $request->user_id;
      $file->save();
      $twoweeks = time() - (7 * 24 * 60 * 60 * 2);
      $events = \teambernieny\Event::with('neighborhood')->with('files')->where('Date','>', date('Y-m-d',$twoweeks))->where('id','!=','1')->orderby('Date', 'DESC')->get();
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
      $file = \teambernieny\File::find($request->file_id);
      $event = \teambernieny\Event::with('files')->find($request->event_id);
      return view('file.edit')->with([
        'file' => $file,
        'event' => $event
      ]);
    }
    public function postEdit(Request $request){
      $file = \teambernieny\File::find($request->file_id);
      $file->Name = $request->FileName;
      $file->TotalRows = $request->TotalRows;
      if($request->CompletedRows == ""){
        $file->CompletedRows = '0';
      } else {
        $file->CompletedRows = $request->CompletedRows;
      }
      if($request->Completed == "true"){
        $file->Completed = 1;
        $file->user_id = $request->user_id;
      }else{
        $file->Completed = 0;
        $file->user_id = null;
      }
      $file->save();

      $event = \teambernieny\Event::with('files')->find($request->event_id);
      return view('file.add')->with([
        'event' => $event
      ]);
    }
      public function getUpload(Request $request){
        return view('file.upload');
      }

}
