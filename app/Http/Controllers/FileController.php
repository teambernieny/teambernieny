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
      $files = \teambernieny\File::where('Name','=',$request->FileName)->get();
      if(sizeof($files) == 0){
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
      }
      $event = \teambernieny\Event::with('files')->find($request->event_id);
      return view('file.add')->with([
        'event' => $event
      ]);
    }
    public function postComplete(Request $request){
      $file = \teambernieny\File::find($request->file_id);
      $file->CompletedRows = $file->TotalRows;
      $file->Completed = "1";
      $file->save();
      $event = \teambernieny\Event::with('files')->find($request->event_id);
      return view('file.add')->with([
        'event' => $event
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
      }else{
        $file->Completed = 0;
      }
      $file->save();

      $event = \teambernieny\Event::with('files')->find($request->event_id);
      return view('file.add')->with([
        'event' => $event
      ]);
    }

}
